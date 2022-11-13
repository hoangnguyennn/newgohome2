@extends('layouts.admin')

@section('main-content')
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <form action="{{ route('posts.index') }}" method="GET">
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
                        <div class="col-12 col-lg-6">
                            <div class="form-group row">
                                <label for="category" class="col-sm-3 col-form-label">Loại nhà đất</label>
                                <div class="col-sm-9">
                                    @include('components.common.multiple-select', [
                                        'classes' => 'form-control',
                                        'name' => 'category[]',
                                        'items' => $categories->map(function ($item) {
                                            $item->render_name = $item->name;
                                            return $item;
                                        }),
                                        'nonSelectedText' => 'Loại nhà đất',
                                        'nSelectedText' => ' loại được chọn',
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group row">
                                <label for="location" class="col-sm-3 col-form-label">Khu vực</label>
                                <div class="col-sm-9">
                                    @include('components.common.multiple-select', [
                                        'classes' => 'form-control',
                                        'name' => 'location[]',
                                        'items' => $wards->map(function ($item) {
                                            $item->render_name = $item->district->name . ' - ' . $item->name;
                                            return $item;
                                        }),
                                        'selected' => $wards->map(function ($location) {
                                            return in_array($location->id, request()->input('location') ?? [])
                                                ? 'selected'
                                                : '';
                                        }),
                                        'nonSelectedText' => 'Khu vực',
                                        'nSelectedText' => ' khu vực được chọn',
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group row">
                                <label for="location" class="col-sm-3 col-form-label">Giá tiền</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="price" name="price"
                                        placeholder="xxx-xxx" />
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
                                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Xóa bộ lọc</a>
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

    @if (Auth::user()->isAdmin())
        <div class="container-fluid my-5">
            <h3 class="title">Số lượng bài đăng</h3>

            <ul>
                @php
                    $total = 0;
                @endphp
                @foreach ($postsCount as $postCount)
                    @php
                        $total += $postCount->total;
                    @endphp
                    <li>
                        <span>{{ $postCount->category->name }}: </span>
                        <span>{{ $postCount->total }}</span>
                    </li>
                @endforeach
                <li>
                    <span>Tổng: </span>
                    <span>{{ $total }}</span>
                </li>
            </ul>
        </div>
    @endif

    <div class="container-fluid my-5">
        <div class="d-flex justify-content-between flex-column flex-md-row mb-4">
            <h3 class="title">Danh sách bài đăng</h3>
            <div class="d-flex align-items-center">
                <form action={{ route('api.posts.export') }} method="post" class="d-flex align-items-center mb-0">
                    @csrf

                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                    <select class="form-control mr-2" id="month" name="month"></select>
                    <script>
                        const select = document.querySelector('#month');
                        const date = new Date();
                        let counter = 0;
                        while (counter < 12) {
                            counter++;
                            const option = document.createElement('option');
                            const month = `00${date.getMonth() + 1}`.slice(-2);
                            const year = date.getFullYear();
                            option.value = month;
                            option.innerHTML = `Tháng ${month}/${year}`;
                            select.appendChild(option);
                            date.setMonth(date.getMonth() - 1);
                        }
                    </script>
                    <button type="submit" class="btn btn-success mr-2" style="white-space: nowrap;">
                        Xuất Excel
                    </button>
                </form>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Thêm bài đăng mới</a>
            </div>
        </div>

        @if (Auth::user()->isAdmin())
            <div class="d-flex justify-content-start flex-column flex-md-row mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transferPost">
                    Chuyển
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
                                <form method="POST" action="{{ route('posts.move') }}" id="move-posts">
                                    @csrf

                                    {{-- <input type="hidden" name="from" value="{{ $user->id }}" /> --}}

                                    {{-- <div class="form-group row">
                                    <label for="user-list" class="col-sm-3 col-form-label">Từ</label>
                                    <div class="col-sm-9">
                                        <div class="form-control" style="white-space: nowrap;">
                                            {{ $user->fullname }} - {{ $user->email }}
                                        </div>
                                    </div>
                                </div> --}}

                                    <div class="form-group row">
                                        <label for="user-list" class="col-sm-3 col-form-label">Sang</label>
                                        <div class="col-sm-9">
                                            <select name="to" id="user-list" class="form-control" required>
                                                @foreach ($users as $usr)
                                                    <option value="{{ $usr->id }}">
                                                        {{ $usr->fullname }} - {{ $usr->email }}
                                                    </option>
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
                        <td style="min-width: 100px;">Hình ảnh</td>
                        <td style="min-width: 200px;">Tiêu đề</td>
                        @if (Auth::user()->isAdmin())
                            <td style="min-width: 120px;">Người đăng</td>
                        @endif
                        <td style="min-width: 100px;">Hoa hồng</td>
                        <td style="min-width: 150px;">Tình trạng duyệt</td>
                        <td style="min-width: 130px;">Lý do từ chối</td>
                        <td style="min-width: 100px;">Ẩn/hiện</td>
                        <td style="min-width: 100px;">Ngày ẩn (gần nhất)</td>
                        <td style="min-width: 100px;">Ngày hiện (gần nhất)</td>
                        <td style="min-width: 100px;">Ngày tạo</td>
                        <td style="min-width: 140px;">Ngày cập nhật</td>
                        <td style="min-width: 355px;">Hành động</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        @php
                            $postId = $post->category->shorthand . '-' . $post->id_by_category;
                        @endphp

                        <tr>
                            @if (Auth::user()->isAdmin())
                                <td><input type="checkbox" value="{{ $post->id }}"></td>
                            @endif
                            <td>{{ $postId }}</td>
                            <td>
                                @if ($post->images->count() !== 0)
                                    <img src="{{ url('/uploads/' . $post->images[0]->filename) }}"
                                        alt="{{ $post->name }}" class="thumbnail" loading="lazy" />
                                @endif
                            </td>
                            <td>{{ $post->name }}</td>
                            @if (Auth::user()->isAdmin())
                                <td>{{ $post->user ? $post->user->fullname : '' }}</td>
                            @endif
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
                                @php
                                    if ($post->is_hide) {
                                        $status = 'Đang ẩn';
                                        $badgeClass = 'badge-secondary';
                                        $title = 'Bài đăng đang không được hiển thị lên website';
                                    } else {
                                        $status = 'Hiện';
                                        $badgeClass = 'badge-success';
                                        $title = 'Bài đăng sẽ được hiển thị trên website nếu được duyệt';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}"
                                    title="{{ $title }}">{{ $status }}</span>
                            </td>
                            @php
                                $created_at = $post->created_at;
                                $created_at->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
                                $updated_at = $post->updated_at;
                                $updated_at->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
                                
                                if ($post->hidden_at) {
                                    $hidden_at = new DateTime($post->hidden_at);
                                    $hidden_at->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
                                } else {
                                    $hidden_at = null;
                                }
                                
                                if ($post->hidden_at) {
                                    $shown_at = new DateTime($post->shown_at);
                                    $shown_at->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
                                } else {
                                    $shown_at = null;
                                }
                            @endphp
                            <td>
                                <span>{{ $hidden_at ? $hidden_at->format('H:i:s') : '' }}</span>
                                <span>{{ $hidden_at ? $hidden_at->format('d/m/Y') : '' }}</span>
                            </td>
                            <td>
                                <span>{{ $shown_at ? $shown_at->format('H:i:s') : '' }}</span>
                                <span>{{ $shown_at ? $shown_at->format('d/m/Y') : '' }}</span>
                            </td>
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

                                        {{ Form::open([
                                            'route' => ['posts.hide', $post->id],
                                            'method' => 'post',
                                            'onsubmit' => 'return confirm("Sau khi đã thuê, bài đăng sẽ bị ẩn, bạn có muốn ẩn bài đăng ' . $postId . '?");',
                                            'class' => 'm-0 mr-md-2 mb-2',
                                        ]) }}
                                        <button type="submit" class="btn btn-warning w-100">Đã thuê</button>
                                        {{ Form::close() }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @php
                        if (Auth::user()->isAdmin()) {
                            $colSpan = 13;
                        } else {
                            $colSpan = 12;
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
@endsection

@section('scripts')
    <script>
        const searchInfo = new URLSearchParams(window.location.search);
        const idField = document.getElementById('id');
        const titleField = document.getElementById('title');
        const phoneField = document.getElementById('phone');

        idField.value = searchInfo.get('id');
        titleField.value = searchInfo.get('title');
        phoneField.value = searchInfo.get('phone');
    </script>

    <script>
        // move posts
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
