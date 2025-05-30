<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Jobs\SendPasswordReset;
use Illuminate\Support\Facades\Password;
use App\Jobs\SendEmailVerification; // Ensure this job exists in the specified namespace

class UserManager extends Component
{
    public User $user;
    public $plans, $selectedPlan;

    public function mount(User $user)
    {
        $this->user = $user->load(['purchases.plan', 'activePlan.plan', 'devices.token']);
        $this->plans = Plan::all();
    }

    public function addPlan()
    {
        $this->validate([
            'selectedPlan' => 'required|exists:plans,id',
        ]);

        $plan = Plan::findOrFail($this->selectedPlan);
        $prices = $plan->discount_price ? $plan->discount_price : $plan->original_price;
        // dd($plan, $prices);
        $activePurchase = $this->user->activePlan;

        if ($activePurchase) {
            $newExpiresAt = $this->calculateExpiry($activePurchase->end_date, $plan);

            $activePurchase->update([
                'plan_id' => $plan->id,
                'amount_paid' => $activePurchase->amount_paid + $prices,
                'end_date' => $newExpiresAt
            ]);

            $message = 'Plan extended successfully!';
        } else {
            $expiresAt = $this->calculateExpiry(now(), $plan);

            $this->user->purchases()->create([
                'plan_id' => $plan->id,
                'amount_paid' => $prices,
                'start_date' => now(),
                'end_date' => $expiresAt,
                'status' => 'active',
            ]);

            $message = 'Plan added successfully!';
        }

        $this->selectedPlan = null;

        $this->user->refresh();

        $this->dispatch('sweetAlert', title: 'Success', message: $message, type: 'success');
    }

    public function cancelPurchase()
    {
        if ($this->user->activePlan) {
            $this->user->activePlan->update(['status' => 'cancelled']);
            $message = 'Purchase cancelled successfully!';
        } else {
            $message = 'No active purchase found!';
        }
        $this->dispatch('sweetAlert', title: 'Success', message: $message, type: 'success');

        $this->user->refresh();
    }

    public function verifyEmailManually()
    {
        $this->user->update(['email_verified_at' => now()]);
        $this->dispatch('sweetAlert', title: 'Success', message: 'Email verified manually.', type: 'success');
        $this->user->refresh();
    }

    public function resendVerificationEmail()
    {
        if (!$this->user->hasVerifiedEmail()) {
            // SendEmailVerification::dispatch($this->user)->delay(now()->addSeconds(5));
            $this->dispatch('sweetAlert', title: 'Success', message: 'Verification email resent.', type: 'success');
        } else {
            $this->dispatch('sweetAlert', title: 'Info', message: 'Email is already verified.', type: 'info');
        }
    }

    public function sendPasswordResetLink()
    {
        if ($this->user->hasVerifiedEmail()) {
            $token = Password::createToken($this->user);
            SendPasswordReset::dispatch($this->user, $token)->delay(now()->addSeconds(5));
            $this->user->tokens()->delete(); // Revoke all tokens
            $this->user->devices()->delete(); // Revoke all devices
            $this->user->refresh();
            $this->dispatch('sweetAlert', title: 'Success', message: 'Password reset link sent successfully.', type: 'success');
        } else {
            $this->dispatch('sweetAlert', title: 'Error', message: 'User email is not verified.', type: 'error');
        }
    }

    public function banUser($reason = null)
    {
        if ($this->user->isBanned()) {
            $this->dispatch('sweetAlert', title: 'Info', message: 'User is already banned.', type: 'info');
            return;
        }

        if (! $this->user->isBanned()) {
            $this->user->update(['banned_at' => now(), 'ban_reason' => $reason]);
            $this->user->tokens()->delete();
            $this->dispatch('sweetAlert', title: 'Success', message: 'User banned successfully.', type: 'success');
        }
        $this->user->refresh();
    }

    public function unbanUser()
    {
        if ($this->user->isBanned()) {
            $this->user->update(['banned_at' => null, 'ban_reason' => null]);
            $this->dispatch('sweetAlert', title: 'Success', message: 'User unbanned successfully.', type: 'success');
        }
        $this->user->refresh();
    }

    public function deleteUser()
    {
        $this->user->delete();
        $this->dispatch('sweetAlert', title: 'Success', message: 'User deleted successfully.', type: 'success');
        return redirect()->route('admin.users');
    }

    public function revokeDevice($deviceId)
    {
        $device = $this->user->devices()->find($deviceId);
        if ($device) {
            // Delete the token record
            if ($device->token) {
                $device->token()->delete();
            }

            $device->delete();
            $this->dispatch('sweetAlert', title: 'Access Revoked', message: 'Device logged out successfully.', type: 'success');
        } else {
            $this->dispatch('sweetAlert', title: 'Error', message: 'Device not found.', type: 'error');
        }
        $this->user->refresh();
    }

    public function revokeAllDevices()
    {
        $this->user->tokens()->delete();
        $this->user->devices()->delete();

        $this->dispatch('sweetAlert', title: 'Access Revoked', message: 'All devices logged out successfully.', type: 'success');
        $this->user->refresh();
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.user-manager')
            ->extends('layouts.admin')
            ->section('content');
    }

    private function calculateExpiry(Carbon $start, Plan $plan): Carbon
    {
        $maxDate = Carbon::create(2038, 1, 19, 3, 14, 7);
        $expiresAt = match ($plan->duration_unit) {
            'day' => $start->addDays($plan->duration),
            'week' => $start->addWeeks($plan->duration),
            'month' => $start->addMonths($plan->duration),
            'year' => $start->addYears($plan->duration),
            default => $start->addDays(7),
        };
        return $expiresAt->greaterThan($maxDate) ? $maxDate : $expiresAt;
    }
}
