<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\coupon;

class couponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponRecords = [

            ['id' => 1, 'coupon_image' => 'coupon1.jpg', 'link' => '' ,'title' => 'kid','alt' => 'kid','status' => 1],
            ['id' => 2, 'coupon_image' => 'coupon2.jpg', 'link' => '' ,'title' => 'women','alt' => 'women','status' => 1]
            
        ];
        coupon::insert($couponRecords);
    }
}
