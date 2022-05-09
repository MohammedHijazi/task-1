<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requests')->insert([
            'category'=>'بنزين',
            'quantity_type'=>'liter',
            'quantity'=>10,
            'driver_id'=>1,
            'status'=>'on'
        ]);
        DB::table('requests')->insert([
            'category'=>'بنزين',
            'quantity_type'=>'shekel',
            'quantity'=>1000,
            'driver_id'=>2,
            'status'=>'off'
        ]);
    }
}
