@extends('layouts.admin')

@section('main-content')
    <div class="container my-5">
        <div class="col-lg-10 offset-lg-1">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="start">Từ</label>
                            <input type="date" class="form-control" id="start" name="start"
                                value="{{ request()->input('start') }}"
                                @if (request()->input('end')) max="{{ request()->input('end') }}" @endif />
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="end">Đến</label>
                            <input type="date" class="form-control" id="end" name="end"
                                value="{{ request()->input('end') }}"
                                @if (request()->input('start')) min="{{ request()->input('start') }}" @endif />
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid my-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <td>#</td>
                    <td style="min-width: 200px;">Họ tên</td>
                    <td style="min-width: 130px;">Các bài đăng</td>
                    <td style="min-width: 150px;">Tổng số bài đăng</td>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->fullname }}</td>
                            <td>
                                @php
                                    $arr = [];
                                    foreach ($user->posts as $post) {
                                        array_push($arr, $post->category->shorthand . '-' . $post->id_by_category);
                                    }
                                @endphp
                                {{ implode(', ', $arr) }}
                            </td>
                            <td>{{ $user->posts->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @php
            if (method_exists($users, 'links')) {
                echo $users->links();
            }
        @endphp
    </div>
@endsection
