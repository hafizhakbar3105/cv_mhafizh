<?php

namespace App\Models;

use App\Models\Concerns\Publishable;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use Publishable;

    protected $table = 'educations';

    protected $fillable = [
        'institution',
        'study_program',
        'start_date',
        'end_date',
        'description',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
