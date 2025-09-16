<?php

namespace App\Livewire\Admin;

use App\Models\Notification;
use Livewire\Component;

class EditNotification extends Component
{
    public Notification $notification;
    public $title;
    public $message;
    public $type;
    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'type' => 'required|string|max:50'
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
            'type' => $this->type
        ]);

        return redirect()->route('admin.notifications')->with([
            'message' => 'Notification updated successfully.',
            'type' => 'success'
        ]);
    }
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.edit-notification',)
        ->extends('layouts.admin')
        ->section('content');
    }
}
