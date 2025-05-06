<?php

use App\Http\Controllers\VerifyController;
use App\Livewire\Actions\Logout;
use App\Livewire\Auth\Login;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;


Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::post('/logout', Logout::class)->name('logout')->middleware('auth');

Route::get('/email/verify/{id}/{hash}', [VerifyController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
Route::post('/auth/google', [AuthApiController::class, 'loginWithGoogle']);
Route::post('/auth/apple', [AuthApiController::class, 'loginWithApple']);
