<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function subcategories(){
return $this->hasMany('App\Models\Category','parent_id')->where('status',1);
    }
}
