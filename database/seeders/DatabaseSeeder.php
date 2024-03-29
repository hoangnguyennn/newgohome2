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
        $this->call(CategorySeeder::class);
        $this->call(DistrictTypeSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(WardTypeSeeder::class);
        $this->call(WardSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PostRequestTypeSeeder::class);
    }
}
