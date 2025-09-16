<?php

namespace App\Livewire\Admin;

use App\Models\Notification;
use Livewire\Component;

class CreateNotification extends Component
{
    public $title;
    public $message;
    public $type;
    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'type' => 'required|string|max:255',
        ];
    }


    public function saveNotification()
    {
        $this->validate();

        Notification::create([
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type,
        ]);

        return redirect()->route('admin.notifications')->with([
            'type' => 'success',
            'message' => 'Notification created successfully!',
        ]);
    }
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-notification')
            ->extends('layouts.admin')
            ->section('content');
    }
}
