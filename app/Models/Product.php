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
    
    public static function getDiscountedPrice($product_id){
        
        $proDetails = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first()->toArray();
        $catDetails = Category  :: select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();
        if($proDetails['product_discount']>0){
                $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $proDetails['product_discount'] / 100);
                
        }else if($catDetails['category_discount']>0){
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $catDetails['category_discount'] / 100);
        }else {
            $discounted_price = 0;
        }
        return $discounted_price;
    }
   
    public static function getDiscountedAttrPrice($product_id,$size){   
        $proAttrPrice  = ProductsAttribute::where(['product_id'=>$product_id,'size'=>$size])->first()->toArray();
        $proDetails = Product::select('product_discount','category_id')->where('id',$product_id)->first()->toArray();
        $catDetails = Category  :: select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();
        if($proDetails['product_discount']>0){
            $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $proDetails['product_discount'] / 100);
            $discount = $proAttrPrice['price'] - $discounted_price;
            
    }else if($catDetails['category_discount']>0){
        $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $catDetails['category_discount'] / 100);
        $discount = $proAttrPrice['price'] - $discounted_price;
    }else {
        $discounted_price = $proAttrPrice['price'];
        $discount = 0;
    }
    return array('product_price'=>$proAttrPrice['price'],'discounted_price'=>$discounted_price,'discount'=>$discount);
    }
}
