<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAboutBanner extends Model
{
    use HasFactory;

    protected $table = 'home_about_banner';

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'alt_text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
