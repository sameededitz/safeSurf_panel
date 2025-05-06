<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\MailManager;
use Illuminate\Support\Facades\Artisan;

class MailConfig extends Component
{
    public $mail_driver, $mail_host, $mail_port, $mail_username, $mail_password, $mail_from_address, $mail_from_name;

    public function mount()
    {
        $settings = MailManager::first();

        $this->mail_host = $settings->host ?? config('mail.mailers.smtp.host');
        $this->mail_port = $settings->port ?? config('mail.mailers.smtp.port');
        $this->mail_username = $settings->username ?? config('mail.mailers.smtp.username');
        $this->mail_password = $settings->password ?? config('mail.mailers.smtp.password');
        $this->mail_from_address = $settings->address ?? config('mail.from.address');
        $this->mail_from_name = $settings->name ?? config('mail.from.name');
    }

    public function store()
    {
        $this->validate([
            'mail_host' => 'required|string',
            'mail_port' => 'required|numeric',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        MailManager::updateOrCreate(
            ['id' => 1], // only one row
            [
                'host' => $this->mail_host,
                'port' => $this->mail_port,
                'username' => $this->mail_username,
                'password' => $this->mail_password,
                'address' => $this->mail_from_address,
                'name' => $this->mail_from_name,
            ]
        );

        Artisan::call('config:clear');
        Artisan::call('queue:restart');

        $this->dispatch('sweetAlert', title: 'Success', message: 'Mail settings updated successfully.', type: 'success');
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.mail-config')
            ->extends('layouts.admin')
            ->section('content');
    }
}
