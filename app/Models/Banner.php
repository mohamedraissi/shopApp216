<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public static function getbanners(){
        $getbanners = banner::where('status',1)->get()->toArray();
        return $getbanners;
    }
}
