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
                        <td style="min-width: 100px;">Họ và tên</td>
                        <td style="min-width: 100px;">Email</td>
                        <td style="min-width: 100px;">Vai trò</td>
                        <td style="min-width: 100px;">Ngày tạo</td>
                        <td style="min-width: 140px;">Ngày cập nhật</td>
                        <td style="min-width: 240px;">Hành động</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
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
                                    @if (!$user->isAdmin())
                                        <a class="btn btn-primary mr-md-2 mb-2"
                                            href={{ route('users.edit', $user->id) }}>Chỉnh sửa</a>
                                    @endif

                                    <button class="btn btn-secondary mr-md-2 mb-2" data-toggle="modal"
                                        data-target="#move-posts-{{ $user->id }}">
                                        Chuyển bài sang người khác
                                    </button>

                                    <div class="modal fade" id="move-posts-{{ $user->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Di chuyển bài đăng
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('users.move-posts') }}"
                                                        id="move-posts-form-{{ $user->id }}">
                                                        @csrf

                                                        <input type="hidden" name="from" value="{{ $user->id }}" />

                                                        <div class="form-group row">
                                                            <label for="user-{{ $user->id }}"
                                                                class="col-sm-3 col-form-label">Người dùng</label>
                                                            <div class="col-sm-9">
                                                                <select name="to" id="user-{{ $user->id }}"
                                                                    class="form-control" required>
                                                                    @foreach ($users2 as $usr)
                                                                        @if ($usr->id !== $user->id)
                                                                            <option value="{{ $usr->id }}">
                                                                                {{ $usr->fullname }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Đóng</button>
                                                    <button type="submit" form="move-posts-form-{{ $user->id }}"
                                                        class="btn btn-primary">Chuyển</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
