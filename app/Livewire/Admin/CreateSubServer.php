<?php

namespace App\Livewire\Admin;

use App\Models\Server;
use App\Models\VpsServer;
use Livewire\Component;

class CreateSubServer extends Component
{
    public Server $server;
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

    public function mount(Server $server)
    {
        $this->server = $server;
    }

    public function store()
    {
        $this->validate();

        $this->server->subServers()->create([
            'name' => $this->name,
            'status' => $this->status,
            'vps_server_id' => $this->vps_server,
        ]);

        return redirect()->intended(route('admin.subServers', $this->server))->with('message', 'Sub Server added successfully.');
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-sub-server', [
            'vpsServers' => VpsServer::all('id', 'name', 'username', 'ip_address'),
        ])->extends('layouts.admin')
            ->section('content');
    }
}
