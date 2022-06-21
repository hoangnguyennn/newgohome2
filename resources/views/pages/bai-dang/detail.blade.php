@extends('layouts.default', ['page_id' => 'post-detail'])

@section('main-content')
    @include('components.pages.bai-dang.detail.hero-section')

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                @include('components.pages.bai-dang.detail.gallery')
                @include('components.pages.bai-dang.detail.description')
            </div>
            <div class="col-12 col-lg-4">
                @include('components.common.verify-post')
                @include('components.pages.bai-dang.detail.contact')
                @include('components.pages.bai-dang.detail.new-posts')
            </div>
        </div>
    </div>

    <div class="container">
        @include('components.pages.bai-dang.detail.related-posts')
    </div>

    @include('components.pages.home.newsletters')
    @include('components.pages.home.quick-menu')
@endsection
