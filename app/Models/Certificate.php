<?php

namespace App\Models;

use App\Models\Concerns\Publishable;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use Publishable;

    protected $fillable = [
        'title',
        'issuer',
        'issue_date',
        'credential_id',
        'credential_url',
        'image_path',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
