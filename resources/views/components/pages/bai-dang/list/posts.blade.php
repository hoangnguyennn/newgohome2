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
    $(function() {
        let page = 1;
        let isFetching = false;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 150) {
                if (isFetching) return;
                page++;
                fetchPosts();
            }
        });

        function fetchPosts() {
            isFetching = true;
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

                isFetching = false;
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
    });
</script>
