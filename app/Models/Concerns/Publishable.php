<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

/**
 * Scope bersama untuk konten yang punya kolom is_published dan sort_order.
 * Query publik wajib memakai published() agar konten draf tidak pernah tampil.
 */
trait Publishable
{
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
