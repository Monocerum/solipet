<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'price',
        'ratings',
        'rating_text',
        'savings',
        'features',
        'description',
        'care_instructions',
        'category',
        'sold_count',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
