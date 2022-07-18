@extends('layouts.admin')

@section('main-content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="d-flex justify-content-between flex-column flex-md-row mb-4">
                    <h3 class="title">Chỉnh sửa người dùng</h3>
                    <div class="d-flex">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại danh sách người dùng</a>
                    </div>
                </div>

                <form action="{{ route('users.update', $user->id) }}" method="POST"
                    class="bg-white border p-4 needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

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

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Nhập địa chỉ email" required value="{{ $user->email }}" />
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
                                <option value="admin" {{ $user->isAdmin() ? 'selected' : '' }}>Quản trị viên</option>
                                <option value="user" {{ $user->isAdmin() ? '' : 'selected' }}>Người dùng</option>
                            </select>
                            <div class="invalid-feedback">
                                Vai trò là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="avatar" class="col-sm-3 col-form-label">Avatar
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            @php
                                $url = $user->avatar ? url('/avatars/' . $user->avatar) : '';
                            @endphp
                            <input type="file" id="avatar" name="avatar" class="form-control-file"
                                value="{{ $url }}" onchange="readURL(this);" />
                            <div class="preview-image">
                                <img src="{{ $url }}" alt="" height="100px" />
                            </div>
                            <div class="invalid-feedback">
                                Avatar là trường bắt buộc
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    $('.preview-image img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
