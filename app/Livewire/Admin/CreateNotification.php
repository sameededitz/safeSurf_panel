<?php

namespace App\Livewire\Admin;

use App\Models\Notification;
use Livewire\Component;

class CreateNotification extends Component
{
    public $notificationId;
    public $title;
    public $message;
    public $isEdit = false;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ];
    }


    public function saveNotification()
    {
        $this->validate();

        if ($this->isEdit) {
            $notification = Notification::findOrFail($this->notificationId);
            $notification->update([
                'title' => $this->title,
                'message' => $this->message,
            ]);
            $message = 'Notification updated successfully.';
        } else {
            Notification::create([
                'title' => $this->title,
                'message' => $this->message,
            ]);
            $message = 'Notification created successfully.';
        }

        $this->dispatch('snackbar', message: 'Plan added successfully!', type: 'success');
        $this->dispatch('redirect', url: route('admin.notifications'));
    }
    public function resetForm()
    {
        $this->reset([
            'notificationId',
            'title',
            'message',
        ]);
        $this->isEdit = false;
        $this->resetValidation();
    }
    public function render()
    {
        /** @disregard @phpstan-ignore-line */

        return view('livewire.admin.create-notification')
            ->extends('layouts.admin')
            ->section('content');
    }
}
