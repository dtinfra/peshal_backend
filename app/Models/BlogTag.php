<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'name',
    'slug'
])]
class BlogTag extends Model
{
    protected $table = 'blog_tags';

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class, 'blog_tag_post', 'tag_id', 'blog_id');
    }
}
