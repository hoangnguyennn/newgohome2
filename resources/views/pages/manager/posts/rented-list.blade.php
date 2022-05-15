@extends('layouts.admin')

@section('main-content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <form action="{{ route('posts.rented-list') }}" method="GET">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group row">
                                <label for="id" class="col-sm-3 col-form-label">Mã bài đăng</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="id" name="id" placeholder="GH-xxx" />
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
                                            <a href="{{ route('posts.rented-list') }}" class="btn btn-secondary">Xóa bộ
                                                lọc</a>
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
            <h3 class="title">Danh sách bài đăng đã thuê</h3>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td style="min-width: 100px;">#</td>
                        <td style="min-width: 100px;">Hình ảnh</td>
                        <td style="min-width: 100px;">Tiêu đề</td>
                        @if (Auth::user()->isAdmin())
                            <td style="min-width: 120px;">Người đăng</td>
                        @endif
                        <td style="min-width: 100px;">Hoa hồng</td>
                        <td style="min-width: 150px;">Tình trạng duyệt</td>
                        <td style="min-width: 130px;">Lý do từ chối</td>
                        <td style="min-width: 100px;">Ẩn/hiện</td>
                        <td style="min-width: 100px;">Ngày tạo</td>
                        <td style="min-width: 140px;">Ngày cập nhật</td>
                        <td style="min-width: 250px;">Hành động</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->category->shorthand }}-{{ $post->id_by_category }}</td>
                            <td>
                                @if ($post->images->count() !== 0)
                                    <img src="{{ url('/uploads/' . $post->images[0]->filename) }}"
                                        alt="{{ $post->name }}" class="thumbnail" loading="lazy" />
                                @endif
                            </td>
                            <td>{{ $post->name }}</td>
                            @if (Auth::user()->isAdmin())
                                <td>{{ $post->user->fullname }}</td>
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
                                    <a class="btn btn-success mr-md-2 mb-2" href={{ route('post', $post->slug) }}
                                        target="_blank">Xem</a>
                                    <a class="btn btn-primary mr-md-2 mb-2"
                                        href={{ route('posts.edit', $post->id) }}>Chỉnh sửa</a>
                                    {{ Form::open([
                                        'route' => ['posts.destroy', $post->id],
                                        'method' => 'delete',
                                        'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa bài đăng GH-' . $post->id . '?");',
                                        'class' => 'm-0',
                                    ]) }}
                                    <button type="submit" class="btn btn-danger mr-md-2 mb-2 w-100">Xóa</button>
                                    {{ Form::close() }}
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
@endsection
