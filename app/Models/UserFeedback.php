<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class UserFeedback extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'email',
        'subject',
        'message',
    ];
}
