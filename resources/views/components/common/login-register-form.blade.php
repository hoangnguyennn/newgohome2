<div class="modal fade" id="login-register-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-logo">
                    <img src="{{ mix('images/webp/logo.webp') }}" alt="" />
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="las la-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tabs-menu">
                    <div class="tab tab-login active">
                        <i class="las la-sign-in-alt"></i>
                        <span>Login</span>
                    </div>
                    <div class="tab tab-register">
                        <i class="las la-user-plus"></i>
                        <span>Register</span>
                    </div>
                </div>
                <form class="login-form form show" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="group">
                        <label for="login-email">
                            Email address
                            <span>*</span>
                        </label>
                        <input type="email" id="login-email" name="email" />
                    </div>
                    <div class="group">
                        <label for="login-password">
                            Password
                            <span>*</span>
                        </label>
                        <input type="password" id="login-password" name="password" />
                    </div>
                    <div class="actions">
                        <div class="remember-me-box">
                            <input type="checkbox" id="remember-me" name="remember" />
                            <i class="las la-check"></i>
                            <label for="remember-me">Remember me</label>
                        </div>
                        <div class="lost-your-password">
                            <a href="#">Lost your password?</a>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">Login</button>
                </form>
                <form class="register-form form" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="group">
                        <label for="fullname">
                            Fullname
                            <span>*</span>
                        </label>
                        <input type="text" id="fullname" name="fullname" />
                    </div>
                    <div class="group">
                        <label for="register-email">
                            Email address
                            <span>*</span>
                        </label>
                        <input type="email" id="register-email" name="email" />
                    </div>
                    <div class="group">
                        <label for="register-password">
                            Password
                            <span>*</span>
                        </label>
                        <input type="password" id="register-password" name="password" />
                    </div>
                    <div class="group">
                        <label for="re-password">
                            Re-Password
                            <span>*</span>
                        </label>
                        <input type="password" id="re-password" name="re-password" />
                    </div>
                    <button type="submit" class="btn-submit">Register</button>
                </form>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>

<script>
    $('.tab-login').on('click', function() {
        $(this).addClass('active');
        $('.tab-register').removeClass('active');
        $('.login-form').addClass('show');
        $('.register-form').removeClass('show');
    });

    $('.tab-register').on('click', function() {
        $('.tab-login').removeClass('active');
        $(this).addClass('active');
        $('.login-form').removeClass('show');
        $('.register-form').addClass('show');
    });
</script>
