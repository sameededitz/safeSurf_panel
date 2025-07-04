<?php

namespace App\Livewire\Admin;

use App\Models\Server;
use Livewire\Component;
use App\Models\SubServer;
use App\Models\VpsServer;

class EditSubServer extends Component
{
    public Server $server;
    public SubServer $subServer;
    public $name, $status;
    public $vps_server;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'vps_server' => 'required|exists:vps_servers,id',
        ];
    }

    public function mount(Server $server, SubServer $subServer)
    {
        $this->server = $server;
        $this->subServer = $subServer;
        $this->name = $subServer->name;
        $this->status = $subServer->status;
        $this->vps_server = $subServer->vps_server_id;
    }

    public function update()
    {
        $this->validate();

        $this->subServer->update([
            'name' => $this->name,
            'status' => $this->status,
            'vps_server_id' => $this->vps_server,
        ]);

        $this->dispatch('snackbar', message: 'Sub-Sub Server added successfully!', type: 'success');
        $this->dispatch('redirect', url: route('admin.edit.sub-server', $this->subServer));
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.edit-sub-server', [
            'vpsServers' => VpsServer::all('id', 'name', 'username', 'ip_address'),
        ])->extends('layouts.admin')
            ->section('content');
    }
}
