<div class="contact">
    <div class="contact-header">
        <div class="bg"></div>
        <div class="avatar-wrap">
            <div class="avatar">
                @php
                    $url = $post->user->avatar ? url('/avatars/' . $post->user->avatar) : '';
                @endphp
                @if ($url)
                    <img src="{{ $url }}" alt="{{ $post->user->name }}" />
                @else
                    <img src="https://homeradar.cththemes.co/wp-content/plugins/homeradar-add-ons/assets/images/avatar.jpg"
                        alt="" />
                @endif
            </div>
            <div class="right">
                <h4 class="name">{{ $post->user ? $post->user->fullname : '' }}</h4>
                <p>Số bài đăng: {{ $totalPost ?? 0 }}</p>
            </div>
        </div>
    </div>
    <div class="contact-body">
        <ul>
            <li>
                <span style="width: 174px;">
                    <i class="las la-map-marker"></i>
                    Trụ sở
                </span>
                <span>54 đường số 2, KĐT Lê Hồng Phong Ⅱ, Phước Hải</span>
            </li>
            <li>
                <span>
                    <i class="las la-phone"></i>
                    Điện thoại
                </span>
                <span>0797016179 - 0797018179</span>
            </li>
            <li>
                <span>
                    <i class="las la-envelope"></i>
                    Email
                </span>
                <span>gohome.forrent@gmail.com</span>
            </li>
            <li>
                <span>
                    <i class="lab la-chrome"></i>
                    Website
                </span>
                <span>https://gohomenhatrang.com</span>
            </li>
        </ul>

        {{-- <div class="contact-footer">
            <button class="view-profile">Xem thông tin</button>
            <div class="right">
                <i class="las la-paper-plane"></i>
            </div>
        </div> --}}
    </div>
</div>
