<?php

namespace App\Models;

use App\Models\Concerns\Publishable;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use Publishable;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'summary',
        'content',
        'thumbnail_path',
        'experiment_date',
        'test_result',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'experiment_date' => 'date',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
