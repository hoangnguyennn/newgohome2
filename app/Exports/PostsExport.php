<?php

namespace App\Exports;

use App\Models\Post;
use App\Models\User;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PostsExport implements FromCollection, WithHeadings, WithMapping
{

    public function __construct(int $id, string $month)
    {
        $this->id = $id;
        $this->month = $month;
    }
    public function headings(): array
    {
        return [
            'Mã bài đăng',
            'Tiêu đề',
            'Loại',
            'Quận/huyện',
            'Xã/phường',
            'Người đăng',
            'Hoa hồng',
            'Họ tên chủ nhà',
            'SĐT chủ nhà',
            'Địa chỉ chủ nhà',
            'Ngày tạo',
            'Ngày cập nhập',
        ];
    }

    public function map($post): array
    {
        return [
            $post->category->shorthand . '-' . $post->id_by_category,
            $post->name,
            $post->category->name,
            $post->ward->district->name,
            $post->ward->name,
            $post->user ? $post->user->fullname : '',
            $post->commission,
            $post->owner_name,
            $post->owner_phone,
            $post->owner_address,
            $post->created_at,
            $post->updated_at,
        ];
    }

    public function collection()
    {
        $user = User::where('id', $this->id)->first();
        $date = new DateTime();
        $now = new DateTime();
        $date->setDate(date('Y'), $this->month, date('d'));

        if ($date > $now) {
            $date->modify('-1 year');
        }

        if ($user) {
            if ($user->isAdmin()) {
                return Post::whereMonth('updated_at', $date->format('m'))
                    ->whereYear('updated_at', $date->format('o'))
                    ->get();
            } else {
                return Post::where('user_id', $user->id)
                    ->whereMonth('updated_at', $date->format('m'))
                    ->whereYear('updated_at', $date->format('o'))
                    ->get();
            }
        }

        return Post::where('id', null)->get();
    }
}
