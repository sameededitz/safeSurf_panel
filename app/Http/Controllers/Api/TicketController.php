<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\TicketResource;
use App\Traits\HandlesTicketAttachments;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    use HandlesTicketAttachments;

    public function index()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $tickets = $user->tickets()
            ->with(['messages' => function ($query) {
                $query->oldest()->limit(1); // get only the first (oldest) message
            }])
            ->latest()
            ->get();

        return response()->json([
            'tickets' => TicketResource::collection($tickets),
        ], 200);
    }

    public function show($id)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $ticket = $user->tickets()->with('messages.media')->find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        Gate::authorize('view', $ticket);

        return response()->json([
            'ticket' => new TicketResource($ticket->load('messages.media')),
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'department' => 'required|string',
            'priority' => 'nullable|string|in:low,medium,high',
            'attachments' => 'nullable|array|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        // Validate attachments manually with custom error messages including filenames
        $fileErrors = $this->validateAttachments($request, 'attachments', 20480, ['image/jpeg', 'image/jpg', 'image/png']);
        if (!empty($fileErrors)) {
            return response()->json(['errors' => $fileErrors], 422);
        }

        try {
            /** @var \App\Models\User $user **/
            $user = Auth::user();

            $ticket = $user->tickets()->create([
                'subject' => $request->subject,
                'priority' => $request->priority ?? 'medium',
                'department' => $request->department,
                'status' => 'open',
            ]);

            $message = $ticket->messages()->create([
                'message' => $request->message,
                'user_id' => $user->id,
                'is_admin' => false,
            ]);

            $uploadErrors = [];

            if ($request->has('attachments')) {
                $prefix = 'ticket-' . $ticket->id . '_msg-' . $message->id;
                $uploadErrors = $this->handleTicketAttachments($message, $request->attachments, 'attachments', $prefix);
            }

            return response()->json([
                'message' => 'Ticket created successfully.',
                'ticket' => new TicketResource($ticket->load('messages.media')),
                'upload_warnings' => $uploadErrors ? $uploadErrors : [],
            ], count($uploadErrors) > 0 ? 207 : 201); // 207: Multi-status if some files had issues

        } catch (\Exception $e) {
            Log::error('Ticket creation failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to create ticket.',
                'error' => 'An unexpected error occurred. Please try again later.'
            ], 500);
        }
    }

    public function reply(Request $request, $ticketId)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
            'attachments' => 'nullable|array|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Validate attachments manually with custom error messages including filenames
        $fileErrors = $this->validateAttachments($request, 'attachments', 20480, ['image/jpeg', 'image/jpg', 'image/png']);
        if (!empty($fileErrors)) {
            return response()->json(['errors' => $fileErrors], 422);
        }

        try {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $ticket = $user->tickets()->find($ticketId);

            if (!$ticket) {
                return response()->json(['message' => 'Ticket not found.'], 404);
            }

            $message = $ticket->messages()->create([
                'message' => $request->message,
                'user_id' => $user->id,
                'is_admin' => false,
            ]);

            $uploadErrors = [];
            if ($request->has('attachments')) {
                $prefix = 'ticket-' . $ticket->id . '_msg-' . $message->id;
                $uploadErrors = $this->handleTicketAttachments($message, $request->attachments, 'attachments', $prefix);
            }

            return response()->json([
                'message' => 'Message sent successfully.',
                'ticket' => new TicketResource($ticket->load('messages.media')),
                'upload_warnings' => $uploadErrors,
            ], count($uploadErrors) > 0 ? 207 : 201); // 207 Multi-Status if some uploads failed

        } catch (\Exception $e) {
            Log::error('Reply failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Something went wrong while replying.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function close($ticketId)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $ticket = $user->tickets()->find($ticketId);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        Gate::authorize('close', $ticket);

        $ticket->update(['status' => 'closed']);

        return response()->json(['message' => 'Ticket closed successfully'], 200);
    }

    public function priority(Request $request, $ticketId)
    {
        $validator = Validator::make($request->all(), [
            'priority' => 'required|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $ticket = $user->tickets()->find($ticketId);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        Gate::authorize('update', $ticket);

        $ticket->update([
            'priority' => $request->priority,
        ]);

        return response()->json([
            'message' => 'Ticket priority updated successfully!',
            'ticket' => new TicketResource($ticket)
        ], 200);
    }

    public function destroy($ticketId)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $ticket = $user->tickets()
            ->with('messages.media')
            ->find($ticketId);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        Gate::authorize('delete', $ticket);

        // Delete all messages and their media
        foreach ($ticket->messages as $message) {
            $message->clearMediaCollection('attachments');
        }

        $ticket->delete();

        return response()->json(['message' => 'Ticket deleted successfully'], 200);
    }
}
