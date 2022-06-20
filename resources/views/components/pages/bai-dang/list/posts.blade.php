<div class="posts">
    <div class="row">
        @foreach ($posts as $post)
            @php
                if ($loop->index % 2 === 0) {
                    $rating = 5;
                } else {
                    $rating = 4;
                }
            @endphp
            <div class="col-12 col-lg-4">
                @include('components.common.post', ['post' => $post, 'rating' => $rating])
            </div>
        @endforeach
    </div>
</div>

<script>
    let page = 1;
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            page++;
            fetchPosts();
        }
    });

    function fetchPosts() {
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);

        $.ajax({
            url: url.href,
            type: 'get',
        }).done(function(data) {
            if (data.html !== '') {
                $('.posts .row').append(data.html);
                $(".currency").each(function() {
                    $(this).text(toCurrency($(this).text()));
                });
            }
        });
    }

    // convert currency to VND value
    function toCurrency(num) {
        const numNum = Number(num);
        if (!isNaN(numNum)) {
            return Number(num).toLocaleString("vi-VN", {
                style: "currency",
                currency: "VND",
            });
        }

        return num;
    }
</script>
