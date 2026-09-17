<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_key',
        'label',
        'url',
        'parent_id',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function children()
    {
        return $this->hasMany(SiteMenu::class, 'parent_id')->orderBy('order', 'asc');
    }
}
