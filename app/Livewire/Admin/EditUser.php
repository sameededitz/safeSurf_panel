<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public User $user;
    public $name, $email, $role;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'role' => 'required|in:admin,user',
        ];
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function update()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        $this->dispatch('snackbar', message: 'User updated successfully!', type: 'success');

        $this->dispatch('redirect', url: route('admin.users'));
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.edit-user')
            ->extends('layouts.admin')
            ->section('content');;
    }
}