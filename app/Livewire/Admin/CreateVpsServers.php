<?php

namespace App\Livewire\Admin;

use App\Models\VpsServer;
use Livewire\Component;

class CreateVpsServers extends Component
{
    public $name, $ip_address, $username, $port, $domain, $status, $private_key, $password;

    protected function rules()
    {
        return [
            'name' => 'required',
            'ip_address' => 'required',
            'username' => 'required',
            'port' => 'required',
            'domain' => 'required',
            'status' => 'required|in:1,0',
            'private_key' => 'nullable|required_without:password',
            'password' => 'nullable|required_without:private_key',
        ];
    }

    public function store()
    {
        $this->validate();

        VpsServer::create([
            'name' => $this->name,
            'ip_address' => $this->ip_address,
            'username' => $this->username,
            'port' => $this->port,
            'domain' => $this->domain,
            'status' => $this->status,
            'private_key' => $this->private_key,
            'password' => $this->password,
        ]);

        $this->reset(['name', 'ip_address', 'username', 'port', 'status', 'private_key', 'password']);

        $this->dispatch('snackbar', type: 'success', message: 'VPS Server created successfully');

        $this->dispatch('redirect', url: route('admin.vps.servers'));
    }
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-vps-servers')
        ->extends('layouts.admin')
        ->section('content');
    }
}
