<?php

namespace App\Models;

use App\Models\Concerns\Publishable;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use Publishable;

    protected $fillable = [
        'organization',
        'position',
        'location',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'duties',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_current' => 'boolean',
            'duties' => 'array',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
