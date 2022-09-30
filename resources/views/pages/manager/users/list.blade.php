@extends('layouts.admin')

@section('main-content')
    <div class="container-fluid my-5">
        <div class="d-flex justify-content-between flex-column flex-md-row mb-4">
            <h3 class="title">Danh sách người dùng</h3>
            <div class="d-flex">
                <a href="{{ route('users.create') }}" class="btn btn-primary">Thêm người dùng mới</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td style="min-width: 100px;">#</td>
                        <td style="min-width: 100px;">Avatar</td>
                        <td style="min-width: 100px;">Họ và tên</td>
                        <td style="min-width: 100px;">Email</td>
                        <td style="min-width: 100px;">Vai trò</td>
                        <td style="min-width: 100px;">Xác thực</td>
                        <td style="min-width: 100px;">Ngày tạo</td>
                        <td style="min-width: 140px;">Ngày cập nhật</td>
                        <td style="min-width: 240px;">Hành động</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                @php
                                    $url = $user->avatar ? url('/avatars/' . $user->avatar) : '';
                                @endphp
                                @if ($url)
                                    <img src="{{ $url }}" alt="{{ $user->name }}" width="100" />
                                @endif
                            </td>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @php
                                    if ($user->isAdmin()) {
                                        $role = 'Quản trị viên';
                                        $badge = 'badge-primary';
                                    } else {
                                        $role = 'Người dùng';
                                        $badge = 'badge-secondary';
                                    }
                                @endphp
                                <span class="badge {{ $badge }}">{{ $role }}</span>
                            </td>
                            <td>
                                @php
                                    if ($user->is_verify) {
                                        $text = 'Đã xác thực';
                                        $badge = 'badge-success';
                                    } else {
                                        $text = 'Chưa xác thực';
                                        $badge = 'badge-warning';
                                    }
                                @endphp
                                <span class="badge {{ $badge }}">{{ $text }}</span>
                            </td>
                            @php
                                $created_at = $user->created_at;
                                $created_at->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
                                $updated_at = $user->updated_at;
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
                                    @if (Auth::user()->isRoot() || !$user->isAdmin())
                                        <a class="btn btn-primary mr-md-2 mb-2" href={{ route('users.edit', $user->id) }}>
                                            Chỉnh sửa
                                        </a>
                                        @if ($user->is_verify == false)
                                            {{ Form::open([
                                                'route' => ['users.verify', $user->id],
                                                'method' => 'post',
                                                'onsubmit' => 'return confirm("Xác thực người dùng ' . $user->id . '?");',
                                                'class' => 'm-0 mr-md-2',
                                            ]) }}
                                            <button type="submit" class="btn btn-success mr-md-2 mb-2 w-100">
                                                Xác thực
                                            </button>
                                            {{ Form::close() }}
                                        @endif
                                    @endif

                                    <a href="{{ route('users.posts.index', $user->id) }}"
                                        class="btn btn-secondary mr-md-2 mb-2">Bài đăng</a>

                                    @if (Auth::user()->id != $user->id && !$user->isAdmin())
                                        {{ Form::open([
                                            'route' => ['users.destroy', $user->id],
                                            'method' => 'delete',
                                            'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa người dùng ' . $user->id . '?");',
                                            'class' => 'm-0',
                                        ]) }}
                                        <button type="submit" class="btn btn-danger mr-md-2 mb-2 w-100">Xóa</button>
                                        {{ Form::close() }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @php
                        $colSpan = 7;
                    @endphp
                    @if ($users->count() == 0)
                        <tr>
                            <td colspan="{{ $colSpan }}" style="text-align: center;">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="{{ $colSpan }}">{{ $users->count() }} người dùng tất cả</td>
                    </tr>
                    <tr>
                        <td colspan="{{ $colSpan }}">{{ $users->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
