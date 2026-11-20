<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slug
{
    /**
     * Build a slug from $title that is unique in $modelClass's table.
     * Falls back to a random slug when the title has no sluggable characters
     * (e.g. only emoji or symbols).
     *
     * @param  class-string<Model>  $modelClass
     */
    public static function unique(string $modelClass, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: Str::lower(Str::random(8));
        $slug = $base;
        $counter = 2;

        while (
            $modelClass::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }
}
