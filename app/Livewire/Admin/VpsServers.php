<?php

namespace App\Livewire\Admin;

use App\Models\VpsServer;
use Livewire\Component;
use Livewire\WithPagination;

class VpsServers extends Component
{   use WithPagination;

    public string $search = '';
    public int $perPage = 5;

    public $statusFilter = '';

    public VpsServer $VpsServer;
    public $name, $ip_address, $username, $port, $domain, $status, $private_key, $password;

    protected function rules()
    {
        return [
            'name' => 'required',
            'ip_address' => 'required',
            'username' => 'required',
            'port' => 'required',
            'domain' => 'required',
            'status' => 'required',
            'private_key' => 'nullable|required_without:password',
            'password' => 'nullable|required_without:private_key',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function editVpsServer($id)
    {
        $server = VpsServer::findOrFail($id);

        $this->reset(['VpsServer', 'name', 'ip_address', 'username', 'port', 'status', 'private_key', 'password']);

        $this->VpsServer = $server;
        $this->name = $server->name;
        $this->ip_address = $server->ip_address;
        $this->username = $server->username;
        $this->port = $server->port;
        $this->domain = $server->domain;
        $this->status = $server->status;
        $this->private_key = $server->private_key;
        $this->password = $server->password;
    }

    public function updateVpsServer()
    {
        $this->validate();

        $this->VpsServer->update([
            'name' => $this->name,
            'ip_address' => $this->ip_address,
            'username' => $this->username,
            'port' => $this->port,
            'domain' => $this->domain,
            'status' => $this->status,
            'private_key' => $this->private_key,
            'password' => $this->password,
        ]);

        $this->reset(['VpsServer', 'name', 'ip_address', 'username', 'port', 'status', 'private_key', 'password']);

        $this->dispatch('closeEditModal');

        $this->dispatch('sweetAlert', type: 'success', message: 'VPS Server updated successfully', title: 'Updated!');
    }

    public function deleteVpsServer($id)
    {
        $vpsServer = VpsServer::findOrFail($id);
        $vpsServer->delete();
        $this->dispatch('sweetAlert', type: 'success', message: 'VPS Server deleted successfully', title: 'Deleted!');
    }

    public function render()
    {
        $vpsServers = VpsServer::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('ip_address', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%')
                ->orWhere('port', 'like', '%' . $this->search . '%')
                ->orWhere('domain', 'like', '%' . $this->search . '%')
                ->orWhere('created_at', 'like', '%' . $this->search . '%');
        })->when($this->statusFilter, function ($query) {
            $query->where('status', $this->statusFilter);
        })->paginate($this->perPage);
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.vps-servers', compact('vpsServers'))
        ->extends('layouts.admin')
        ->section('content');
    }
}
