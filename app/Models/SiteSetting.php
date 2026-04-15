<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
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
}
