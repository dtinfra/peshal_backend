<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'question',
    'answer',
    'category_key',
    'page_slug',
    'order'
])]
class Faq extends Model
{
    protected $table = 'faqs';

    protected function casts(): array
    {
        return [
            'order' => 'integer',
        ];
    }
}
