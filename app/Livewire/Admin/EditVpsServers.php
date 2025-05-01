<?php

namespace App\Livewire\Admin;

use App\Models\VpsServer;
use Livewire\Component;

class EditVpsServers extends Component
{
    public VpsServer $vpsServers;
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

    public function mount(VpsServer $vpsServers)
    {
        $this->vpsServers = $vpsServers;
        $this->name = $vpsServers->name;
        $this->ip_address = $vpsServers->ip_address;
        $this->username = $vpsServers->username;
        $this->port = $vpsServers->port;
        $this->domain = $vpsServers->domain;
        $this->status = $vpsServers->status;
        $this->private_key = $vpsServers->private_key;
        $this->password = $vpsServers->password;
    }
    public function update()
    {
        $this->validate();

        $this->vpsServers->update([
            'name' => $this->name,
            'ip_address' => $this->ip_address,
            'username' => $this->username,
            'port' => $this->port,
            'domain' => $this->domain,
            'status' => $this->status,
            'private_key' => $this->private_key,
            'password' => $this->password,
        ]);

        $this->dispatch('snackbar', message: 'VPS Server updated successfully!', type: 'success');
        $this->dispatch('redirect', url: route('admin.vps.servers'));
    }
    public function render()
    {
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.edit-vps-servers')
        ->extends('layouts.admin')
        ->section('content');
    }
}
