@foreach ($posts as $post)
    <div class="col-12 col-lg-4">
        @include('components.common.post', ['post' => $post])
    </div>
@endforeach