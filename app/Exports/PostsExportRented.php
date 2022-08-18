<?php

namespace App\Exports;

use App\Models\Post;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PostsExportRented implements FromCollection, WithHeadings, WithMapping
{

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function headings(): array
    {
        return [
            'Mã bài đăng',
            'Tiêu đề',
            'Họ tên chủ nhà',
            'SĐT chủ nhà',
            'Giá trị'
        ];
    }

    public function map($post): array
    {
        return [
            $post->category->shorthand . '-' . $post->id_by_category,
            $post->name,
            $post->owner_name,
            $post->owner_phone,
            $post->price
        ];
    }

    public function collection()
    {
        $user = User::where('id', $this->id)->first();

        if ($user) {
            if ($user->isAdmin()) {
                return Post::where('is_rented', 1)->get();
            } else {
                return Post::where('user_id', $user->id)->where('is_rented', 1)->get();
            }
        }

        return Post::where('id', null)->get();
    }
}
