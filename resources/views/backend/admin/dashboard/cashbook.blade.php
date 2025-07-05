@extends('layouts.app')
@section('title', $title)
@push('styles')
    <style>
        body {
            font-family: "Roboto", sans-serif !important;
        }

        .content {
            background: white;
        }

        #smail-device .header {
            padding: 10px 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #smail-device .mobile-container {
            background: white;
        }

        #smail-device .profile-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            margin-right: -6px;
        }

        #smail-device .profile-circle.customer {
            background: #ff6b35;
        }

        #smail-device .profile-circle.supplier {
            background: #005B95;
        }

        #smail-device .contact-info {
            line-height: 12px;
        }

        #smail-device .contact-info h5 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        #smail-device .contact-info small {
            color: #666;
            font-size: 11px;
        }

        #smail-device .contact-info i {
            font-size: 10px;
        }

        #smail-device .balance-section {
            padding: 12px;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        #smail-device .balance-amount {
            font-size: 17px;
            font-weight: 600;
            font-family: Arial, Helvetica, sans-serif
        }

        #smail-device .balance-label {
            color: #666;
            font-size: 14px;
            margin-left: 10px;
        }

        #smail-device .action-buttons {
            padding: 12px 12px;
        }

        #smail-device .input-group-text {
            background-color: white !important;
            border-right: 1px solid transparent !important;
        }

        #smail-device .input-group-textarea {
            background-color: white !important;
            border-right: 1px solid transparent !important;
            align-items: start;
            padding: 6px 8px;
        }

        #smail-device .form-control:focus {
            border-radius: 0px 4px 4px 0px !important;
            border-right: 1px solid #dc3545 !important;
            border-top: 1px solid #dc3545 !important;
            border-bottom: 1px solid #dc3545 !important;
        }

        #smail-device .input-group:has(.form-control:focus) #basic-addon1 {
            border-left: 1px solid #dc3545 !important;
            border-top: 1px solid #dc3545 !important;
            border-bottom: 1px solid #dc3545 !important;
        }

        #smail-device .input-group> :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            border-left: none !important;
        }

        #smail-device .nav-bottom {
            padding: 10px 11px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
        }

        #smail-device .confirm-btn {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
            max-width: 360px;
            background: #B81413;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 7px;
            font-size: 18px;
            font-weight: 500;
        }

        #smail-device .nav-bottom .nav-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #666;
            text-decoration: none;
            font-size: 12px;
            background: #dfdfdf;
            padding: 5px 10px;
            border-radius: 25px;
        }

        #smail-device .nav-bottom #paydate {
            width: 50px;
            border: none;
            background: top;
        }

        #smail-device .nav-bottom #paydate:focus-visible {
            outline: none !important;
        }

        #smail-device #customDateTrigger {
            cursor: pointer;
        }

        #smail-device .form-check-input:checked {
            background-color: #df4857;
            border-color: #df4857;
        }

        #smail-device input[type="number"]::-webkit-inner-spin-button,
        #smail-device input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #smail-device input[type="number"] {
            -moz-appearance: textfield;
        }

        #smail-device .balance-amount.positive {
            color: #28a745;
        }

        #smail-device .balance-amount.negetive {
            color: #dc3545;
        }
        #smail-device #report-text {
            background: #f5eaea;
            padding: 5px 14px;
            border-radius: 25px;
            color: #d06565;
            font-weight: 500;
            font-size: 12px;
        }
    </style>
@endpush
@section('content')
    <div id="smail-device" class="d-block d-sm-none d-md-none d-lg-none d-xl-none d-xxl-none">
        <div class="mobile-container">
            <div>
                <div class="header">
                    <a href="{{ route('admin.dashboard.index') }}" class="text-dark">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    @php
                        $headerText = '';
                        $placeholder = '';
                        if($role == 'cash_sell'){
                            $headerText = 'ক্যাশ বেচা';
                            $placeholder = 'পেলাম';
                        }else if($role == 'cash_buy'){
                            $headerText = 'ক্যাশ কেনা';
                            $placeholder = 'দিলাম';
                        }else if($role == 'expence'){
                            $headerText = 'খরচ';
                            $placeholder = 'দিলাম';
                        }else if($role == 'owner_gave'){
                            $headerText = 'মালিক দিল';
                            $placeholder = 'পরিমাণ';
                        }else{
                            $headerText = 'মালিক নিল';
                            $placeholder = 'পরিমাণ';
                        }
                    @endphp
                    <div class="contact-info ms-2">
                        <h5>
                            {{ $headerText ?? '' }}
                        </h5>
                        <small>
                            {{ 'বর্তমান ক্যাশ :'.  convertToLocaleNumber($cashboxAmount ?? 0) }}
                        </small>
                    </div>
                    <div class="ms-auto">
                        <a id="report-text" href=""><i class="fa-solid fa-file-lines"></i> রিপোর্ট</a>
                    </div>
                </div>
                <form id="customerSupplierPaybillFrom"
                    action="{{ route('admin.dashboard.pay.bill.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="action-buttons">
                        <input type="hidden" name="role" value="{{ $role ?? '' }}">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text px-2 py-1" id="basic-addon1"><span class="fs-4"
                                            style="color: #666;">৳</span></span>
                                    <input type="number" id="total_amount" name="total_amount" class="form-control px-0"
                                        placeholder="{{ $placeholder }}"
                                        aria-describedby="basic-addon1" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text input-group-textarea" id="basic-addon1"><span
                                            class="fs-6" style="color: #666;"><i
                                                class="fa-solid fa-file-lines"></i></span></span>
                                    <textarea class="form-control px-0" name="details" id="details" rows="4" placeholder="বিবরণ"
                                        aria-describedby="basic-addon1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-bottom">
                        <div class="nav-item">
                            <label><i class="fa-solid fa-calendar"></i></label>
                            <span id="customDateTrigger">{{ formatDateToBanglaWithYear(now()) }}</span>
                            <input type="date" id="paydate" name="pay_date" value="{{ now()->format('Y-m-d') }}"
                                class="d-none">
                        </div>
                        <div class="nav-item">
                            <label for="image" style="cursor: pointer;"><i class="fas fa-image"></i><span
                                    class="ms-2">ছবি</span></label>
                            <input type="file" name="image" id="image" class="d-none">
                        </div>
                    </div>
                    <button type="submit" class="btn confirm-btn" disabled>
                        <div class="spinner-border text-light me-2 d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>নিশ্চিত
                    </button>
                </form>
            </div>
        </div>
    </div>
    @include('backend.admin.dashboard.payforcashbox')
@endsection
@push('scripts')
    <script>
        const myUpperCashModal = new bootstrap.Modal(document.getElementById('upperCashModals'), {
            keyboard: false,
            backdrop: false
        });
        function convertToCustomBanglaDate(dateStr) {
            const banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            const months = {
                '01': 'জানুয়ারি',
                '02': 'ফেব্রুয়ারি',
                '03': 'মার্চ',
                '04': 'এপ্রিল',
                '05': 'মে',
                '06': 'জুন',
                '07': 'জুলাই',
                '08': 'আগস্ট',
                '09': 'সেপ্টেম্বর',
                '10': 'অক্টোবর',
                '11': 'নভেম্বর',
                '12': 'ডিসেম্বর',
            };

            let [year, month, day] = dateStr.split('-');
            let banglaDay = day.replace(/\d/g, d => banglaDigits[d]);
            let banglaMonth = months[month] || month;
            let lastTwoDigitsOfYear = year.slice(-2);
            let banglaYearShort = lastTwoDigitsOfYear.replace(/\d/g, d => banglaDigits[d]);

            return `${banglaDay} ${banglaMonth}, ${banglaYearShort}`;
        }
        function convertToLocaleNumber(number) {
            const currentLang = "{{ app()->getLocale() }}" || 'en';
            const map = {
                bn: ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'],
                en: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
            };

            const targetDigits = map[currentLang] || map['en'];
            return number.toString().split('').map(char => {
                if (!isNaN(char) && map['en'].includes(char)) {
                    return targetDigits[parseInt(char)];
                }
                return char;
            }).join('');
        }

        $('#paydate').on('change', function() {
            let selectedDate = $(this).val();
            let banglaDate = convertToCustomBanglaDate(selectedDate);
            $('#customDateTrigger').text(banglaDate);
        });


        $('#customDateTrigger').on('click', function() {
            let input = $('#paydate');
            if (input[0].showPicker) {
                input[0].showPicker();
            } else {
                input.focus();
            }
        });

        $('#total_amount').on('keyup', function() {
            var value = $(this).val();
            if (value.length != 0) {
                $('.confirm-btn').prop('disabled', false);
            } else {
                $('.confirm-btn').prop('disabled', true);
            }
        });

        $('#uppercash_sell').on('keyup', function() {
            var value = $(this).val();
            if (value.length != 0) {
                $('.uppercash_submit_btn').prop('disabled', false);
                $('.uppercash_submit_btn').addClass('active');
            } else {
                $('.uppercash_submit_btn').prop('disabled', true);
                $('.uppercash_submit_btn').removeClass('active');
            }
        });

        $('#uppercash_owner_give').on('keyup', function() {
            var value = $(this).val();
            if (value.length != 0) {
                $('.uppercash_submit_btn').prop('disabled', false);
                $('.uppercash_submit_btn').addClass('active');
            } else {
                $('.uppercash_submit_btn').prop('disabled', true);
                $('.uppercash_submit_btn').removeClass('active');
            }
        });

        $(document).ready(function() {
            $('#customerSupplierPaybillFrom').on('submit', function(e) {
                e.preventDefault();
                var actionurl = $(this).attr('action');
                var RedirectUrl = "{{ route('admin.dashboard.index') }}";
                var role = "{{ $role }}";
                var cashboxAmount = parseFloat("{{ $cashboxAmount }}") || 0;
                var paymentamount = parseFloat($('#total_amount').val()) || 0;

                if (role == 'cash_sell' || role == 'owner_gave') {
                    $('.spinner-border').removeClass('d-none');
                    $('.error-text').text('');
                    requestToStore(new FormData(this), actionurl, RedirectUrl);
                } else {
                    if (cashboxAmount < paymentamount) {
                        var dueamount = paymentamount - cashboxAmount;
                        $('#cash-due-amount').html(convertToLocaleNumber(dueamount));
                        $('#avaiavle-amount-uppercash').html(convertToLocaleNumber(cashboxAmount));
                        $('#total-pay-amount-uppercash').html(convertToLocaleNumber(paymentamount));
                        myUpperCashModal.show();
                    } else {
                        $('.spinner-border').removeClass('d-none');
                        $('.error-text').text('');
                        requestToStore(new FormData(this), actionurl, RedirectUrl);
                    }
                }
            });
        });

        $(document).ready(function() {
            $('#upperCashModalForm').on('submit', function(e) {
                e.preventDefault();
                var actionurl = $(this).attr('action');
                var RedirectUrl = "{{ route('admin.dashboard.index') }}";
                var role = "{{ $role }}";
                var cashboxAmount = parseFloat("{{ $cashboxAmount ?? 0 }}") || 0;
                var paymentamount = parseFloat($('#total_amount').val()) || 0;
                var uppercashsell = parseFloat($('#uppercash_sell').val()) || 0;
                var uppercashownergive = parseFloat($('#uppercash_owner_give').val()) || 0;
                var formData = new FormData(this);
                $('#customerSupplierPaybillFrom').find('input[name], select[name], textarea[name]').each(
                    function() {
                        var $field = $(this);
                        var name = $field.attr('name');
                        var type = $field.attr('type');

                        if (type === 'file') {
                            var files = $field[0].files;
                            if (files.length > 0) {
                                for (var i = 0; i < files.length; i++) {
                                    formData.append(name, files[i]);
                                }
                            }
                        } else if (type === 'checkbox') {
                            if ($field.prop('checked')) {
                                formData.append(name, $field.val());
                            } else {
                                formData.append(name, '0');
                            }
                        } else {
                            formData.append(name, $field.val());
                        }
                });
                var totalcollectamount = (cashboxAmount) + (uppercashsell) + (uppercashownergive);
                if(paymentamount <= totalcollectamount){
                    $('.spinner-border-uppercash').removeClass('d-none');
                    $('.error-text').text('');
                    requestToStore(formData,actionurl,RedirectUrl);
                }else{
                    flashMessage('error','ঘাটটি পূরণে পর্যাপ্ত ক্যাশ এন্ট্রি দিন।');
                }
            });
        });


        function requestToStore(formData, actionurl, RedirectUrl) {
            $.ajax({
                url: actionurl,
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
                    } else {
                        $('.spinner-border').addClass('d-none');
                        $('.spinner-border-uppercash').addClass('d-none');
                        flashMessage(res.status, res.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        $('.spinner-border').addClass('d-none');
                        $('.spinner-border-uppercash').addClass('d-none');
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('.' + key + '-error').text(value[0]);
                        });
                    } else {
                        $('.spinner-border').addClass('d-none');
                        $('.spinner-border-uppercash').addClass('d-none');
                        console.log('Something went wrong. Please try again.');
                    }
                }
            });
        }
    </script>
@endpush
