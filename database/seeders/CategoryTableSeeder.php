<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  App\Models\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords =[
            ['id'=>1 ,'parent_id'=>0,'section_id'=>1,'category_name'=>'T-shirt','category_image'=>'','category_discount'=>0,
             'description'=>'', 'url'=>'t-shirt','meta_title'=>'','meta_description'=>'','meta_keywords'=>'', 'status'=>1],

             ['id'=>2 ,'parent_id'=>1,'section_id'=>1,'category_name'=>'Casual-T-shirt','category_image'=>'','category_discount'=>0,
             'description'=>'', 'url'=>'casual-T-shirt','meta_title'=>'','meta_description'=>'','meta_keywords'=>'', 'status'=>1],
        ];
        Category::insert($categoryRecords);
    }
}
