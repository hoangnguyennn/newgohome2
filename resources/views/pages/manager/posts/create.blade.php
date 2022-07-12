@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css"
        integrity="sha512-WvVX1YO12zmsvTpUQV8s7ZU98DnkaAokcciMZJfnNWyNzm7//QRV61t4aEr0WdIa4pe854QHLTV302vH92FSMw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .dropzone.form-control {
            border-width: 1px;
            border-style: solid;
            border-color: #ced4da;
            height: unset;
        }

        .was-validated .dropzone.form-control.is-invalid {
            border-color: #e3342f;
        }

        .was-validated .dropzone.form-control.is-valid {
            border-color: #38c172;
        }
    </style>
@endsection

@section('main-content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="d-flex justify-content-between flex-column flex-md-row mb-4">
                    <h3 class="title">Thêm bài đăng mới</h3>
                    <div class="d-flex">
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Quay lại danh sách bài đăng</a>
                    </div>
                </div>

                <form action="{{ route('posts.store') }}" method="POST" id="add-post-form"
                    class="bg-white border p-4 needs-validation" novalidate>
                    @csrf

                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label">Tiêu đề
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Nhập tiêu đề bài đăng" required />
                            <div class="invalid-feedback">
                                Tiêu đề là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="col-sm-3 col-form-label">Danh mục
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="category" name="category" required>
                                <option value="" disabled selected>Lựa chọn danh mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Danh mục là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="district" class="col-sm-3 col-form-label">Quận, huyện
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="district" name="district" required>
                                <option value="" disabled selected>Lựa chọn quận, huyện</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Quận, huyện là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ward" class="col-sm-3 col-form-label">Phường, xã
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="ward" name="ward" required>
                                <option value="" disabled selected>Lựa chọn phường, xã</option>
                            </select>
                            <div class="invalid-feedback">
                                Phường xã là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="duration" class="col-sm-3 col-form-label">Thời hạn</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="duration" name="duration" required>
                                @foreach ($durations as $duration)
                                    <option value="{{ $duration->id }}"
                                        {{ $loop->index == 0 ? ' selected="selected"' : '' }}>{{ $duration->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="acreage" class="col-sm-3 col-form-label">Diện tích (m2)
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="acreage" name="acreage"
                                placeholder="Nhập diện tích" required />
                            <div class="invalid-feedback">
                                Diện tích là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row specific">
                        <label for="bedroom" class="col-sm-3 col-form-label">Số phòng ngủ</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="bedroom" name="bedroom"
                                placeholder="Nhập số phòng ngủ" />
                        </div>
                    </div>

                    <div class="form-group row specific">
                        <label for="toilet" class="col-sm-3 col-form-label">Số phòng tắm</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="toilet" name="toilet"
                                placeholder="Nhập số phòng tắm" />
                        </div>
                    </div>

                    <div class="form-group row specific">
                        <label for="floor" class="col-sm-3 col-form-label">Số tầng</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="floor" name="floor"
                                placeholder="Nhập số tầng" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="images" class="col-sm-3 col-form-label">Hình ảnh
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="dropzone form-control" id="post-image-dropzone">
                            </div>
                            <div class="invalid-feedback">
                                Hình ảnh là bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Mô tả
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả"
                                required></textarea>
                            <div class="invalid-feedback">
                                Mô tả là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-sm-3 col-form-label">Giá tiền
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="price" name="price"
                                placeholder="Nhập giá tiền" required />
                            <div class="invalid-feedback">
                                Giá tiền là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="discount" class="col-sm-3 col-form-label">Giảm giá (%)</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="discount" name="discount"
                                placeholder="Nhập % giảm giá" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="commission" class="col-sm-3 col-form-label">Hoa hồng
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="commission" name="commission"
                                placeholder="Nhập tiền hoa hồng, nếu không có thì nhập 0" required />
                            <div class="invalid-feedback">
                                Hoa hồng là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="owner-name" class="col-sm-3 col-form-label">Họ tên chủ nhà
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="owner-name" name="owner-name"
                                placeholder="Nhập họ tên chủ nhà" required />
                            <div class="invalid-feedback">
                                Họ tên chủ nhà là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="owner-phone" class="col-sm-3 col-form-label">Số điện thoại chủ nhà
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control" id="owner-phone" name="owner-phone"
                                placeholder="Nhập số điện thoại chủ nhà" required />
                            <div class="invalid-feedback">
                                Số điện thoại chủ nhà là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="owner-address" class="col-sm-3 col-form-label">Địa chỉ chủ nhà
                            <span class="text-danger">(*)</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="owner-address" name="owner-address"
                                placeholder="Nhập địa chỉ chủ nhà" required />
                            <div class="invalid-feedback">
                                Địa chỉ chủ nhà là trường bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is-cheap" class="col-sm-3 col-form-label">Nhà giá rẻ</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is-cheap" name="is-cheap"
                                    value="is-cheap" />
                                <label for="is-cheap">(Tích vào nếu là nhà giá rẻ)</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is-featured" class="col-sm-3 col-form-label">Nhà nổi bật</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is-featured" name="is-featured"
                                    value="is-featured" />
                                <label for="is-featured">(Tích vào nếu là nhà nổi bật)</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Trạng thái bài đăng</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="status" name="status" required>
                                <option value="0">Hiện</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nothing" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary" id="btn-submit">Tạo bài đăng</button>
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

    <script>
        // LOAD WARD WHEN CHANGING DISTRICT
        const district = document.querySelector('#district');
        const ward = document.querySelector('#ward');
        const placeholderWard = document.createElement('option');
        placeholderWard.value = '';
        placeholderWard.innerHTML = 'Lựa chọn phường, xã';
        placeholderWard.disabled = true;
        placeholderWard.selected = true;

        district.addEventListener('change', loadWards);

        function loadWards() {
            const api = "{{ route('wards.index') }}";

            axios
                .get(api, {
                    params: {
                        districtId: district.value
                    }
                })
                .then((response) => {
                    ward.innerHTML = '';
                    ward.appendChild(placeholderWard);

                    const wardsResponse = response.data;
                    wardsResponse.forEach((w) => {
                        ward.appendChild(generateWard(w));
                    });
                });
        }

        function generateWard(ward) {
            const option = document.createElement('option');
            option.value = ward.id;
            option.innerHTML = ward.name;
            return option;
        }
    </script>

    <script>
        // HIDE SOME FIELDS WHEN SELECT TO STUDIO
        const category = document.querySelector('#category');
        const bedroom = document.querySelector('#bedroom');
        const toilet = document.querySelector('#toilet');
        const floor = document.querySelector('#floor');

        category.addEventListener('change', event => {
            if (event.target.value == 7) {
                hideFields();
            } else {
                showFields();
            }
        });

        function hideFields() {
            const specificFields = document.querySelectorAll('.specific');

            specificFields.forEach(specificField => {
                specificField.classList.add('hide');
                bedroom.value = 1;
                toilet.value = 1;
                floor.value = 1;
            });
        }

        function showFields() {
            const specificFields = document.querySelectorAll('.specific');

            specificFields.forEach(specificField => {
                specificField.classList.remove('hide');
            });
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"
        integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const form = document.querySelector('#add-post-form');
        const btnSubmit = document.querySelector('#btn-submit');
        const uploadedImage = {};

        Dropzone.options.postImageDropzone = {
            url: "{{ route('api.post-images.upload-single') }}",
            addRemoveLinks: true,
            maxFiles: 20,
            dictDefaultMessage: 'Kéo hình vào đây để tải ảnh lên',
            dictRemoveFile: 'Xóa ảnh',
            dictCancelUpload: 'Hủy tải ảnh lên',
            dictCancelUploadConfirmation: 'Xác nhận hủy tải ảnh lên',
            dictMaxFilesExceeded: 'Ảnh tải lên đã đạt tới mức giới hạn',
            timeout: 50000,
            acceptedFiles: '.jpeg,.jpg,.png',
            maxFilesize: 5,
            // autoProcessQueue: false, // false: không tự động upload image
            // processQueue(): method for call upload image
            sending: function(file, xhr, formData) {
                formData.append('_token', '{{ csrf_token() }}');
                btnSubmit.disabled = true;
            },
            success: function(file, response) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'image[]';
                input.value = response;
                form.appendChild(input);
                uploadedImage[file.name] = response;
                btnSubmit.disabled = false;
            },
            removedfile: function(file) {
                file.previewElement.remove();

                const imageId = uploadedImage[file.name];
                const input = form.querySelector(`[name="image[]"][value="${imageId}"]`);
                input && input.remove();
                axios.delete(`/post-images/${imageId}`);
            },
            init: function() {
                const postImageDropzone = this;
                postImageDropzone.on('addedfile', function() {
                    const fileCount = postImageDropzone.files.length;
                    if (fileCount !== 0 && form.classList.contains('was-validated')) {
                        const dropzone = document.querySelector('#post-image-dropzone');
                        calculateClass(dropzone, true); // valid
                    }
                });

                postImageDropzone.on('removedfile', function() {
                    const fileCount = postImageDropzone.files.length;
                    if (fileCount === 0 && form.classList.contains('was-validated')) {
                        const dropzone = document.querySelector('#post-image-dropzone');
                        calculateClass(dropzone, false); // invalid
                    }
                });

                form.addEventListener('submit', function(event) {
                    const fileCount = postImageDropzone.files.length;
                    if (fileCount === 0) {
                        const dropzone = document.querySelector('#post-image-dropzone');
                        calculateClass(dropzone, false); // invalid
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    postImageDropzone.processQueue();
                    return true;
                }, false);
            }
        };

        function calculateClass(element, isValid = true) {
            if (isValid) {
                element.classList.add('is-valid');
                element.classList.remove('is-invalid');
            } else {
                element.classList.add('is-invalid');
                element.classList.remove('is-valid');
            }
        }
    </script>
@endsection
