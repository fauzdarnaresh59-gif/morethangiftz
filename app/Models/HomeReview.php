<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'time',
        'avatar',
        'stars',
        'review_text',
        'platform',
        'platform_icon',
        'link_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
