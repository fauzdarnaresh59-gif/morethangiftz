<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSectionProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_product_section_id',
        'title',
        'code',
        'image_path',
        'alt_text',
        'price',
        'whatsapp_message',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(HomeProductSection::class, 'home_product_section_id');
    }
}
