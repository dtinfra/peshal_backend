<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'organization',
    'issue_date',
    'expiry_date',
    'credential_id',
    'credential_url',
    'logo'
])]
class Certification extends Model
{
    protected $table = 'certifications';

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'expiry_date' => 'date',
        ];
    }
}
