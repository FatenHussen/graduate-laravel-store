<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'company', 'expiration_date','category_id', 'price', 'stock', 'images','ingredients'
    ];

    /**
     * Get the category that owns the product.
     */

     protected $casts = [
        'images' => 'array', // Cast the images JSON column to an array
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Define the relationship with CartItem
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
