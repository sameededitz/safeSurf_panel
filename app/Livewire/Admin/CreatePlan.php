<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use Livewire\Component;

class CreatePlan extends Component
{
    public $name, $description, $price, $duration, $duration_unit;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:999',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'duration_unit' => 'required|in:day,week,month,year',
        ];
    }

    public function store()
    {
        $this->validate();

        Plan::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'duration_unit' => $this->duration_unit,
        ]);

        $this->dispatch('snackbar', message: 'Plan added successfully!', type: 'success');
        $this->dispatch('redirect', url: route('admin.plans'));
    }

    public function render()
    {
         /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-plan')
        ->extends('layouts.admin')
        ->section('content');
    }
}
