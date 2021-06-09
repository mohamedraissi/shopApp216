<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Option extends Model
{
    public function values(){
        return $this->hasMany('App\Models\OptionValues');
    }
    
    public function products()
    {
        return $this->morphToMany(Product::class, 'productable');
    }
    
}
