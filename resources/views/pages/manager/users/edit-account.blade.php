@extends('layouts.admin')

@section('main-content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="d-flex justify-content-between flex-column flex-md-row mb-4">
                    <h3 class="title">Cập nhật hồ sơ</h3>
                </div>

                <form action="{{ route('account.update') }}" method="POST" class="bg-white border p-4 needs-validation"
                    novalidate>
                    @csrf

                    <div class="form-group row">
                        <label for="fullname" class="col-sm-3 col-form-label">Họ và tên
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                placeholder="Nhập họ và tên" required value="{{ $user->fullname }}" />
                            <div class="invalid-feedback">
                                Họ và tên là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="changePassword">
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Mật khẩu mới</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Nhập mật khẩu mới" autocomplete="off" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm-password" class="col-sm-3 col-form-label">Nhập lại mật khẩu mới</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="confirm-password" name="confirm-password"
                                    placeholder="Nhập lại mật khẩu" autocomplete="off" />
                            </div>
                        </div>

                        <small class="form-text text-muted">Nếu không muốn thay đổi mật khẩu, vui lòng để trống hai trường
                            "Mật khẩu mới" và "Nhập lại mật khẩu"</small>
                    </div>

                    <div class="form-group row mt-2">
                        <label for="nothing" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary" id="btn-submit">Chỉnh sửa</button>
                            <button type="reset" class="btn btn-secondary">Xóa tất cả</button>
                            <button type="button" data-toggle="collapse" data-target="#changePassword"
                                aria-expanded="false" aria-controls="changePassword" class="btn btn-success">
                                Đổi mật khẩu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
