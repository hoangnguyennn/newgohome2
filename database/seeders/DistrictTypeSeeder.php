<?php

namespace Database\Seeders;

use App\Models\DistrictType;
use Illuminate\Database\Seeder;

class DistrictTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districtTypes = ['Thành phố', 'Quận', 'Thị xã', 'Huyện'];

        foreach ($districtTypes as $type) {
            $districtType = new DistrictType;
            $districtType->name = $type;
            $districtType->save();
        }
    }
}
