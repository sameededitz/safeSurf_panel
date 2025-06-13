<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use Livewire\Component;

class EditPlan extends Component
{
    public Plan $plan;
    public $name, $description, $original_price, $discount_price, $duration, $duration_unit, $device_limit;

    public $features = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:999',
            'original_price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'duration_unit' => 'required|in:day,week,month,year',
            'device_limit' => 'required|integer|min:1',
            'features.*.title' => 'required|string|max:255',
            'features.*.enabled' => 'boolean',
        ];
    }

    public function mount(Plan $plan)
    {
        $this->plan = $plan;
        $this->name = $plan->name;
        $this->description = $plan->description;
        $this->original_price = $plan->original_price;
        $this->discount_price = $plan->discount_price;
        $this->duration = $plan->duration;
        $this->duration_unit = $plan->duration_unit;
        $this->device_limit = $plan->device_limit;
        // Initialize features
        $this->features = $plan->features->map(function ($feature) {
            return [
                'id' => $feature->id,
                'title' => $feature->title,
                'enabled' => $feature->enabled,
            ];
        })->toArray();
    }

    public function addFeature()
    {
        $this->features[] = ['title' => '', 'enabled' => false];
    }

    public function removeFeature($index)
    {
        if (isset($this->features[$index]['id'])) {
            // Delete from DB on save instead
            $this->features[$index]['_delete'] = true;
        } else {
            unset($this->features[$index]);
        }

        $this->features = array_values($this->features);
    }

    public function update()
    {
        $this->validate();

        $this->plan->update([
            'name' => $this->name,
            'description' => $this->description,
            'original_price' => $this->original_price,
            'discount_price' => $this->discount_price,
            'duration' => $this->duration,
            'duration_unit' => $this->duration_unit,
            'device_limit' => (int) $this->device_limit,
        ]);

        foreach ($this->features as $featureData) {
            if (!empty($featureData['_delete'])) {
                if (isset($featureData['id'])) {
                    $this->plan->features()->where('id', $featureData['id'])->delete();
                }
                continue;
            }

            if (isset($featureData['id'])) {
                $this->plan->features()->where('id', $featureData['id'])->update([
                    'title' => $featureData['title'],
                    'enabled' => $featureData['enabled'],
                ]);
            } else {
                $this->plan->features()->create([
                    'title' => $featureData['title'],
                    'enabled' => $featureData['enabled'],
                ]);
            }
        }

        $this->dispatch('sweetAlert', title: 'Updated', message: 'Plan updated successfully!', type: 'success');
        $this->dispatch('redirect', url: route('admin.plans'));
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.edit-plan')
            ->extends('layouts.admin')
            ->section('content');
    }
}
