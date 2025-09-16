<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UsesDynamicSmtp;

class DashboardController extends Controller
{
    use UsesDynamicSmtp;

    public function index()
    {
        return view('admin.dashboard');
    }
}
