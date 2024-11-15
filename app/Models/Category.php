<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'images'];

    /**
     * Get the products for the category.
     */

     protected $casts = [
        'images' => 'array', // Cast the images JSON column to an array
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
