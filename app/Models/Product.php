<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
