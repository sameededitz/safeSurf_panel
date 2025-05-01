<?php

namespace App\Livewire\Admin;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class Notifications extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function deleteNotification($notificationId)
    {
        $notification = Notification::findOrFail($notificationId);
        $notification->delete();

        $this->dispatch('sweetAlert', title: 'Success!', message: 'Notification deleted successfully.', type: 'success');
        $this->resetPage();
    }
    public function render()
    {
        $notifications = Notification::query()
        ->when($this->search, fn($query) => $query->where('title', 'like', '%' . $this->search . '%'))
        ->latest()
        ->paginate($this->perPage);
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.notification', compact('notifications'))    
        ->extends('layouts.admin')
        ->section('content');
    }
}
