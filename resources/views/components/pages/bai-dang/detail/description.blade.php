<div class="description">
    <div class="wrapper">
        <div class="title">Mô tả</div>
        @php
            $strpos = strpos($post->description, "\n");
            $substr1 = substr($post->description, 0, $strpos);
            $substr2 = substr($post->description, $strpos);
            $postId = 'Mã nhà: ' . $post->category->shorthand . '-' . $post->id_by_category;
        @endphp
        <p class="content des">{{ $substr1 }}{{ $postId }}{{ $substr2 }}</p>
    </div>

    <div class="wrapper">
        <div class="title">Chi tiết</div>
        <ul class="detail">
            <li>
                <b>Khu vực: </b>
                <span>{{ $post->ward->type->name }} {{ $post->ward->name }}</span>
            </li>

            <li>
                <b>Giá cả: </b>
                <span class="currency">
                    {{ ($post->price * (100 - $post->discount)) / 100 }}
                </span>
            </li>

            <li>
                <b>Diện tích: </b>
                <span>{{ (int) $post->acreage }} m2</span>
            </li>

            @if ($post->floor)
                <li>
                    <b>Số tầng: </b>
                    <span>{{ $post->floor }} tầng</span>
                </li>
            @endif

            @if ($post->bedroom)
                <li>
                    <b>Số phòng ngủ: </b>
                    <span>{{ $post->bedroom }} phòng</span>
                </li>
            @endif

            @if ($post->toilet)
                <li>
                    <b>Số phòng tắm: </b>
                    <span>{{ $post->toilet }} phòng</span>
                </li>
            @endif

            <li>
                <b>Loại: </b>
                <span>{{ $post->category->name }}</span>
            </li>

            @if (Auth::check())
                @if (Auth::user()->isAdmin())
                    <li>
                        <b>Họ tên chủ nhà: </b>
                        <span>{{ $post->owner_name }}</span>
                    </li>

                    <li>
                        <b>Địa chỉ chủ nhà: </b>
                        <span>{{ $post->owner_address }}</span>
                    </li>

                    <li>
                        <b>Số điện thoại chủ nhà: </b>
                        <span>{{ $post->owner_phone }}</span>
                    </li>

                    <li>
                        <b>Hoa hồng: </b>
                        <span class="currency" title="{{ $post->commission }}">{{ $post->commission }}</span>
                    </li>
                @endif
            @endif

            <li>
                <b>Người đăng: </b>
                <span>{{ $post->user->fullname }}</span>
            </li>
        </ul>
    </div>
</div>
