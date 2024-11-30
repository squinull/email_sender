<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'cc',
        'subject',
        'type',
        'body',
        'uuid',
        'ip',
        'user_agent'
    ];
}
