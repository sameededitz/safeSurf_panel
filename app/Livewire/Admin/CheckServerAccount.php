<?php

namespace App\Livewire\Admin;

use App\Models\VpsAccounts;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CheckServerAccount extends Component
{
    public $config;
    public string $error = '';
    public ?VpsAccounts $vpsAccount;

    public function mount(VpsAccounts $vpsAccount)
    {
        $this->vpsAccount = $vpsAccount;
        $this->fetchConfig();
    }

    public function fetchConfig()
    {
        $type = $this->vpsAccount->type;
        $name = $this->vpsAccount->name;
        $ip = $this->vpsAccount->vpsserver->ip_address;
        $apiToken = env('VPS_ACCOUNTS_API');

        $url = match ($type) {
            'open'      => "http://{$ip}:5000/api/openvpn/clients/{$name}/config",
            'wireguard' => "http://{$ip}:5000/api/clients/{$name}",
            default     => null,
        };

        if ($type === 'ikev2') {
            $this->config = "Username: {$name}\nPassword: {$this->vpsAccount->password}\nServer IP: {$ip}";
            return;
        }

        if (!$url) {
            $this->error = 'Unknown VPN type.';
            return;
        }

        try{
            $response = Http::withHeaders([
                'X-API-Token' => $apiToken,
            ])->get($url);

            if ($response->successful()) {
                if ($type === 'open') {
                    $this->config = $response->body(); // decoded data as array
                } elseif ($type === 'wireguard') {
                    $this->config = $response->json(); // decoded data as array
                }
            } else {
                $this->error = 'Failed to fetch config.';
            }
        } catch (\Exception $e) {
            $this->config = 'Error: ' . $e->getMessage();
            $this->error = 'An error occurred while fetching VPN configuration.';
        }
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.check-server-account')
            ->extends('layouts.admin')
            ->section('content');
    }
}
