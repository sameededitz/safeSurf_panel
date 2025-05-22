<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use Livewire\Component;

class CreatePlan extends Component
{
    public $name, $description, $original_price, $discount_price, $duration, $duration_unit;

    public $features = [
        ['title' => '', 'enabled' => true],
    ];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:999',
            'original_price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'duration_unit' => 'required|in:day,week,month,year',
            'features.*.title' => 'required|string|max:255',
            'features.*.enabled' => 'boolean',
        ];
    }

    public function addFeature()
    {
        $this->features[] = ['title' => '', 'enabled' => false];
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function store()
    {
        $this->validate();

        $plan = Plan::create([
            'name' => $this->name,
            'description' => $this->description,
            'original_price' => $this->original_price,
            'discount_price' => $this->discount_price,
            'duration' => $this->duration,
            'duration_unit' => $this->duration_unit,
        ]);

        foreach ($this->features as $feature) {
            $plan->features()->create([
                'title' => $feature['title'],
                'enabled' => $feature['enabled'] ?? false,
            ]);
        }

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
