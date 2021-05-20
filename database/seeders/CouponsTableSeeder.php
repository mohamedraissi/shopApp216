<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\coupon;  

class couponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponRecords =[
            ['id'=>1,'coupon_option'=>'Manual','coupon_code'=>'test10','categories'=>'1,2','users'=>'sofienne@shop.com'
            ,'coupon_type'=>'Single','amount_type'=>'Percentage','amount'=>'10','expiry_date'=>'2021-12-31','status'=>1]
        ];
        coupon::insert($couponRecords);
    }
}
