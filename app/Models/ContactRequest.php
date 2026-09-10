<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $table = 'contact_requests';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'phone_whatsapp',
        'company',
        'country',
        'website',
        'industry',
        'lead_category',
        'budget_range',
        'timeline',
        'message',
        'service_requested',
        'appointment_time',
        'routed_to',
        'status',
        'notes'
    ];

    protected function casts(): array
    {
        return [
            'appointment_time' => 'datetime',
        ];
    }
}
