<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailManager extends Model
{
    protected $fillable = [
        'host',
        'port',
        'username',
        'password',
        'address',
        'name',
    ];
}
