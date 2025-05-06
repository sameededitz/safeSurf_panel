<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailManager extends Model
{
    protected $fillable = [
        'mailer',
        'scheme',
        'host',
        'port',
        'username',
        'password',
        'address',
        'name',
    ];
}
