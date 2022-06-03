@extends('layouts.default', ['page_id' => 'post-detail'])

@section('main-content')
    @include('components.pages.bai-dang.detail.hero-section')
    @include('components.pages.bai-dang.detail.gallery')
    @include('components.pages.bai-dang.detail.description')
    @include('components.pages.bai-dang.detail.new-posts')
    @include('components.pages.home.quick-menu')
@endsection
