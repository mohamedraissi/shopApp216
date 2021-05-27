<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\DeliveryAddress;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryRecords = [
            ['id' => 2,'user_id' => 2,'name'=> 'Sofienne Bourhaila' ,'address' =>'Test123','city' =>'Kram','state' =>'Tunis' ,
            'country' => 'Tunisia','pincode' => 2015 ,'mobile'=>27270898 , 'status'=>1],
        ];
        DeliveryAddress::insert($deliveryRecords);
    }
}
