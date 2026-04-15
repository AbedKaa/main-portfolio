<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'tech_stack',
        'github_url',
        'demo_url',
        'cover_image',
        'is_published',
        'is_featured',
        'sort_order',
    ];

    public function images()
    {
        return $this->hasMany(\App\Models\ProjectImage::class)->orderBy('sort_order');
    }
    
}
