<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Add 'category_id' to your $fillable array
    protected $fillable = [
        'name', 'brand', 'price', 'description', 'image', 'stock', 'category_id'
    ];

    
}
