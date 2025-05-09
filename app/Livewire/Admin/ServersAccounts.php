<?php

namespace App\Livewire\Admin;

use App\Models\VpsAccounts;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\VpsServer;

class ServersAccounts extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;

    public function deleteAccount($vpsaccountsID)
    {
        $vpsaccounts = VpsAccounts::findOrFail($vpsaccountsID);
        $vpsaccounts->delete();

        $this->dispatch('sweetAlert', title: 'Success!', message: 'VPS Account deleted successfully.', type: 'success');
        $this->resetPage();
    }
    public function render()
    {
        $vpsaccounts = VpsAccounts::query()
        ->with('vpsserver')
        ->when($this->search, fn($query) => $query->where('title', 'like', '%' . $this->search . '%'))
        ->latest()
        ->paginate($this->perPage);
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.servers-accounts', compact('vpsaccounts'))
        ->extends('layouts.admin')
        ->section('content');
    }
}
