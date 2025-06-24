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
        'stars',
        'rating_text',
        'savings',
        'features',
        'description',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
