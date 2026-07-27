<?php

namespace App\Models;

use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'description',
    'content',
    'icon',
    'is_featured',
    'is_active',
    'order'
])]
class Service extends Model
{
    use HasSeo;

    protected $table = 'services';

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }
}
