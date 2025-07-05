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

        #smail-device .action-buttons-header {
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

        #smail-device #confirm-btn {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
            max-width: 360px;
            border: none;
            border-radius: 50px;
            padding: 7px;
            font-size: 18px;
            font-weight: 500;
        }

        #smail-device #confirm-btn .title {
            margin-bottom: 4rem;
            text-align: center;
            font-size: 15px;
            font-weight: 500;
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

        #smail-device #optinaltext {
            color: #595c5f;
            font-size: 13px;
            font-weight: 500;
            margin-top: 6px;
        }

        #smail-device .action-buttons-header-main {
            background: #c8c7c433;
            padding: 13px;
            border-radius: 5px;
            color: #0000009e;
        }
        #smail-device .action-buttons-header-main-first {
            border-bottom: 1px solid #cecdcd;
            margin-bottom: 10px;
        }

        #smail-device .action-buttons-header-main h4 {
            font-size: 14px !important;
        }
        #smail-device .action-buttons-header-main .bold-text {
            font-weight: 600;
        }
    </style>
@endpush
@section('content')
    <div id="smail-device" class="d-block d-sm-none d-md-none d-lg-none d-xl-none d-xxl-none">
        <div class="mobile-container">
            <div>
                <div class="header">
                    <button class="text-dark bg-transparent border-0 d-none p-0" id="close-cashbox-amount">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <a href="{{ route('admin.dashboard.index') }}" class="text-dark" id="back-cashbox-amount">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div class="contact-info ms-2">
                        <h5> ক্যাশবক্স মিলাই</h5>
                    </div>
                    <div class="ms-auto">
                        <a id="report-text" href=""><i class="fa-solid fa-file-lines"></i> রিপোর্ট</a>
                    </div>
                </div>
                <div id="contentaddeddiv">
                    <div class="action-buttons-header d-none" id="equal-amount-div">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="action-buttons-header-main">
                                    <div class="action-buttons-header-main-first">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4>বর্তমান ক্যাশ (এন্ট্রি করা)</h4>
                                            <h4 id="equal-total-enty-amount"></h4>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4>ক্যাশবক্সে আছে</h4>
                                            <h4>{{ convertToLocaleNumber($cashboxAmount ?? 0) }}</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="bold-text">বাড়তি টাকা</h4>
                                            <h4></h4>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4>অ্যাপে এন্ট্রি করা হয়নি</h4>
                                            <h4 id="equal-not-enty">{{ convertToLocaleNumber(0) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="confirm-btn">
                            <p class="title">আপনার ক্যাশবক্স এবং বর্তমান ক্যাশের পরিমাণ সমান আছে।</p>
                            <a class="btn confirm-btn" href="{{ route('admin.dashboard.index') }}">ঠিক আছে</a>
                        </div>
                    </div>

                    <div class="action-buttons-header d-none" id="loss-amount-div">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="action-buttons-header-main">
                                    <div class="action-buttons-header-main-first">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4>বর্তমান ক্যাশ (এন্ট্রি করা)</h4>
                                            <h4 id="loss-total-enty-amount"></h4>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4>ক্যাশবক্সে আছে</h4>
                                            <h4>{{ convertToLocaleNumber($cashboxAmount ?? 0) }}</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="bold-text">টাকা ঘাটতি </h4>
                                            <h4></h4>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4>অ্যাপে এন্ট্রি করা হয়নি</h4>
                                            <h4 id="loss-not-enty" class="balance-amount negetive"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="confirm-btn">
                            <p class="title">অনুগ্রহ করে ক্যাশ কেনা, খরচ বা মালিক নিলে এন্ট্রি করে ক্যাশ মিলিয়ে নিন।</p>
                            <button id="less-amount-ok-btn" class="btn confirm-btn">ঠিক আছে</button>
                        </div>
                    </div>

                    <div class="action-buttons-header d-none" id="height-amount-div">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="action-buttons-header-main">
                                    <div class="action-buttons-header-main-first">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4>ক্যাশবক্সে আছে</h4>
                                            <h4>{{ convertToLocaleNumber($cashboxAmount ?? 0) }}</h4>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4>বর্তমান ক্যাশ (এন্ট্রি করা)</h4>
                                            <h4 id="height-total-enty-amount"></h4>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="bold-text">বাড়তি টাকা</h4>
                                            <h4></h4>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4>অ্যাপে এন্ট্রি করা হয়নি</h4>
                                            <h4 id="height-not-enty" class="balance-amount positive"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="confirm-btn">
                            <p class="title">অনুগ্রহ করে ক্যাশ কেনা, খরচ বা মালিক নিলে এন্ট্রি করে ক্যাশ মিলিয়ে নিন।</p>
                            <button id="less-amount-ok-btn" class="btn confirm-btn">ঠিক আছে</button>
                        </div>
                    </div>
                </div>
                <form id="customerSupplierPaybillFrom" action="{{ route('admin.dashboard.pay.bill.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="action-buttons">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="input-group">
                                    <span class="input-group-text px-2 py-1" id="basic-addon1"><span class="fs-4"
                                            style="color: #666;">৳</span></span>
                                    <input type="number" id="total_amount" name="total_amount" class="form-control px-0"
                                        placeholder="ক্যাশবক্সে আছে" aria-describedby="basic-addon1" autocomplete="off">
                                </div>
                                <p id="optinaltext">ক্যাশবক্সে এখন মোট টাকার পরিমাণ লিখুন</p>
                            </div>
                        </div>
                        <button type="submit" class="btn confirm-btn" disabled>
                            <div class="spinner-border text-light me-2 d-none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>পরবর্তী
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
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
        $('#total_amount').on('keyup', function() {
            var value = $(this).val();
            if (value.length != 0) {
                $('.confirm-btn').prop('disabled', false);
            } else {
                $('.confirm-btn').prop('disabled', true);
            }
        });

        $('#close-cashbox-amount').on('click', function() {
            $('#close-cashbox-amount').addClass('d-none');
            $('#back-cashbox-amount').removeClass('d-none');
            $('#equal-amount-div').addClass('d-none');
            $('#height-amount-div').addClass('d-none');
            $('#loss-amount-div').addClass('d-none');
            $('#customerSupplierPaybillFrom').removeClass('d-none');
        });
        
        $('#less-amount-ok-btn').on('click', function() {
            $('#close-cashbox-amount').addClass('d-none');
            $('#back-cashbox-amount').removeClass('d-none');
            $('#equal-amount-div').addClass('d-none');
            $('#height-amount-div').addClass('d-none');
            $('#loss-amount-div').addClass('d-none');
            $('#customerSupplierPaybillFrom').removeClass('d-none');
        });

        $(document).ready(function() {
            $('#customerSupplierPaybillFrom').on('submit', function(e) {
                e.preventDefault();
                var actionurl = $(this).attr('action');
                var RedirectUrl = "{{ route('admin.dashboard.index') }}";
                var cashboxAmount = parseFloat("{{ $cashboxAmount }}") || 0;
                var paymentamount = parseFloat($('#total_amount').val()) || 0;
                $('#close-cashbox-amount').removeClass('d-none');
                $('#back-cashbox-amount').addClass('d-none');
                
                if (cashboxAmount == paymentamount) {
                    $('#equal-amount-div').removeClass('d-none');
                    $('#height-amount-div').addClass('d-none');
                    $('#loss-amount-div').addClass('d-none');
                    $('#equal-total-enty-amount').html(convertToLocaleNumber(paymentamount));
                    $('#customerSupplierPaybillFrom').addClass('d-none');
                } else if (cashboxAmount < paymentamount) {
                    var heightamount = paymentamount - cashboxAmount;
                    $('#equal-amount-div').addClass('d-none');
                    $('#height-amount-div').removeClass('d-none');
                    $('#loss-amount-div').addClass('d-none');
                    $('#height-total-enty-amount').html(convertToLocaleNumber(paymentamount));
                    $('#height-not-enty').html(convertToLocaleNumber(heightamount));
                    $('#customerSupplierPaybillFrom').addClass('d-none');
                } else {
                    var shortamount = cashboxAmount - paymentamount;
                    $('#equal-amount-div').addClass('d-none');
                    $('#height-amount-div').addClass('d-none');
                    $('#loss-amount-div').removeClass('d-none');
                    $('#loss-total-enty-amount').html(convertToLocaleNumber(paymentamount));
                    $('#loss-not-enty').html(convertToLocaleNumber(shortamount));
                    $('#customerSupplierPaybillFrom').addClass('d-none');
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
