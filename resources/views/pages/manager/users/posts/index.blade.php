@extends('layouts.admin')

@section('main-content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <form action="{{ route('users.posts.index', $user->id) }}" method="GET">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group row">
                                <label for="id" class="col-sm-3 col-form-label">Mã bài đăng</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="id" name="id"
                                        placeholder="GH-xxx" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label">Tiêu đề</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="vd: Căn hộ Mường Thanh" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group row">
                                <label for="phone" class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="0xxxxxxxxx" />
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
                                            <a href="{{ route('users.posts.index', $user->id) }}"
                                                class="btn btn-secondary">Xóa bộ lọc</a>
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
            <h3 class="title">Danh sách bài đăng của {{ $user->fullname }}</h3>
            <div class="d-flex">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại danh sách người dùng</a>
            </div>
        </div>

        <div class="d-flex justify-content-start flex-column flex-md-row mb-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transferPost">
                Chuyển
            </button>
            <button type="button" class="btn btn-secondary ml-2" data-toggle="modal" data-target="#transferPost2">
                Chuyển tất cả
            </button>
            <div class="modal fade" id="transferPost">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Di chuyển bài đăng
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('users.posts.move', $user->id) }}" id="move-posts">
                                @csrf

                                <input type="hidden" name="from" value="{{ $user->id }}" />

                                <div class="form-group row">
                                    <label for="user-list" class="col-sm-3 col-form-label">Từ</label>
                                    <div class="col-sm-9">
                                        <div class="form-control">{{ $user->fullname }} - {{ $user->email }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user-list" class="col-sm-3 col-form-label">Sang</label>
                                    <div class="col-sm-9">
                                        <select name="to" id="user-list" class="form-control" required>
                                            @foreach ($users as $usr)
                                                @if ($usr->id !== $user->id)
                                                    <option value="{{ $usr->id }}">{{ $usr->fullname }} -
                                                        {{ $usr->email }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user-list" class="col-sm-3 col-form-label">Số lượng</label>
                                    <div class="col-sm-9">
                                        <div class="form-control size"><span>0</span> bài đăng</div>
                                    </div>
                                </div>

                                <div class="postids"></div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" form="move-posts" class="btn btn-primary">Chuyển</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="transferPost2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Di chuyển tất cả bài đăng
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('users.posts.move-all', $user->id) }}"
                                id="move-posts2">
                                @csrf

                                <input type="hidden" name="from" value="{{ $user->id }}" />

                                <div class="form-group row">
                                    <label for="user-list" class="col-sm-3 col-form-label">Từ</label>
                                    <div class="col-sm-9">
                                        <div class="form-control">{{ $user->fullname }} - {{ $user->email }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user-list" class="col-sm-3 col-form-label">Sang</label>
                                    <div class="col-sm-9">
                                        <select name="to" id="user-list" class="form-control" required>
                                            @foreach ($users as $usr)
                                                @if ($usr->id !== $user->id)
                                                    <option value="{{ $usr->id }}">{{ $usr->fullname }} -
                                                        {{ $usr->email }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" form="move-posts2" class="btn btn-primary">Chuyển</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td style="min-width: 100px;">#</td>
                        <td style="min-width: 100px;">Hình ảnh</td>
                        <td style="min-width: 200px;">Tiêu đề</td>
                        <td style="min-width: 100px;">Hoa hồng</td>
                        <td style="min-width: 150px;">Tình trạng duyệt</td>
                        <td style="min-width: 130px;">Lý do từ chối</td>
                        <td style="min-width: 355px;">Hành động</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        @php
                            $postId = $post->category->shorthand . '-' . $post->id_by_category;
                        @endphp

                        <tr class="{{ $post->id }}">
                            <td><input type="checkbox" value="{{ $post->id }}"></td>
                            <td>{{ $postId }}</td>
                            <td>
                                @if ($post->images->count() !== 0)
                                    <img src="{{ url('/uploads/' . $post->images[0]->filename) }}"
                                        alt="{{ $post->name }}" class="thumbnail" loading="lazy" />
                                @endif
                            </td>
                            <td>{{ $post->name }}</td>
                            <td class="currency">{{ $post->commission }}</td>
                            <td>
                                @php
                                    if ($post->verify_status == 0) {
                                        $status = 'Đã duyệt';
                                        $badgeClass = 'badge-success';
                                    } elseif ($post->verify_status == 1) {
                                        $status = 'Chờ duyệt';
                                        $badgeClass = 'badge-warning';
                                    } else {
                                        $status = 'Đã bị từ chối';
                                        $badgeClass = 'badge-danger';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                            </td>
                            <td>{{ $post->deny_reason }}</td>
                            <td>
                                <div class="d-flex flex-column flex-lg-row">
                                    <a class="btn btn-success mr-md-2 mb-2" href={{ route('post', $post->slug) }}
                                        target="_blank">Xem</a>

                                    @if (Auth::user()->id == $post->user_id || Auth::user()->isAdmin())
                                        <a class="btn btn-primary mr-md-2 mb-2" href={{ route('posts.edit', $post->id) }}>
                                            Chỉnh sửa
                                        </a>
                                        {{ Form::open([
                                            'route' => ['posts.destroy', $post->id],
                                            'method' => 'delete',
                                            'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa bài đăng ' . $postId . '?");',
                                            'class' => 'm-0 mr-md-2 mb-2',
                                        ]) }}
                                        <button type="submit" class="btn btn-danger w-100">Xóa</button>
                                        {{ Form::close() }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @php
                        if (Auth::user()->isAdmin()) {
                            $colSpan = 11;
                        } else {
                            $colSpan = 10;
                        }
                    @endphp
                    @if ($posts->count() == 0)
                        <tr>
                            <td colspan="{{ $colSpan }}" style="text-align: center;">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="{{ $colSpan }}">{{ $posts->count() }} bài đăng tất cả</td>
                    </tr>
                    <tr>
                        <td colspan="{{ $colSpan }}">
                            <div class="custom-pagination">
                                {{ $posts->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <style>
        @media(max-width: 991.98px) {
            table thead tr td:last-child {
                min-width: 140px !important;
            }
        }

        tr {
            cursor: pointer;
        }
    </style>

    <script>
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

        const transferButton = document.querySelector('[data-target="#transferPost"]');
        const form = document.querySelector('#move-posts');
        transferButton.addEventListener('click', function(event) {
            form.querySelector('.postids').innerHTML = '';
            document.querySelectorAll('tbody input[type="checkbox"]').forEach(input => {
                if (input.checked) {
                    const newInput = document.createElement('input');
                    newInput.type = 'hidden';
                    newInput.name = 'posts[]';
                    newInput.value = input.value;
                    form.querySelector('.postids').appendChild(newInput);
                }
            });

            const size = form.querySelectorAll('[name="posts[]"]').length;
            form.querySelector('.size span').innerHTML = size;
        });
    </script>
@endsection
