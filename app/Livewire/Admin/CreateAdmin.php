<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class CreateAdmin extends Component
{
    public $name, $email, $password, $password_confirmation, $role;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ];
    }

    public function mount()
    {
        $this->role = request()->routeIs('admin.add') ? 'admin' : 'user'; // Default to 'user' if not admin add page
    }

    public function store()
    {
        $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => Hash::make($this->password),
            'email_verified_at' => now(),
        ]);
        $this->reset('name', 'email', 'password', 'password_confirmation', 'role');

        $this->dispatch('snackbar', message: 'User added successfully!', type: 'success');
            return redirect()->route('admin.accounts');
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-user')
            ->extends('layouts.admin')
            ->section('content');
    }
}