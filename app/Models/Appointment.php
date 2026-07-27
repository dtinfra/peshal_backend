<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'name',
    'email',
    'phone',
    'company',
    'service_id',
    'appointment_date',
    'appointment_time',
    'duration_minutes',
    'meeting_link',
    'status',
    'notes'
])]
class Appointment extends Model
{
    protected $table = 'appointments';

    protected function casts(): array
    {
        return [
            'appointment_date' => 'date:Y-m-d',
            'duration_minutes' => 'integer',
            'service_id' => 'integer',
        ];
    }

    /**
     * Get the consulting service booked.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
