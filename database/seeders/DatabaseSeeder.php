<?php

namespace Database\Seeders;

use http\Env\Response;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seصeder;

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
        $this->call([
           DriversTableSeeder::class,
            RequestsTableSeeder::class,
        ]);
    }
}
