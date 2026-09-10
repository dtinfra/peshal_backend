<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimelineEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'title',
        'category',
        'description',
        'content',
        'image_url',
        'evidence_url',
        'venture_id',
        'order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function venture()
    {
        return $this->belongsTo(Venture::class);
    }
}
