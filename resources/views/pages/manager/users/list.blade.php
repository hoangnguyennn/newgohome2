@extends('layouts.admin')

@section('main-content')
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <form method="GET" autocomplete="off">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="me@example.com" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary">Lọc</button>
                                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Xóa bộ lọc</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid my-5">
        <div class="d-flex justify-content-between flex-column flex-md-row mb-4">
            <h3 class="title">Danh sách người dùng</h3>
            <div class="d-flex">
                <a href="{{ route('users.create') }}" class="btn btn-primary">Thêm người dùng mới</a>
            </div>
        </div>

        @if (Auth::user()->isAdmin())
            <div class="d-flex justify-content-start flex-column flex-md-row mb-4">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteMultiple">
                    Xóa nhiều
                </button>
                <div class="modal fade" id="deleteMultiple">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Xóa nhiều người dùng
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('users.deleteMultiple') }}" id="delete-users">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="user-list" class="col-sm-3 col-form-label">Số lượng</label>
                                        <div class="col-sm-9">
                                            <div class="form-control size"><span>0</span> người dùng</div>
                                        </div>
                                    </div>

                                    <div class="userids"></div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" form="delete-users" class="btn btn-danger">Xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        @if (Auth::user()->isAdmin())
                            <td><input type="checkbox"></td>
                        @endif
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
                            @if (Auth::user()->isAdmin())
                                <td><input type="checkbox" value="{{ $user->id }}"></td>
                            @endif
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
                                    } elseif ($user->isEditor()) {
                                        $role = 'Biên tập viên';
                                        $badge = 'badge-warning';
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
                        $colSpan = 9;
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

@section('scripts')
    <script>
        // delete users
        document.querySelectorAll('tr').forEach(function(tr) {
            tr.addEventListener('click', function() {
                const checkbox = tr.querySelector('input');
                checkbox.checked = !checkbox.checked;
                const event = new Event('change');
                checkbox.dispatchEvent(event);
            });
        });

        document.querySelectorAll('input').forEach(function(input) {
            input.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });

        document.querySelector('thead input').addEventListener('change', function() {
            const tbodyInputs = document.querySelectorAll('tbody input[type="checkbox"]');
            let counter = 0;

            tbodyInputs.forEach(input => {
                input.checked && counter++;
            })

            if (counter === tbodyInputs.length) {
                tbodyInputs.forEach(input => {
                    input.checked = false;
                })
            } else {
                tbodyInputs.forEach(input => {
                    input.checked = true;
                })
            }
        });

        document.querySelectorAll('tbody input[type="checkbox"]').forEach(input => {
            input.addEventListener('change', function() {
                const tbodyInputs = document.querySelectorAll('tbody input[type="checkbox"]');
                let counter = 0;

                tbodyInputs.forEach(input => {
                    input.checked && counter++;
                });

                if (counter === tbodyInputs.length) {
                    document.querySelector('thead input').checked = true;
                } else {
                    document.querySelector('thead input').checked = false;
                }
            });
        });

        const transferButton = document.querySelector('[data-target="#deleteMultiple"]');
        const form = document.querySelector('#delete-users');
        transferButton.addEventListener('click', function(event) {
            form.querySelector('.userids').innerHTML = '';
            document.querySelectorAll('tbody input[type="checkbox"]').forEach(input => {
                if (input.checked) {
                    const newInput = document.createElement('input');
                    newInput.type = 'hidden';
                    newInput.name = 'users[]';
                    newInput.value = input.value;
                    form.querySelector('.userids').appendChild(newInput);
                }
            });

            const size = form.querySelectorAll('[name="users[]"]').length;
            form.querySelector('.size span').innerHTML = size;
        });
    </script>
@endsection
