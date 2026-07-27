<?php

namespace App\Models;

use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'slug',
    'description',
    'parent_id',
    'order'
])]
class BlogCategory extends Model
{
    use HasSeo;

    protected $table = 'blog_categories';

    public function parent(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(BlogCategory::class, 'parent_id')->orderBy('order');
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
