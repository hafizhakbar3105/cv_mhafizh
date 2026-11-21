<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'profession',
        'headline',
        'tagline',
        'biography',
        'vision',
        'portrait_path',
        'about_image_path',
        'cv_path',
        'email',
        'location',
        'availability_status',
        'social_links',
    ];

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
        ];
    }
}
