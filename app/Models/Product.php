<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Option;
use App\Models\OptionValues;
class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }
    public function attributes(){
        return $this->hasMany('App\Models\ProductsAttribute');
    }
    public function images(){
        return $this->hasMany('App\Models\productsImage');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand','brand_id');
    }
    public function options()
    {
        return $this->morphedByMany(Option::class, 'productable');
    }
  
    public function values()
    {
        return $this->morphedByMany(OptionValues::class, 'productable');
    }
    public static function productFilters(){
        //product fliler
        $productFilters['fabricArray']=array('cotton','polyester','wool');
        $productFilters['sleeveArray']=array('full seleeve','half seleeve','short seleeve');
        $productFilters['patternArray']=array('checked','plain','printed');
        $productFilters['fitArray']=array('Regular','slim');
        $productFilters['occassionArray']=array('casual','formal'); 
        return $productFilters;
    }
}
