<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'url',
    'referer',
    'ip_address',
    'user_agent',
    'resolved_at'
])]
class ErrorLog extends Model
{
    protected $table = 'error_logs';

    protected function casts(): array
    {
        return [
            'resolved_at' => 'datetime',
        ];
    }
}
