<?php

namespace App\Livewire\Admin;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Users extends Component
{
     use WithPagination;

    public string $search = '';
    public int $perPage = 5;

    #[Url]
    public ?string $emailVerified = null;
    #[Url]
    public ?string $lastLoginStart = null;
    #[Url]
    public ?string $lastLoginEnd = null;
    #[Url]
    public ?string $registeredStart = null;
    #[Url]
    public ?string $registeredEnd = null;

    public $userId;
    public $name;
    public $email;
    public $role;
    public $password;
    public $password_confirmation;
    public $isEdit = false;

    public function resetFilters()
    {
        $this->reset([
            'emailVerified',
            'lastLoginStart',
            'lastLoginEnd',
            'registeredStart',
            'registeredEnd',
        ]);
    }


    

    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    protected $queryString = ['search', 'sortField', 'sortDirection'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $this->dispatch('userDeleted');
    }

    public function render()
    {
        $users = User::query()
        ->when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhereDate('created_at', $this->search);
            });
        })
        ->when($this->emailVerified === '1', fn($q) => $q->whereNotNull('email_verified_at'))
        ->when($this->emailVerified === '0', fn($q) => $q->whereNull('email_verified_at'))
        ->when($this->registeredStart && $this->registeredEnd, function ($query) {
            $query->whereBetween('created_at', [$this->registeredStart, $this->registeredEnd]);
        })
        ->when($this->lastLoginStart && $this->lastLoginEnd, function ($query) {
            $query->whereBetween('last_login', [$this->lastLoginStart, $this->lastLoginEnd]);
        })
        ->where('role', '!=', 'admin')
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);
          /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.user', compact('users'))
        ->extends('layouts.admin')
        ->section('content');
    }
}