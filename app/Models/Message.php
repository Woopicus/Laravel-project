<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'type',
        'subject',
        'content',
        'date',
        'sender_name',
        'processed_at',
        'handler',
    ];

    protected $casts = [
        'date' => 'datetime',
        'processed_at' => 'datetime',
    ];
}
