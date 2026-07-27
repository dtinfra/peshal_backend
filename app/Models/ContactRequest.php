<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'email',
    'phone',
    'company',
    'message',
    'service_requested',
    'appointment_time',
    'status',
    'notes'
])]
class ContactRequest extends Model
{
    protected $table = 'contact_requests';

    protected function casts(): array
    {
        return [
            'appointment_time' => 'datetime',
        ];
    }
}
