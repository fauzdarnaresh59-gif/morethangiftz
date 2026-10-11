<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeTrustItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon_path',
        'title',
        'subtitle',
        'stars',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
