<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
{

       // \App\Models\User::factory(10)->create();
        // $this->call(AdminsTableSeeder::class);
        // $this->call(SectionsTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        //$this->call(ProductsTableSeeder::class); 
        //$this->call(BrandsTableSeeder::class); 
        //$this->call(couponsTableSeeder::class);
        //$this->call(ProductsAttributesTableSeeder::class); 
        //$this->call(ProductsImagesTableSeeder::class);       
        // $this->call(couponsTableSeeder::class);  
        //$this->call(DeliveryAddressTableSeeder::class);  
        $this->call(OrderStatusTableSeeder::class);

    }
}
