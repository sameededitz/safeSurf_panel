<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    protected $fillable = [
        'plan_id',
        'title',
        'enabled',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
