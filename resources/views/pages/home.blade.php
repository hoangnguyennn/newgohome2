@extends('layouts.default')

@section('main-content')
    @include('components.pages.home.main-banner')
    @include('components.pages.home.popular-posts')
    @include('components.pages.home.explore-features')
    @include('components.pages.home.popular-cities')
    {{-- @include('components.pages.home.meet-our-agents') --}}
    {{-- @include('components.pages.home.statistical') --}}
    @include('components.pages.home.quotes')
    @include('components.pages.home.newsletters')
    @include('components.pages.home.quick-menu')
@endsection
