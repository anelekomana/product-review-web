<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
