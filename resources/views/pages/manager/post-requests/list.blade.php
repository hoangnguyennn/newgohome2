@extends('layouts.admin')

@section('main-content')
    <div class="container-fluid my-5">
        <div class="d-flex justify-content-between flex-column flex-md-row mb-4">
            <h3 class="title">Danh sách yêu cầu</h3>
            <div class="d-flex">
                <a href="{{ route('api.post-requests.export') }}" class="btn btn-success mr-2">Xuất Excel</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td style="min-width: 100px;">#</td>
                        <td style="min-width: 160px;">Tên người yêu cầu</td>
                        <td style="min-width: 120px;">Số điện thoại</td>
                        <td style="min-width: 100px;">Lời nhắn</td>
                        <td style="min-width: 150px;">Loại</td>
                        <td style="min-width: 130px;">Trạng thái</td>
                        <td style="min-width: 100px;">Ngày tạo</td>
                        <td style="min-width: 140px;">Ngày cập nhật</td>
                        <td style="min-width: 250px;">Hành động</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($postRequests as $postRequest)
                        <tr>
                            <td>{{ $postRequest->id }}</td>
                            <td>{{ $postRequest->name }}</td>
                            <td>{{ $postRequest->phone }}</td>
                            <td>{{ $postRequest->message }}</td>
                            <td>
                                @php
                                    if ($postRequest->type_id == 1) {
                                        $badge = 'badge-primary';
                                    } elseif ($postRequest->type_id == 2) {
                                        $badge = 'badge-success';
                                    } else {
                                        $badge = 'badge-secondary';
                                    }
                                @endphp
                                <span class="badge {{ $badge }}">{{ $postRequest->type->name }}</span>
                            </td>
                            <td>
                                @php
                                    if ($postRequest->is_read) {
                                        $label = 'Đã xem';
                                        $badge = 'badge-secondary';
                                    } else {
                                        $label = 'Chưa xem';
                                        $badge = 'badge-primary';
                                    }
                                @endphp
                                <span class="badge {{ $badge }}">{{ $label }}</span>
                            </td>
                            @php
                                $created_at = $postRequest->created_at;
                                $created_at->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
                                $updated_at = $postRequest->updated_at;
                                $updated_at->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
                            @endphp
                            <td>
                                <span>{{ $created_at->format('H:i:s') }}</span>
                                <span>{{ $created_at->format('d/m/Y') }}</span>
                            </td>
                            <td>
                                <span>{{ $updated_at->format('H:i:s') }}</span>
                                <span>{{ $updated_at->format('d/m/Y') }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column flex-lg-row">
                                    {{ Form::open([
                                        'route' => ['post-requests.destroy', $postRequest->id],
                                        'method' => 'delete',
                                        'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa yêu cầu ' . $postRequest->id . '?");',
                                        'class' => 'm-0',
                                    ]) }}
                                    <button type="submit" class="btn btn-danger mr-md-2 mb-2 w-100">Xóa</button>
                                    {{ Form::close() }}

                                    @if ($postRequest->is_read == false)
                                        {{ Form::open([
                                            'route' => ['post-requests.read', $postRequest->id],
                                            'method' => 'post',
                                            'class' => 'm-0 ml-md-2',
                                        ]) }}
                                        <button type="submit" class="btn btn-secondary mr-md-2 mb-2 w-100">Đánh dấu đã
                                            xem</button>
                                        {{ Form::close() }}
                                    @else
                                        {{ Form::open([
                                            'route' => ['post-requests.unread', $postRequest->id],
                                            'method' => 'post',
                                            'class' => 'm-0 ml-md-2',
                                        ]) }}
                                        <button type="submit" class="btn btn-secondary mr-md-2 mb-2 w-100">Đánh dấu chưa
                                            xem</button>
                                        {{ Form::close() }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @php
                        $colSpan = 9;
                    @endphp
                    @if ($postRequests->count() == 0)
                        <tr>
                            <td colspan="{{ $colSpan }}" style="text-align: center;">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="{{ $colSpan }}">{{ $postRequests->count() }} yêu cầu tất cả</td>
                    </tr>
                    <tr>
                        <td colspan="{{ $colSpan }}">
                            <div class="custom-pagination">
                                {{ $postRequests->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
