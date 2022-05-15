<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            ['Nha Trang', 1],
            ['Cam Ranh', 1],

            ['Ninh Hòa', 3],

            ['Vạn Ninh', 4],
            ['Diên Khánh', 4],
            ['Khánh Vĩnh', 4],
            ['Khánh Sơn', 4],
            ['Cam Lâm', 4],
            ['Trường Sa', 4],
        ];

        foreach ($districts as $districtInfo) {
            $district = new District;
            $district->name = $districtInfo[0];
            $district->type_id = $districtInfo[1];
            $district->save();
        }
    }
}
