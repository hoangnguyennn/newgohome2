<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('ALTER TABLE posts ADD FULLTEXT(name)');
    }
}
