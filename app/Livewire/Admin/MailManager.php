<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Artisan;
use App\Models\MailManager as MailManagerModel;

class MailManager extends Component
{
    public $mail_driver, $mail_host, $mail_port, $mail_username, $mail_password, $mail_from_address, $mail_from_name;

    public function mount()
    {
        $settings = MailManagerModel::first();

        $this->mail_driver = $settings->mailer ?? config('mail.mailers.smtp.transport');
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
            'mail_driver' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|numeric',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        MailManagerModel::updateOrCreate(
            ['id' => 1], // only one row
            [
                'mailer' => $this->mail_driver,
                'host' => $this->mail_host,
                'port' => $this->mail_port,
                'username' => $this->mail_username,
                'password' => $this->mail_password,
                'address' => $this->mail_from_address,
                'name' => $this->mail_from_name,
            ]
        );

        Artisan::call('config:clear');

        $this->dispatch('sweetAlert', title: 'Success', message: 'Mail settings updated successfully.', type: 'success');
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.mail-manager')
            ->extends('layouts.admin')
            ->section('content');
    }
}