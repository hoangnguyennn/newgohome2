@extends('layouts.default', ['page_id' => 'post-list'])

@section('main-content')
    @include('components.pages.bai-dang.list.search-form')

    <div class="container content">

        <div class="list-title">
            <h2>Số lượng kết quả tìm kiếm:
                {{-- <span>Listings</span> --}}
                <strong>{{ $posts->total() }}</strong>
            </h2>
        </div>

        @include('components.pages.bai-dang.list.posts')
    </div>
@endsection
