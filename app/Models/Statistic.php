<?php

namespace App\Models;

use App\Models\Concerns\Publishable;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use Publishable;

    protected $fillable = [
        'label',
        'value',
        'unit',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'integer',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
