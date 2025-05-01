<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Admins extends Component
{
    use WithPagination;

    public string $search = '';
    public int $perPage = 5;

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
        $users = User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('role', 'like', '%' . $this->search . '%')
                ->orWhereDate('created_at', $this->search);
        })->where('role', '=', 'admin')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

            /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.admins', compact('users'))
        ->extends('layouts.admin')
        ->section('content');
    }
}
