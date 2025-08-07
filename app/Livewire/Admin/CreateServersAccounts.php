<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\VpsAccounts;
use App\Models\VpsServer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

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
            'password' => 'required_unless:type,wireguard|nullable|min:8|max:255',
        ];
    }
    public function store()
    {
        $this->validate();

        if ($this->type == 'wireguard') {
            $this->password = null;
        }

        $vpsserver = VpsServer::find($this->vpsserverId);
        if (!$vpsserver) {
            $this->dispatch('sweetToast', title: 'Error', message: 'VPS Server not found!', type: 'error');
            return;
        }

        $apiToken = env('VPS_ACCOUNTS_API');
        $ip = $vpsserver->ip_address;

        $url = match ($this->type) {
            'open'      => "http://{$ip}:5000/api/openvpn/clients/{$this->name}",
            'wireguard' => "http://{$ip}:5000/api/clients/generate",
            'ikev2'     => "http://{$ip}:5000/api/ikev2/clients/generate",
            default     => null,
        };

        $payload = match ($this->type) {
            'open'      => ['username' => $this->name, 'password' => $this->password],
            'wireguard' => ['name' => $this->name],
            'ikev2'     => ['name' => $this->name, 'password' => $this->password],
            default     => [],
        };

        if (!$url) {
            $this->dispatch('sweetToast', title: 'Error', message: 'Unknown VPN type.', type: 'error');
            return;
        }

        try {
            $response = Http::withHeaders([
                'X-API-Token' => "{$apiToken}",
            ])->post($url, $payload);
        } catch (\Exception $e) {
            $this->dispatch('sweetToast', title: 'Error', message: 'Failed to connect to VPS server.', type: 'error');
            return;
        }

        $body = $response->json();

        if ($response->status() === 401) {
            $this->dispatch('sweetToast', title: 'Error', message: 'Unauthorized access.', type: 'error');
            return;
        }

        // Type: openvpn
        if ($this->type === 'open') {
            if ($response->status() === 500) {
                if (($body['error'] ?? '') === '') {
                    $this->dispatch('sweetToast', title: 'Error', message: 'Account already exists.', type: 'error');
                } else {
                    $this->dispatch('sweetToast', title: 'Validation Error', message: $body['error'], type: 'error');
                }
                return;
            }

            if ($response->status() === 200) {
                $this->createAccountRecord();
                $this->dispatch('sweetToast', title: 'Success', message: 'OpenVPN account created successfully.', type: 'success');
                $this->dispatch('redirect', url: route('admin.servers.accounts'));
                return;
            }
        }

        // Type: wireguard
        if ($this->type === 'wireguard') {
            if ($response->status() === 400) {
                $this->dispatch('sweetToast', title: 'Error', message: $body['error'] ?? 'Validation error.', type: 'error');
                return;
            }

            if ($response->status() === 200) {
                $this->createAccountRecord();
                $this->dispatch('sweetToast', title: 'Success', message: 'WireGuard account created successfully.', type: 'success');
                $this->dispatch('redirect', url: route('admin.servers.accounts'));
                return;
            }
        }

        // Type: ikev2
        if ($this->type === 'ikev2') {
            if ($response->status() === 200) {
                if (str_starts_with($body['error'] ?? '', 'Error:')) {
                    $this->dispatch('sweetToast', title: 'Error', message: 'Account already exists.', type: 'error');
                    return;
                }

                $this->createAccountRecord();
                $this->dispatch('sweetToast', title: 'Success', message: 'IKEv2 account created successfully.', type: 'success');
                $this->dispatch('redirect', url: route('admin.servers.accounts'));
                return;
            }
        }

        $this->dispatch('sweetToast', title: 'Error', message: 'Something went wrong while creating the account.', type: 'error');
    }

    private function createAccountRecord()
    {
        VpsAccounts::create([
            'name' => $this->name,
            'vpsserver_id' => $this->vpsserverId,
            'type' => $this->type,
            'password' => $this->password
        ]);
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view(
            'livewire.admin.create-servers-accounts',
            [
                'vpsservers' => VpsServer::all(),
            ]
        )
            ->extends('layouts.admin')
            ->section('content');
    }
}
