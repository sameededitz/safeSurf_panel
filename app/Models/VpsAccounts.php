<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpsAccounts extends Model
{
    protected $fillable = [
        'name',
        'vpsserver_id',
        'type',
        'password',
    ];

    public function vpsserver()
    {
        return $this->belongsTo(VpsServer::class, 'vpsserver_id');
    }
}
