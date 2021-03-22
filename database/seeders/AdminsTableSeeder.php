<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords =[
            ['id'=>1,'name'=>'admin','type'=>'admin','phone'=>'55005500','email'=>'admin@admin.com',
            'password'=>'$2y$10$JCU1EfM6IRXwv/UJugk6buDAhH4U4asOO9cQci.S57SjC13XdR0vq','image'=>'avatar.png','status'=>1,'role'=>'1' ],
    ];
    DB::table('admins')->insert($adminRecords);
    // foreach($adminRecords as $key =>$record) {
    //     \App\Models\Admin::create($record);
    // } 
    }
}
