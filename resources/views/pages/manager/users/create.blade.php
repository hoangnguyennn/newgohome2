@extends('layouts.admin')

@section('main-content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="d-flex justify-content-between flex-column flex-md-row mb-4">
                    <h3 class="title">Thêm người dùng mới</h3>
                    <div class="d-flex">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại danh sách người dùng</a>
                    </div>
                </div>

                <form action="{{ route('users.store') }}" method="POST" class="bg-white border p-4 needs-validation"
                    novalidate>
                    @csrf

                    <div class="form-group row">
                        <label for="fullname" class="col-sm-3 col-form-label">Họ và tên
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                placeholder="Nhập họ và tên" required />
                            <div class="invalid-feedback">
                                Họ và tên là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Nhập địa chỉ email" required />
                            <div class="invalid-feedback">
                                Email là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-sm-3 col-form-label">Vai trò
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="role" name="role" required>
                                <option value="admin">Quản trị viên</option>
                                <option value="user">Người dùng</option>
                            </select>
                            <div class="invalid-feedback">
                                Vai trò là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Mật khẩu
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Nhập mật khẩu" required />
                            <div class="invalid-feedback">
                                Mật khẩu là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="confirm-password" class="col-sm-3 col-form-label">Nhập lại mật khẩu
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password"
                                placeholder="Nhập lại mật khẩu" required />
                            <div class="invalid-feedback">
                                Nhập lại mật khẩu là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nothing" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary" id="btn-submit">Tạo người dùng</button>
                            <button type="reset" class="btn btn-secondary">Xóa tất cả</button>
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
