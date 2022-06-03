<div class="gallery-section">
    <div class="gallery">
        @foreach ($post->images as $image)
            {{-- <a href="{{ url('/uploads/' . $image->filename) }}">
            <img src="{{ url('/uploads/' . $image->filename) }}" alt="{{ $loop->index + 1 }}" />
        </a> --}}
            <a class="gallery-item" href="https://homeradar.cththemes.co/wp-content/uploads/2021/04/1.jpg">
                <img src="https://homeradar.cththemes.co/wp-content/uploads/2021/04/1.jpg"
                    alt="{{ $loop->index + 1 }}" />
            </a>
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
