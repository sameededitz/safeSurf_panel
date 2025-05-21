<?php

use App\Http\Controllers\admin\DashboardController;
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

Route::get('/log-smtp', [DashboardController::class, 'logSmtp'])->name('log-smtp');
