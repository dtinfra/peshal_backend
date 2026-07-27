<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'slug',
    'avatar',
    'bio',
    'designation',
    'email',
    'social_links'
])]
class BlogAuthor extends Model
{
    protected $table = 'blog_authors';

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
        ];
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'author_id');
    }
}
