<div class="verify-post">
    <h3 class="title">Kiểm duyệt bài đăng</h3>
    <div class="content">
        <form action="{{ route('posts.deny', $post->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="form-group">
                <textarea class="form-control" name="deny-reason" rows="3" placeholder="Nếu không duyệt, vui lòng điền lý do"
                    required name="deny-reason">{{ $post->deny_reason ?? '' }}</textarea>
                <div class="invalid-feedback">
                    Lý do từ chối là trường bắt buộc
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-danger">
                    <span>Không duyệt</span>
                </button>
                <a href="javascript:void();" class="btn btn-primary ml-2 verify-post-btn">
                    <span>Duyệt</span>
                </a>
            </div>
        </form>
        <form action="{{ route('posts.verify', $post->id) }}" method="POST" id="verify-post-form">
            @csrf
        </form>
    </div>
</div>

<script>
    // BOOTSTRAP VALIDATE FORM
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<script>
    // verify post
    const verifyPostBtn = document.querySelector('.verify-post-btn');
    const verifyPostForm = document.querySelector('#verify-post-form');
    verifyPostBtn.addEventListener('click', function(event) {
        event.preventDefault();
        verifyPostForm.submit();
    });
</script>
