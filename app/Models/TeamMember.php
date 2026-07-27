<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'designation',
    'avatar',
    'bio',
    'social_links',
    'order'
])]
class TeamMember extends Model
{
    protected $table = 'team_members';

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
            'order' => 'integer',
        ];
    }
}
