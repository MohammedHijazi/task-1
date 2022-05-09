<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drivers')->insert([
           'name'=>'محمد رياض الخضري'
        ]);
        DB::table('drivers')->insert([
            'name'=>'أيمن محمد الديراوي'
        ]);
        DB::table('drivers')->insert([
            'name'=>'محمد أحمد حجازي'
        ]);
    }
}
