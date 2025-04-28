<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;

class AllPlans extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $priceFilter = '';
    public $durationFilter = '';

    public function updateingSearch()
    {
        $this->resetPage();
    }
    public function updateingPriceFilter()
    {
        $this->resetPage();
    }
    public function updateingDurationFilter()
    {
        $this->resetPage();
    }
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function deletePlan($planId)
    {
        $plan = Plan::findOrFail($planId);
        $plan->delete();
        $this->dispatch('sweetAlert', title: 'Deleted!', message: 'Plan has been deleted successfully.', type: 'success');
    }
    public function render()
    {
        $plans = Plan::query()
        ->when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->when($this->priceFilter, function ($query) {
            $query->where('price', $this->priceFilter);
        })
        ->when($this->durationFilter, function ($query) {
            $query->where('duration', $this->durationFilter);
        })
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);
        // dd($plans);
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.all-plans', compact('plans'))
        ->extends('layouts.admin')
        ->section('content');
    }
}
