<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NowPageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'building',
        'exploring',
        'learning',
        'reading',
        'history',
        'current_focus',
        'last_updated_at',
    ];

    protected $casts = [
        'building' => 'array',
        'exploring' => 'array',
        'learning' => 'array',
        'reading' => 'array',
        'history' => 'array',
        'last_updated_at' => 'datetime',
    ];
}
