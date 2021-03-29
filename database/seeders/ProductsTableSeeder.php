<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [ 'id'=>1,'category_id'=>2, 'section_id'=>1, 'product_name'=>'name', 'product_code'=>'D728',
        'product_price'=>199.4, 'product_discount'=>0.3, 'main_image'=>'hhh.jpg', 'product_video'=>'hhh.mp',
        'product_description'=>'','product_meta_description'=>'','product_meta_keyword'=>'','product_previewing'=>'',
        'status'=>1
        
        

        ];
        DB::table('products')->insert($productRecords);
    }
}
