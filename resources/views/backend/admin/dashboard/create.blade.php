@extends('layouts.app')
@section('title', $title)
@push('styles')
    <style>
        body {
            font-family: "Hind Siliguri", sans-serif !important;
        }

        #smail-device .header {
            padding: 10px 10px;
            border-bottom: 4px solid #eee;
            display: flex;
            align-items: center;
        }

        #smail-device .back-arrow {
            font-size: 17px;
            margin-right: 15px;
            color: #444343;
        }

        #smail-device .avatar-container {
            display: flex;
            justify-content: flex-start;
            margin: 15px;
            align-items: center;
        }

        #smail-device .avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: #CCC;
        }

        #smail-device .avatar #usericons {
            background: #CCC;
            color: #fff;
            font-size: 34px;
        }

        #smail-device .avatar-camera {
            position: absolute;
            bottom: -1px;
            right: 1px;
            background-color: white;
            border-radius: 50%;
            padding: 0px;
            border: 1px solid #ddd;
        }

        #smail-device .avatar i {
            background: #f5f7fb;
            padding: 4px;
            border-radius: 50%;
        }

        #smail-device .type-selection {
            display: flex;
            gap: 10px;
            padding: 0 15px;
            margin-bottom: 15px;
        }

        #smail-device .type-btn {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #smail-device .type-btn.active {
            background-color: #fff;
            color: #000;
            border-color: #dc3545;
            border-width: 1px;
        }

        #smail-device .type-btn.active svg {
            fill: #dc3545;
            stroke: #dc3545;
        }

        #smail-device .type-btn:not(.active) svg {
            fill: none;
            stroke: #000;
        }

        #smail-device .photo-select-btn {
            background-color: #f5f5f5;
            border-radius: 10px;
            padding: 15px;
            margin: 0 15px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        #smail-device .form-group {
            margin: 0 15px 15px;
        }

        #smail-device .form-label {
            color: #dc3545;
            font-size: 14px;
            margin-bottom: 5px;
        }

        #smail-device .form-control::placeholder {
            color: #999;
        }

        #smail-device .form-icon {
            color: #6c757d;
            margin-right: 10px;
        }

        .avatar-container .avatar {
            position: relative;
            width: 100px;
            height: 100px;
            cursor: pointer;
        }

        .avatar-container .avatar-camera {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #fff;
            border-radius: 50%;
            padding: 5px;
        }

        .avatar-container .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #dc3545;
            background-color: #f5f7fb;
            border: 1px solid #dc3545;
            border-radius: 4px;
        }

        .avatar-container .nav-pills .nav-link {
            color: #333739;
            background-color: #f5f7fb;
            border: 1px solid #b6babd;
            border-radius: 4px;
        }

        .nav-link:focus,
        .nav-link:hover {
            color: #dc3545 !important;
        }

        .avatar-container .pills-tab button {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #smail-device .form-control {
            border-radius: 1px 4px 4px 0px;
            padding: 9px;
            border: 1px solid #dee2e6;
        }

        #smail-device .form-control:focus {
            border-radius: 0px 4px 4px 0px !important;
            border-right: 1px solid #dc3545 !important;
            border-top: 1px solid #dc3545 !important;
            border-bottom: 1px solid #dc3545 !important;
        }

        .input-group:has(.form-control:focus) #right_icons {
            border-left: 1px solid #dc3545 !important;
            border-top: 1px solid #dc3545 !important;
            border-bottom: 1px solid #dc3545 !important;
        }

        .submit-btn {
            margin-top: auto;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        #smail-device .submit-btn {
            background-color: #B81413;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 7px;
            width: calc(100% - 30px);
            margin: 15px 15px 30px;
            font-weight: bold;
        }

        #smail-device .submit-btn:disabled {
            background-color: #dbacb1;
            color: white;
            cursor: not-allowed;
            opacity: 1;
        }
    </style>
@endpush
@section('content')
    <div id="smail-device" class="d-block d-sm-none d-md-none d-lg-none d-xl-none d-xxl-none">
        <div class="form-container">
            <div class="header">
                <a href="{{ route('admin.dashboard.index') }}" class="back-arrow"><i class="fa-solid fa-arrow-left"></i></a>
                <h5 class="mb-0">{{ __f('New Customer Create Title') }}</h5>
            </div>
            <form id="customerSupplierCreateForm" action="{{ route('admin.dashboard.customer.supplier.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="avatar-container">
                    <div class="avatar">
                        <input name="userimage" id="userimage" type="file" class="d-none" accept=".png,.jpg,.jpeg,.webp*">
                        <label for="userimage">
                            <div id="usericons-wrapper">
                                <i id="usericons" class="fa-solid fa-user"></i>
                            </div>
                            <div class="avatar-camera">
                                <i class="fa-solid fa-camera"></i>
                            </div>
                        </label>
                    </div>
                    <div class="ms-3">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">
                                    <input type="radio" name="usertype" id="customer" checked value="customer">
                                    <label for="customer">{{ __f('New Customer Title') }}</label>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link ms-3" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="false">
                                    <input type="radio" name="usertype" id="supplier" value="supplier">
                                    <label for="supplier">{{ __f('New Supplier Title') }}</label>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                        tabindex="0">
                        <div class="form-group">
                            <div class="input-group">
                                <span id="right_icons" class="input-group-text bg-white border-1 ps-2 pe-0">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#666"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <input type="text" name="name" id="user_name" class="form-control border-start-0"
                                    placeholder="{{ __f('New Customer Supplier Name Placeholder') }}" autocomplete="off">
                            </div>
                            <span class="text-danger error-text name-error"></span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span id="right_icons" class="input-group-text bg-white border-1 ps-2 pe-0">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#666"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                        </path>
                                    </svg>
                                </span>
                                <input type="tel" name="phone_number" id="phone_number"
                                    class="form-control border-start-0" placeholder="{{ __f('New Customer Supplier Phone Number Placeholder') }}" min="11"
                                    max="11" autocomplete="off">
                            </div>
                            <span class="text-danger error-text phone_number-error"></span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span id="right_icons" class="input-group-text bg-white border-1 ps-2 pe-0">
                                   <span class="fs-4" style="color: #666;">৳</span> 
                                </span>
                                <input type="number" name="previous_due" id="previous_due"
                                    class="form-control border-start-0" placeholder="{{ __f('New Customer Supplier Previous Due Placeholder') }}" autocomplete="off">
                            </div>
                            <span class="text-danger error-text previous_due-error"></span>
                        </div>
                        <button type="submit" class="submit-btn" disabled>
                            <div class="spinner-border text-light d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>{{ __f('New Customer Supplier Submit Button Title') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#userimage').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageTag =
                        `<img src="${e.target.result}" id="usericons" style="width: 55px; height: 55px; border-radius: 50%; object-fit: cover;">`;
                    $('#usericons-wrapper').html(imageTag);
                };
                reader.readAsDataURL(file);
            }
        });

        $('#user_name').on('keyup', function() {
            var name = $(this).val().trim();

            if (name.length < 3) {
                $('.name-error').text("{{ __f('Supplier Customer Create Name Valiation') }}");
            } else {
                $('.name-error').text('');
            }

            validateForm();
        });

        $('#phone_number').on('keyup', function() {
            var phone = $(this).val().trim();

            if (phone.length !== 11 || !/^\d+$/.test(phone)) {
                $('.phone_number-error').text("{{ __f('Supplier Customer Create Number Valiation') }}");
            } else {
                $('.phone_number-error').text('');
            }
            validateForm();
        });

        function validateForm() {
            var name = $('#user_name').val().trim();
            var phone = $('#phone_number').val().trim();

            var nameValid = name.length >= 3;
            var phoneValid = phone.length === 11 && /^\d+$/.test(phone);

            if (nameValid && phoneValid) {
                $('.submit-btn').prop('disabled', false);
            } else {
                $('.submit-btn').prop('disabled', true);
            }
        }
        


        $(document).ready(function() {
            var RedirectUrl = "{{ route('admin.dashboard.index') }}";
            $('#customerSupplierCreateForm').on('submit', function(e) {
                e.preventDefault();
                $('.spinner-border').removeClass('d-none');
                $('.error-text').text('');
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            flashMessage(res.status, res.message);
                            setTimeout(() => {
                                window.location.href = RedirectUrl;
                            }, 100);
                        }else{
                            $('.spinner-border').addClass('d-none');
                            flashMessage(res.status, res.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $('.spinner-border').addClass('d-none');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '-error').text(value[0]);
                            });
                        } else {
                            $('.spinner-border').addClass('d-none');
                            console.log('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endpush
