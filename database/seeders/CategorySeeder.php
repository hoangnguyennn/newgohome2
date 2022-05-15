<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Mặt bằng',
            'Căn hộ',
            'Nhà cho thuê',
            'Kho xưởng',
            'Nhà thục',
            'Villa, biệt thự',
            'Studio',
        ];

        foreach ($categories as $categoryInfo) {
            $category = new Category;
            $category->name = $categoryInfo;
            $category->save();
        }
    }
}
