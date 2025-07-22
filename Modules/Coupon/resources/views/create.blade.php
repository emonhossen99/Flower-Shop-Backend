@extends('layouts.app')
@section('title', $title)
@push('styles')
    <style>
        #coupon-code-generate {
            color: #0d6efd;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card px-3 py-3">
                <div class="bg-white border-bottom-0 pb-4 d-flex justify-content-between align-items-center flex-row">
                    <h2 class="backend-title">{{ $title }}</h2>
                </div>
                <div class="menu-create-form">
                    <form id="couponCreateForm" method="POST" action="{{ route('admin.coupon.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <x-form.textbox labelName="{{ __f('Coupon Name Label Title') }}" parantClass="col-12 col-md-6"
                                name="name" required="required" placeholder="{{ __f('Coupon Name Placeholder') }}"
                                errorName="name" class="py-2" value="{{ old('name') }}"></x-form.textbox>

                            <div Class="col-12 col-md-6">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="code" class="required">{{ __f('Coupon Code Label Title') }}</label>
                                    <span id="coupon-code-generate"
                                        onclick="generateCouponCode(6)">{{ __f('Generate Code Label Title') }}</span>
                                </div>
                                <input type="text" id="code" name="code" required
                                    placeholder="{{ __f('Coupon Code Placeholder') }}" class="py-2 form-control">
                                @error('code')
                                    <p class="text-danger">{{ $message ?? '' }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                             <x-form.textbox labelName="{{ __f('Coupon Discount Amount Lable Title') }}"  parantClass="col-12 col-md-6"
                                name="discount_amount" placeholder="{{ __f('Coupon Discount Amount Placeholder') }}"
                                errorName="discount_amount" class="py-2" value="{{ old('discount_amount') }}" type="number" required="required"></x-form.textbox>

                            <x-form.textbox labelName="{{ __f('Coupon Use Limit Label Title') }}" optionalText="({{ __f('Coupon Use Limit Optinal Text') }})"  parantClass="col-12 col-md-6"
                                name="limit" placeholder="{{ __f('Coupon Use Limit Placeholder') }}"
                                errorName="limit" class="py-2" value="{{ old('limit') }}" type="number"></x-form.textbox>
                        </div>

                        <div class="row mt-2">
                            <x-form.selectbox parantClass="col-12 col-md-6" class="form-control py-2" name="type"
                                required="required" labelName="{{ __f('Coupon Type Title') }}" errorName="type">
                                <option value="0">{{ __f('Coupon Percent Title') }}</option>
                                <option value="1">{{ __f('Coupon Flat Title') }}</option>
                            </x-form.selectbox>

                            <x-form.textbox labelName="{{ __f('Coupon Use Start Date Label Title') }}" optionalText="({{ __f('Coupon Use Start Date Optinal Text') }})"  parantClass="col-12 col-md-6"
                                name="start_date" placeholder="{{ __f('Coupon Use Start Date Placeholder') }}"
                                errorName="start_date" class="py-2" value="{{ old('start_date') }}" type="date"></x-form.textbox>
                        </div>
                        <div class="row mt-2">
                            <x-form.textbox labelName="{{ __f('Coupon Use End Date Label Title') }}" optionalText="({{ __f('Coupon Use End Date Optinal Text') }})"  parantClass="col-12 col-md-6"
                                name="end_date" placeholder="{{ __f('Coupon Use End Date Placeholder') }}"
                                errorName="end_date" class="py-2" value="{{ old('end_date') }}" type="date"></x-form.textbox>

                            <x-form.selectbox parantClass="col-12 col-md-6" class="form-control py-2" name="status"
                                required="required" labelName="{{ __f('Status Title') }}" errorName="status">
                                <option value="0">{{ __f('Status Pending Title') }}</option>
                                <option value="1">{{ __f('Status Publish Title') }}</option>
                            </x-form.selectbox>
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-3">
                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                                <div class="spinner-border text-light d-none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>{{ __f('Submit Title') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function generateCouponCode(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let coupon = '';
            for (let i = 0; i < length; i++) {
                coupon += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            $('#code').val(coupon.toUpperCase());
        }
    </script>
    <script>
        $(document).ready(function() {
            const projectRedirectUrl = "{{ route('admin.coupon.index') }}";
            $('#couponCreateForm').on('submit', function(e) {
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
                                window.location.href = projectRedirectUrl;
                            }, 100);
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
