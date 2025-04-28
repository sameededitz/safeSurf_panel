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

Route::get('/test', function () {
    return view('auth.verify');
});