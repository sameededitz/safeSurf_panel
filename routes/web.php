<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('login');
    }
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::get('/log-smtp', function () {
    \Illuminate\Support\Facades\Log::info('SMTP log test', [
        'host' => config('mail.mailers.smtp.host'),
        'port' => config('mail.mailers.smtp.port'),
        'username' => config('mail.mailers.smtp.username'),
        'password' => config('mail.mailers.smtp.password'),
        'from' => config('mail.from.address'),
        'from_name' => config('mail.from.name'),
    ]);
    return 'Log test completed';
})->name('log-smtp');
