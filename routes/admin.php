<?php

use App\Http\Controllers\admin\DashboardController;
use App\Livewire\Admin\AllPlans;
use App\Livewire\Admin\CreatePlan;
use App\Livewire\Admin\CreateVpsServers;
use App\Livewire\Admin\EditPlan;
use App\Livewire\Admin\EditVpsServers;
use App\Livewire\Admin\Transactions;
use App\Livewire\Admin\VpsServers;
use App\Livewire\Admin\VpsServersManager;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/plans', AllPlans::class)->name('admin.plans');
    Route::get('/create-plan', CreatePlan::class)->name('admin.create.plan');
    Route::get('/edit-plan/{plan}', EditPlan::class)->name('admin.edit.plan');

    Route::get('/vps-servers', VpsServers::class)->name('admin.vps.servers');
    Route::get('/create-vps-servers', CreateVpsServers::class)->name('admin.create.vps-server');
    Route::get('/edit-vps-servers/{vpsServers}', EditVpsServers::class)->name('admin.edit.vps-server');
    Route::get('/vps-server-manager/{vpsServer}', VpsServersManager::class)->name('admin.vps-server-manager');

    Route::get('/transactions', Transactions::class)->name('admin.transactions');
});
