<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Guarded attributes
    protected $guarded = [];

    // If you have images or files, you might want a method to get the path
    public function getImagePathAttribute($value)
    {
        return $value ? asset('storage/images/' . $value) : asset('images/noimage.jpg');
    }

    // Example of defining a relationship (if your product belongs to a category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Add more methods and properties as needed
}
