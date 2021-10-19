<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_id', 'user_id', 'rating', 'review',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
