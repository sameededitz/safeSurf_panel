<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\admin\DashboardController;

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

Route::get('/mailable', function () {
    $user = App\Models\User::find(2);

    return new App\Mail\ResetPasswordMail($user, 'https://example.com/verify-email?email=' . $user->email . '&hash=' . sha1($user->email));
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created';
});
Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'Database migrated';
});
Route::get('/seed', function () {
    Artisan::call('db:seed');
    return 'Database seeded';
});
Route::get('/migrate-refresh-seed', function () {
    Artisan::call('migrate --seed');
    return 'Database migrated and seeded';
});
Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'Optimized and cleared';
});
