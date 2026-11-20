<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    public const CACHE_KEY = 'site_settings';

    protected $fillable = [
        'full_name',
        'availability_status',
        'profile_image',
        'cv_file',
        'headline',
        'bio',
        'github_url',
        'linkedin_url',
        'email',
        'site_title',
        'meta_description',
        'og_image',
        'blog_enabled',
    ];

    protected function casts(): array
    {
        return [
            'blog_enabled' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget(self::CACHE_KEY));
        static::deleted(fn () => Cache::forget(self::CACHE_KEY));
    }

    /**
     * The single settings row, created with defaults if it does not exist yet.
     * Cached so that rendering a page does not query the database repeatedly.
     */
    public static function current(): self
    {
        return once(fn () => Cache::rememberForever(self::CACHE_KEY, fn () => static::firstOrCreate(
            ['id' => 1],
            ['full_name' => 'Your Name', 'blog_enabled' => true],
        )));
    }
}
