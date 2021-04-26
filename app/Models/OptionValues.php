<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class OptionValues extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->morphToMany(Product::class, 'productable');
    }
    public function option(){
        return $this->belongsTo('App\Models\Option','option_id');
    }
}
