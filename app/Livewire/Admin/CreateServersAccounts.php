<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\VpsAccounts;
use App\Models\VpsServer;
use Illuminate\Support\Facades\Hash;

class CreateServersAccounts extends Component
{
    public $name, $vpsserverId, $type, $password;
    public VpsServer $vpsserver;
    
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'vpsserverId' => 'required|exists:vps_servers,id',
            'type' => 'required|in:open,wireguard,ikev2',
            'password' => 'required_if:type,open,ikev2|nullable',
        ];
    }
    public function store()
    {
        $this->validate();

        VpsAccounts::create([
            'name' => $this->name,
            'vpsserver_id' => $this->vpsserverId,
            'type' => $this->type,
            'password' => Hash::make($this->password),
        ]);

        $this->dispatch('snackbar', message: 'Vps Account added successfully!', type: 'success');
        $this->dispatch('redirect', url: route('admin.servers.accounts'));
    }
    public function render()
    {
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-servers-accounts',
            [
                'vpsservers' => VpsServer::all(),
            ])
        ->extends('layouts.admin')
        ->section('content');
    }
}
