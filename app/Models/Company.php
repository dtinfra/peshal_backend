<?php

namespace App\Models;

use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'slug',
    'logo',
    'description',
    'content',
    'website_url',
    'services',
    'locations',
    'is_active',
    'order',
    'story',
    'mission',
    'technologies',
    'industries',
    'faqs',
    'related_services'
])]
class Company extends Model
{
    use HasSeo;

    protected $table = 'companies';

    protected function casts(): array
    {
        return [
            'services' => 'array',
            'locations' => 'array',
            'is_active' => 'boolean',
            'order' => 'integer',
            'technologies' => 'array',
            'industries' => 'array',
            'faqs' => 'array',
            'related_services' => 'array',
        ];
    }
}
