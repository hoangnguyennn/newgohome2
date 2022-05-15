<?php

namespace Database\Seeders;

use App\Models\Ward;
use Illuminate\Database\Seeder;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nhaTrangWards = [
            ['Lộc Thọ', 1],
            ['Ngọc Hiệp', 1],
            ['Phương Sài', 1],
            ['Phương Sơn', 1],
            ['Phước Hòa', 1],
            ['Phước Hải', 1],
            ['Phước Long', 1],
            ['Phước Tiến', 1],
            ['Phước Tân', 1],
            ['Tân Lập', 1],
            ['Vĩnh Hòa', 1],
            ['Vĩnh Hải', 1],
            ['Vĩnh Nguyên', 1],
            ['Vĩnh Phước', 1],
            ['Vĩnh Thọ', 1],
            ['Vĩnh Trường', 1],
            ['Vạn Thạnh', 1],
            ['Vạn Thắng', 1],
            ['Xương Huân', 1],

            ['Phước Đồng', 3],
            ['Vĩnh Hiệp', 3],
            ['Vĩnh Lương', 3],
            ['Vĩnh Ngọc', 3],
            ['Vĩnh Phương', 3],
            ['Vĩnh Thái', 3],
            ['Vĩnh Thạnh', 3],
            ['Vĩnh Trung', 3],
        ];

        foreach ($nhaTrangWards as $wardInfo) {
            $ward = new Ward;
            $ward->name = $wardInfo[0];
            $ward->type_id = $wardInfo[1];
            $ward->district_id = 1;
            $ward->save();
        }

        $camRanhWards = [
            ['Ba Ngòi', 1],
            ['Cam Linh', 1],
            ['Cam Lộc', 1],
            ['Cam Lợi', 1],
            ['Cam Nghĩa', 1],
            ['Cam Phú', 1],
            ['Cam Phúc Bắc', 1],
            ['Cam Phúc Nam', 1],
            ['Cam Thuận', 1],

            ['Cam Bình', 3],
            ['Cam Lập', 3],
            ['Cam Phước Đông', 3],
            ['Cam Thành Nam', 3],
            ['Cam Thịnh Tây', 3],
            ['Cam Thịnh Đông', 3],
        ];

        foreach ($camRanhWards as $wardInfo) {
            $ward = new Ward;
            $ward->name = $wardInfo[0];
            $ward->type_id = $wardInfo[1];
            $ward->district_id = 2;
            $ward->save();
        }

        $ninhHoaWards = [
            ['Ninh Diêm', 1],
            ['Ninh Giang', 1],
            ['Ninh Hiệp', 1],
            ['Ninh Hà', 1],
            ['Ninh Hải', 1],
            ['Ninh Thủy', 1],
            ['Ninh Đa', 1],

            ['Ninh An', 3],
            ['Ninh Bình', 3],
            ['Ninh Hưng', 3],
            ['Ninh Lộc', 3],
            ['Ninh Phú', 3],
            ['Ninh Phước', 3],
            ['Ninh Phụng', 3],
            ['Ninh Quang', 3],
            ['Ninh Sim', 3],
            ['Ninh Sơn', 3],
            ['Ninh Thân', 3],
            ['Ninh Thượng', 3],
            ['Ninh Thọ', 3],
            ['Ninh Trung', 3],
            ['Ninh Tân', 3],
            ['Ninh Tây', 3],
            ['Ninh Vân', 3],
            ['Ninh Xuân', 3],
            ['Ninh Ích', 3],
            ['Ninh Đông', 3],
        ];

        foreach ($ninhHoaWards as $wardInfo) {
            $ward = new Ward;
            $ward->name = $wardInfo[0];
            $ward->type_id = $wardInfo[1];
            $ward->district_id = 3;
            $ward->save();
        }

        $vanNinhWards = [
            ['Vạn Giã', 2],

            ['Vạn Bình', 3],
            ['Vạn Hưng', 3],
            ['Vạn Khánh', 3],
            ['Vạn Long', 3],
            ['Vạn Lương', 3],
            ['Vạn Phú', 3],
            ['Vạn Phước', 3],
            ['Vạn Thạnh', 3],
            ['Vạn Thắng', 3],
            ['Vạn Thọ', 3],
            ['Xuân Sơn', 3],
            ['Đại Lãnh', 3],
        ];

        foreach ($vanNinhWards as $wardInfo) {
            $ward = new Ward;
            $ward->name = $wardInfo[0];
            $ward->type_id = $wardInfo[1];
            $ward->district_id = 4;
            $ward->save();
        }

        $dienKhanhWards = [
            ['Diên Khánh', 2],

            ['Bình Lộc', 3],
            ['Diên An', 3],
            ['Diên Hòa', 3],
            ['Diên Lâm', 3],
            ['Diên Lạc', 3],
            ['Diên Phú', 3],
            ['Diên Phước', 3],
            ['Diên Sơn', 3],
            ['Diên Thạnh', 3],
            ['Diên Thọ', 3],
            ['Diên Toàn', 3],
            ['Diên Tân', 3],
            ['Diên Xuân', 3],
            ['Diên Điền', 3],
            ['Diên Đồng', 3],
            ['Suối Hiệp', 3],
            ['Suối Tiên', 3],
        ];

        foreach ($dienKhanhWards as $wardInfo) {
            $ward = new Ward;
            $ward->name = $wardInfo[0];
            $ward->type_id = $wardInfo[1];
            $ward->district_id = 5;
            $ward->save();
        }

        $khanhVinhWards = [
            ['Khánh Vĩnh', 2],

            ['Cầu Bà', 3],
            ['Giang Ly', 3],
            ['Khánh Bình', 3],
            ['Khánh Hiệp', 3],
            ['Khánh Nam', 3],
            ['Khánh Phú', 3],
            ['Khánh Thành', 3],
            ['Khánh Thượng', 3],
            ['Khánh Trung', 3],
            ['Khánh Đông', 3],
            ['Liên Sang', 3],
            ['Sông Cầu', 3],
            ['Sơn Thái', 3],
        ];

        foreach ($khanhVinhWards as $wardInfo) {
            $ward = new Ward;
            $ward->name = $wardInfo[0];
            $ward->type_id = $wardInfo[1];
            $ward->district_id = 6;
            $ward->save();
        }

        $khanhSonWards = [
            ['Tô Hạp', 2],

            ['Ba Cụm Bắc', 3],
            ['Ba Cụm Nam', 3],
            ['Sơn Bình', 3],
            ['Sơn Hiệp', 3],
            ['Sơn Lâm', 3],
            ['Sơn Trung', 3],
            ['Thành Sơn', 3],
        ];

        foreach ($khanhSonWards as $wardInfo) {
            $ward = new Ward;
            $ward->name = $wardInfo[0];
            $ward->type_id = $wardInfo[1];
            $ward->district_id = 7;
            $ward->save();
        }

        $camLamWards = [
            ['Cam Đức', 2],

            ['Cam An Bắc', 3],
            ['Cam An Nam', 3],
            ['Cam Hiệp Bắc', 3],
            ['Cam Hiệp Nam', 3],
            ['Cam Hòa', 3],
            ['Cam Hải Tây', 3],
            ['Cam Hải Đông', 3],
            ['Cam Phước Tây', 3],
            ['Cam Thành Bắc', 3],
            ['Cam Tân', 3],
            ['Suối Cát', 3],
            ['Suối Tân', 3],
            ['Sơn Tân', 3],
        ];

        foreach ($camLamWards as $wardInfo) {
            $ward = new Ward;
            $ward->name = $wardInfo[0];
            $ward->type_id = $wardInfo[1];
            $ward->district_id = 8;
            $ward->save();
        }

        $truongSaWards = [
            ['Trường Sa', 2],
            ['Sinh Tồn', 3],
            ['Song Tử Tây', 3],
        ];

        foreach ($truongSaWards as $wardInfo) {
            $ward = new Ward;
            $ward->name = $wardInfo[0];
            $ward->type_id = $wardInfo[1];
            $ward->district_id = 9;
            $ward->save();
        }
    }
}
