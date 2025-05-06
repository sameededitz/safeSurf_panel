<?php

namespace App\Livewire\Admin;

use App\Models\Ticket;
use Livewire\Component;
use App\Models\TicketMessage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Spatie\LivewireFilepond\WithFilePond;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TicketDetails extends Component
{
    use WithFileUploads, WithFilePond;

    public $ticketId;

    public $message = '';
    public $attachments = [];
    public $uploadedImagesCount = 0;

    public $editingMessageId;
    public $editMessageContent;
    public $existingImages = [];

    protected function rules()
    {
        return [
            'message' => 'required|string|max:1000',
            'attachments' => 'array|max:5',
            'attachments.*' => 'image|max:20420|mimes:jpeg,png,jpg',
        ];
    }

    public function updatedAttachments()
    {
        $this->uploadedImagesCount = count($this->attachments);
    }

    public function mount($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function resetForm()
    {
        $this->attachments = [];
        $this->uploadedImagesCount = 0;
        $this->dispatch('filepond-reset-attachments');
    }

    public function startEditing($id)
    {
        $this->editingMessageId = $id;
        $message = TicketMessage::findOrFail($id);
        $this->editMessageContent = $message->message;
        $this->existingImages = $message->getMedia('attachments')->pluck('uuid')->toArray();
    }

    public function cancelEditing()
    {
        $this->editingMessageId = null;
        $this->editMessageContent = '';
        $this->existingImages = [];
    }

    public function deleteImage($uuid)
    {
        $media = Media::where('uuid', $uuid)->first();

        if ($media && $media->model_type === TicketMessage::class) {
            $this->existingImages = array_filter($this->existingImages, fn($item) => $item !== $uuid);

            $this->dispatch('sweetAlert', title: 'Pending Deletion', message: 'Image will be deleted if you save changes.', type: 'warning');
        }
    }

    public function updateMessage()
    {
        $this->validate([
            'editMessageContent' => 'required|string',
        ]);

        $message = TicketMessage::findOrFail($this->editingMessageId);

        $message->update([
            'message' => $this->editMessageContent,
        ]);

        $keepMedia = Media::whereIn('uuid', $this->existingImages)->get();
        $message->clearMediaCollectionExcept('attachments', $keepMedia);

        $this->reset([
            'editingMessageId',
            'editMessageContent',
            'existingImages',
        ]);

        $this->dispatch('sweetAlert', title: 'Updated!', message: 'Message has been updated.', type: 'success');
    }

    public function deleteMessage($id)
    {
        $message = TicketMessage::findOrFail($id);

        $message->clearMediaCollection('attachments');

        $message->delete();

        $this->reset([
            'editingMessageId',
            'editMessageContent',
            'existingImages',
        ]);

        $this->dispatch('sweetAlert', title: 'Deleted!', message: 'Message and attachments have been deleted.', type: 'success');
    }

    public function sendReply()
    {
        $this->validate();

        $ticket = Ticket::findOrFail($this->ticketId);
        $msg = $ticket->messages()->create([
            'user_id' => Auth::id(),
            'message' => $this->message,
            'is_admin' => true,
        ]);

        foreach ($this->attachments as $file) {
            $msg->addMedia($file->getRealPath())
                ->usingFileName(time() . '_ticket-' . $ticket->id . '_message-' . $msg->id . '_file-' . $file->getClientOriginalName())
                ->toMediaCollection('attachments');
        }

        $this->dispatch('sweetAlert', title: 'Sent!', message: 'Your reply has been sent.', type: 'success');
        $this->reset('message');
        $this->resetForm();
    }

    public function updateStatus($ticketId, $status)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $ticket->status = $status;
        $ticket->save();

        $this->dispatch('sweetAlert', title: 'Updated!', message: 'Ticket status has been updated.', type: 'success');
    }

    public function render()
    {
        $ticket = Ticket::with(['user:id,name', 'messages'])
            ->findOrFail($this->ticketId);

        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.ticket-details', compact('ticket'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
