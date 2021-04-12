<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Banner;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecords = [

            ['id' => 1, 'banner_image' => 'banner1.jpg', 'link' => '' ,'title' => 'kid','alt' => 'kid','status' => 1],
            ['id' => 2, 'banner_image' => 'banner2.jpg', 'link' => '' ,'title' => 'women','alt' => 'women','status' => 1]
            
        ];
        Banner::insert($bannerRecords);
    }
}
