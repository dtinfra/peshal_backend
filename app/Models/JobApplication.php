<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'job_listing_id',
    'name',
    'email',
    'phone',
    'resume_path',
    'cover_letter',
    'status'
])]
class JobApplication extends Model
{
    protected $table = 'job_applications';

    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id');
    }
}
