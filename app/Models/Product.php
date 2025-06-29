<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'price',
        'brand',
        'ratings',
        'rating_text',
        'savings',
        'features',
        'description',
        'material',
        'dimensions',
        'care_instructions',
        'category',
        'pet_type',
        'sold_count',
        'stock', 
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'ratings' => 'float'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function images()
    {
        return $this->hasMany(Product::class); // adjust the model/class if different
    }

}