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
        $this->call(AhmedSeeder::class);
        $this->call(PermissionTableSeeder::class);
        \App\Models\Employeer::factory(200
        )->create();
        \App\Models\section::factory(20)->create();

        // \App\Models\User::factory(50)->create();
    }
}
