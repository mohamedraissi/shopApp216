<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class DeliveryAddress extends Model
{
    use HasFactory;

    public static function DeliveryAddress(){
        if(Auth::user()){
        $user_id = Auth::user()->id;
        $deliveryAddresses = DeliveryAddress::where('user_id',$user_id)->get()->toArray();
        return $deliveryAddresses;
    }
    return;
    }
}
