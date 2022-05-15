<?php

namespace Database\Seeders;

use App\Models\WardType;
use Illuminate\Database\Seeder;

class WardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wardTypes = ['Phường', 'Thị trấn', 'Xã'];

        foreach ($wardTypes as $type) {
            $wardType = new WardType;
            $wardType->name = $type;
            $wardType->save();
        }
    }
}
