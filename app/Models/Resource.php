<?php

namespace App\Models;

use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'type',
    'description',
    'file_path',
    'cover_image',
    'download_count',
    'is_active'
])]
class Resource extends Model
{
    use HasSeo;

    protected $table = 'resources';

    protected function casts(): array
    {
        return [
            'download_count' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
