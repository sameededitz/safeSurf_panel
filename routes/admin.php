<?php

use App\Http\Controllers\admin\DashboardController;
use App\Livewire\Admin\AllPlans;
use App\Livewire\Admin\CreatePlan;
use Illuminate\Support\Facades\Route;


Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/plans', AllPlans::class)->name('admin.plans');
Route::get('/create/plan', CreatePlan::class)->name('admin.create.plan');