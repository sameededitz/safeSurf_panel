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

    public function logSmtp()
    {
        $this->applySmtpConfig();
        \Illuminate\Support\Facades\Log::info('SMTP log test', [
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'username' => config('mail.mailers.smtp.username'),
            'password' => config('mail.mailers.smtp.password'),
            'from' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
        ]);
        return 'Log test completed';
    }
}
