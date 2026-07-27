<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'title',
    'slug',
    'department',
    'location',
    'description',
    'requirements',
    'benefits',
    'salary_range',
    'type',
    'status',
    'expires_at'
])]
class JobListing extends Model
{
    protected $table = 'job_listings';

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class, 'job_listing_id');
    }
}
