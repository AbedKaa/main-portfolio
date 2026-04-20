<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'issuer',
        'issue_date',
        'credential_url',
        'certificate_image',
        'sort_order',
        'is_visible',
    ];
}
