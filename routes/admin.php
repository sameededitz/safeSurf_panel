<?php

use App\Http\Controllers\admin\DashboardController;
use App\Livewire\Admin\Admins;
use App\Livewire\Admin\AllPlans;
use App\Livewire\Admin\AllServers;
use App\Livewire\Admin\AllSubServers;
use App\Livewire\Admin\CheckServerAccount;
use App\Livewire\Admin\CreateAdmin;
use App\Livewire\Admin\CreateNotification;
use App\Livewire\Admin\CreatePlan;
use App\Livewire\Admin\CreateServer;
use App\Livewire\Admin\CreateServersAccounts;
use App\Livewire\Admin\CreateSubServer;
use App\Livewire\Admin\CreateUser;
use App\Livewire\Admin\CreateVpsServers;
use App\Livewire\Admin\EditNotification;
use App\Livewire\Admin\EditPlan;
use App\Livewire\Admin\EditServer;
use App\Livewire\Admin\EditSubServer;
use App\Livewire\Admin\EditUser;
use App\Livewire\Admin\EditVpsServers;
use App\Livewire\Admin\Feedbacks;
use App\Livewire\Admin\MailConfig;
use App\Livewire\Admin\Notifications;
use App\Livewire\Admin\ServersAccounts;
use App\Livewire\Admin\TicketDetails;
use App\Livewire\Admin\Tickets;
use App\Livewire\Admin\Tos;
use App\Livewire\Admin\Transactions;
use App\Livewire\Admin\UserManager;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\VpsServers;
use App\Livewire\Admin\VpsServersManager;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
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
    Route::get('/servers-accounts', ServersAccounts::class)->name('admin.servers.accounts');
    Route::get('/check-servers-accounts/{vpsAccount}', CheckServerAccount::class)->name('admin.check.servers.accounts');
    Route::get('/create-servers-accounts', CreateServersAccounts::class)->name('admin.create.servers.accounts');

    Route::get('/subServers/{server}', AllSubServers::class)->name('admin.subServers');
    Route::get('/create-sub-server/{server}', CreateSubServer::class)->name('admin.create.sub-server');
    // Make sure EditSubServer component accepts 'server' and 'subServer' as route parameters
    Route::get('/edit-sub-server/{subServer}', EditSubServer::class)->name('admin.edit.sub-server');

    Route::get('/transactions', Transactions::class)->name('admin.transactions');

    Route::get('/users', Users::class)->name('admin.users');
    Route::get('/user-manager/{user:slug}', UserManager::class)->name('admin.user.manager');
    Route::get('/create-user', CreateUser::class)->name('admin.create.user');
    Route::get('/edit-user/{user}', EditUser::class)->name('admin.edit.user');

    Route::get('/admins', Admins::class)->name('admin.accounts');
    Route::get('/create-admins', CreateAdmin::class)->name('admin.create.admin.account');

    Route::get('/notifications', Notifications::class)->name('admin.notifications');
    Route::get('/create-notifications', CreateNotification::class)->name('admin.create.notifications');
    Route::get('/edit-notifications/{notification}', EditNotification::class)->name('admin.edit.notifications');

    Route::get('/feedback', Feedbacks::class)->name('admin.feedback');
    Route::get('/mail-manage', MailConfig::class)->name('admin.mail-manage');
    Route::get('/tos', Tos::class)->name('admin.tos');
    Route::get('/tickets', Tickets::class)->name('admin.tickets');
    Route::get('/tickets-details/{ticketId}', TicketDetails::class)->name('admin.tickets.details');
});
