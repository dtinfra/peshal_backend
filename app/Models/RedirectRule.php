<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'source_path',
    'target_path',
    'status_code'
])]
class RedirectRule extends Model
{
    protected $table = 'redirect_rules';

    protected function casts(): array
    {
        return [
            'status_code' => 'integer',
        ];
    }
}
