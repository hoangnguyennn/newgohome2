<?php

namespace App\Exports;

use App\Models\PostRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PostRequestsExport implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'Mã yêu cầu',
            'Tên người yêu cầu',
            'Số điện thoại',
            'Lời nhắn',
            'Loại yêu cầu',
            'Trạng thái',
            'Ngày tạo',
            'Ngày cập nhật',
        ];
    }

    public function map($postRequest): array
    {
        return [
            $postRequest->id,
            $postRequest->name,
            $postRequest->phone,
            $postRequest->message,
            $postRequest->type->name,
            $postRequest->is_read ? 'Đã xem' : 'Chưa xem',
            $postRequest->created_at,
            $postRequest->updated_at,
        ];
    }

    public function collection()
    {
        return PostRequest::all();
    }
}
