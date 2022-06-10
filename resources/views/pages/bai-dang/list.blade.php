@extends('layouts.default', ['page_id' => 'post-list'])

@section('main-content')
    <div class="container content">
        @include('components.pages.bai-dang.list.search-form')

        <div class="list-title">
            <h2>Results for:
                <span>Listings</span>
                <strong>{{ $posts->total() }}</strong>
            </h2>
        </div>

        @include('components.pages.bai-dang.list.posts')
    </div>
@endsection
