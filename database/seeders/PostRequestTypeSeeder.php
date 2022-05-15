<?php

namespace Database\Seeders;

use App\Models\PostRequestType;
use Illuminate\Database\Seeder;

class PostRequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postRequestTypes = [
            ['Tìm nhà', 'Bạn đang cần tìm bất động sản cho thuê'],
            ['Gửi nhà', 'Bạn có bất động sản và muốn cho thuê'],
        ];

        foreach ($postRequestTypes as $type) {
            $postRequestType = new PostRequestType;
            $postRequestType->name = $type[0];
            $postRequestType->description = $type[1];
            $postRequestType->save();
        }
    }
}
