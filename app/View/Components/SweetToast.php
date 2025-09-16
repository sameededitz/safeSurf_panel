<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SweetToast extends Component
{
    public $type;
    public $message;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Get toast data from session
        $this->type = session('type');
        $this->message = session('message');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sweet-toast');
    }
}
