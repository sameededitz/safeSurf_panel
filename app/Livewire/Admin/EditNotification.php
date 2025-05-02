<?php

namespace App\Livewire\Admin;

use App\Models\Notification;
use Livewire\Component;

class EditNotification extends Component
{
    public Notification $notification;
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
    public function mount(Notification $notification)
    {
        $this->notification = $notification;
        $this->title = $notification->title;
        $this->message = $notification->message;
    }
    public function updateNotification()
    {
        $this->validate();

        $this->notification->update([
            'title' => $this->title,
            'message' => $this->message,
        ]);

        $this->dispatch('snackbar', message: 'Notification updated successfully.', type: 'success');
        $this->dispatch('redirect', url: route('admin.notifications'));
    }
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.edit-notification',)
        ->extends('layouts.admin')
        ->section('content');
    }
}
