<?php

use App\Livewire\Admin\Users;
use App\Livewire\Admin\Admins;
use App\Livewire\Admin\AllPlans;
use App\Livewire\Admin\EditPlan;
use App\Livewire\Admin\EditUser;
use App\Livewire\Admin\Feedbacks;
use App\Livewire\Admin\AllServers;
use App\Livewire\Admin\CreatePlan;
use App\Livewire\Admin\CreateUser;
use App\Livewire\Admin\EditServer;
use App\Livewire\Admin\VpsServers;
use App\Livewire\Admin\CreateServer;
use App\Livewire\Admin\Transactions;
use App\Livewire\Admin\AllSubServers;
use App\Livewire\Admin\Notifications;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\EditVpsServers;
use App\Livewire\Admin\CreateSubServer;
use App\Livewire\Admin\CreateVpsServers;
use App\Livewire\Admin\EditNotification;
use App\Livewire\Admin\VpsServersManager;
use App\Livewire\Admin\CreateNotification;
use App\Http\Controllers\admin\DashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/plans', AllPlans::class)->name('admin.plans');
    Route::get('/create-plan', CreatePlan::class)->name('admin.create.plan');
    Route::get('/edit-plan/{plan}', EditPlan::class)->name('admin.edit.plan');
    
    Route::get('/vps-servers', VpsServers::class)->name('admin.vps.servers');
    Route::get('/create-vps-servers', CreateVpsServers::class)->name('admin.create.vps-server');
    Route::get('/edit-vps-servers/{vpsServers}', EditVpsServers::class)->name('admin.edit.vps-server');
    Route::get('/vps-server-manager/{vpsServer}', VpsServersManager::class)->name('admin.vps-server-manager');

    Route::get('/servers', AllServers::class)->name('admin.servers');
    Route::get('/create-server', CreateServer::class)->name('admin.create.server');
    Route::get('/edit-server/{server}', EditServer::class)->name('admin.edit.server');

    Route::get('/subServers/{server}', AllSubServers::class)->name('admin.subServers');
    Route::get('/create-sub-server/{server}', CreateSubServer::class)->name('admin.create.sub-server');
    
    Route::get('/transactions', Transactions::class)->name('admin.transactions');
    
    Route::get('/users', Users::class)->name('admin.users');
    Route::get('/create-user', CreateUser::class)->name('admin.create.user');
    Route::get('/edit-user/{user}', EditUser::class)->name('admin.edit.user');
    
    Route::get('/admins', Admins::class)->name('admin.accounts'); 
    
    Route::get('/notifications', Notifications::class)->name('admin.notifications');
    Route::get('/create-notifications', CreateNotification::class)->name('admin.create.notifications');
    Route::get('/edit-notifications/{notification}', EditNotification::class)->name('admin.edit.notifications');
    
    Route::get('/feedback', Feedbacks::class)->name('admin.feedback');
});
