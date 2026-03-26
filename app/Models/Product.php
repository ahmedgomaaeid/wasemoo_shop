<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id', 'name', 'slug', 'description', 
        'price', 'discount_price',        'image_path',
        'is_latest',
        'product_link',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
