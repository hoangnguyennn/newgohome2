<div class="gallery-section">
    <div class="gallery row">
        @foreach ($post->images->slice(0, 6) as $image)
            <div class="col-12 col-lg-6" data-src="{{ url('/uploads/' . $image->filename) }}">
                <a class="gallery-item" href="{{ url('/uploads/' . $image->filename) }}">
                    <img src="{{ url('/uploads/' . $image->filename) }}" alt="{{ $loop->index + 1 }}" height="280" />
                </a>
            </div>
        @endforeach
    </div>
</div>

<script>
    lightGallery(document.querySelector('.gallery'), {
        animateThumb: false,
        zoomFromOrigin: false,
        allowMediaOverlap: true,
        toggleThumb: true,
        controls: true,
    });
</script>
