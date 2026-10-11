<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCtaSection extends Model
{
    use HasFactory;

    protected $table = 'home_cta_section';

    protected $fillable = [
        'eyebrow',
        'title',
        'subtitle',
        'button_text',
        'button_url',
        'bow_image_path',
        'features',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];
}
