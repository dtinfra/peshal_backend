<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'email',
    'is_active'
])]
class NewsletterSubscriber extends Model
{
    protected $table = 'newsletter_subscribers';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
