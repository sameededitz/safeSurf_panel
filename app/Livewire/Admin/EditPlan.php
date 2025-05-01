<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use Livewire\Component;

class EditPlan extends Component
{
    public Plan $plan;
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

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
        $this->name = $plan->name;
        $this->description = $plan->description;
        $this->price = $plan->price;
        $this->duration = $plan->duration;
        $this->duration_unit = $plan->duration_unit;
    }

    public function update()
    {
        $this->validate();

        $this->plan->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'duration_unit' => $this->duration_unit,
        ]);

        $this->dispatch('snackbar', message: 'Plan updated successfully!', type: 'success');
        $this->dispatch('redirect', url: route('admin.edit.plan'));
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.edit-plan')
        ->extends('layouts.admin')
        ->section('content');
    }
}
