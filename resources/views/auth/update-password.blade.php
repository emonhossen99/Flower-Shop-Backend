<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title ?? 'Reset Password' }} - {{ env('APP_NAME') }}</title>
    <meta name="title" content="register">
    <meta name="keywords" content="register">
    <meta name="description" content="register">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(config('settings.favicon_first') ?? '') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(config('settings.favicon_second') ?? '') }}">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    {{-- <link rel="shortcut icon" href="{{ asset('frontend/assets/images/icons/favicon.ico') }}"> --}}
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet"
        href="{{ asset('backend/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }} ">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/jquery.countdown.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/5starreview.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/skins/skin.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/nouislider/nouislider.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- AOS Animation CSS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@100..800&family=Hind+Siliguri:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ route('dynamic.style') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {!! config('settings.pixcelsetupcode') !!}
    <style>
        .required::after {
            content: '*';
            color: red;
        }

        #getDataImage,
        #getDataImageTwo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .toast-success {
            background-color: #51A351;
        }

        .toast-error {
            background-color: #BD362F;
        }

        .toast-info {
            background-color: #2F96B4;
        }

        .toast-warning {
            background-color: #F89406;
        }

        #main-page-loader {
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 9999;
            background-color: #fff;
        }

        #page-loader {
            border: 5px solid rgba(217, 217, 217, 0.5);
            border-radius: 50%;
            border-top: 5px solid #01bf66;
            width: 55px;
            height: 55px;
            position: absolute;
            left: 50%;
            right: 0;
            top: 50%;
            margin-left: -60px;
            margin-top: -60px;
            bottom: 0;
            -webkit-animation: spin 2s linear infinite;
            -o-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div id="main-page-loader">
        <div id="page-loader"></div>
    </div>
    <div class="page-wrapper">
        <!-- Header Start  -->
        @if (config('settings.loginheadershowchosevalue') == 2 || config('settings.loginheadershowchosevalue') == null)
            @if (config('settings.headerchosevalue') == 1)
                @include('frontend.includes.headers.header-one')
            @elseif(config('settings.headerchosevalue') == 2)
                @include('frontend.includes.headers.header-two')
            @elseif(config('settings.headerchosevalue') == 3)
                @include('frontend.includes.headers.header-three-for-computer')
            @else
                @include('frontend.includes.headers.header-five-for-daraz')
            @endif
        @endif
        <!-- Header End  -->
        @if (config('settings.loginbreadcrumbshowchosevalue') == 2 || config('settings.loginbreadcrumbshowchosevalue') == null)
            @isset($breadcrumb)
                <main class="main">
                    @if (config('settings.breadcrumchosevalue') == 1)
                        @include('frontend.includes.breadcrumbs.breadcrumb-one')
                    @elseif(config('settings.breadcrumchosevalue') == 2)
                        @include('frontend.includes.breadcrumbs.breadcrumb-two')
                    @else
                        @include('frontend.includes.breadcrumbs.breadcrumb-three')
                    @endif
                </main>
            @endisset
        @endif

        <div class="main d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="login-page-one">
                            <div class="heading heading-border mb-1 frontend-product-title text-center">
                                <h2 class="title ps-2 ">{{ config('settings.forgotpagetitle') ?? '' }}</h2>
                            </div>
                            <form method="POST" action="{{ route('user.password.update') }}">
                                @csrf
                                <div class="row">
                                    <label for="email" class="col-md-4 col-form-label required">{{ __('Email Address') }}</label>
                                    <div class="col-md-8">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ $user->email ?? old('email') }}" required
                                            autocomplete="email" autofocus placeholder="Enter Your Email Address">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="password" class="col-md-4 col-form-label required">{{ __('Password : ') }}</label>
                                    <div class="col-md-8">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password"
                                            placeholder="Enter Your Password...">
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <label for="password-confirm" class="col-md-4 col-form-label required">{{ __('Confirm Password : ') }}</label>
                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="Enter Your Confirm Password...">
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-6">
                                        <a href="{{ route('login') }}"
                                            class="btn loginpagecommonbtn w-100 fs-2 fw-bold text-white">
                                            {{ __('Back') }}
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit"
                                            class="btn loginpagecommonbtn w-100 fs-2 fw-bold text-white">
                                            {{ __('Continue') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .main -->
        <!-- Login Modal Start -->
        @if (config('settings.loginfootershowchosevalue') == 2 || config('settings.loginfootershowchosevalue') == null)
            @if (config('settings.footerchosevalue') == 1)
                @include('frontend.includes.footers.footer-one')
            @elseif(config('settings.footerchosevalue') == 2)
                @include('frontend.includes.footers.footer-two')
            @elseif(config('settings.footerchosevalue') == 3)
                @include('frontend.includes.footers.footer-three')
            @elseif(config('settings.footerchosevalue') == 4)
                @include('frontend.includes.footers.footer-four')
            @else
                @include('frontend.includes.footers.footer-five')
            @endif
        @endif
        <!-- Login Modal End -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Toastr JS-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function flashMessage(status, message) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            switch (status) {
                case 'success':
                    toastr.success(message);
                    break;

                case 'error':
                    toastr.error(message);
                    break;

                case 'info':
                    toastr.info(message);
                    break;

                case 'warning':
                    toastr.warning(message);
                    break;
            }
        }

        @if (Session::get('success'))
            flashMessage('success', "{{ Session::get('success') }}")
        @elseif (Session::get('error'))
            flashMessage('error', "{{ Session::get('error') }}")
        @elseif (Session::get('info'))
            flashMessage('info', "{{ Session::get('info') }}")
        @elseif (Session::get('warning'))
            flashMessage('warning', "{{ Session::get('warning') }}")
        @endif
    </script>
    <script>
        document.onreadystatechange = function() {
            var state = document.readyState;
            if (state == "interactive") {
                document.getElementById("mainbody").style.visibility = "hidden";
            } else if (state == "complete") {
                setTimeout(function() {
                    document.getElementById("interactive");
                    document.getElementById("main-page-loader").style.visibility = "hidden";
                    document.getElementById("mainbody").style.visibility = "visible";
                }, 10);
            }
        }

        $(document).on('submit', '#cartremoveFormHeader', function(e) {
            e.preventDefault();
            const projectRedirectUrl = "{{ route('view.cart') }}";
            const formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status === 'success') {
                        flashMessage('success', res.message);
                        window.location.href = projectRedirectUrl;
                    }
                },
                error: function(xhr) {
                    console.log('Something went wrong. Please try again.');
                }
            });
        });

        $(document).on('click', '#add-to-cart-btn', function(e) {
            const productId = $(this).data("id");
            $.ajax({
                url: "{{ route('add.to.cart') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                },
                success: function(res) {
                    var route = "{{ route('check.out') }}";
                    // $('.cart_count').html(res.countcart);
                    // $('#drop_down_cart_product').html(res.data);
                    // $('#cart-total-price').html(res.totalPrice);
                    // flashMessage(res.status, res.message);
                    window.location.href = route;
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        $(document).on('keyup', '#frontent_product_search', function(e) {
            var searchvalues = $(this).val();
            $.ajax({
                url: "{{ route('product.search') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    searchvalue: searchvalues,
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#showSearchProducts').html('');
                        $('#showSearchProducts').html(res.data);
                    } else {
                        $('#showSearchProducts').html('');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Plugins JS File -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }} "></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('frontend/assets/js/jquery.hoverIntent.min.js') }} "></script>
    <script src="{{ asset('frontend/assets/js/jquery.waypoints.min.js') }} "></script>
    <script src="{{ asset('frontend/assets/js/superfish.min.js') }} "></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }} "></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-input-spinner.js') }} "></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }} "></script>
    <script src="{{ asset('frontend/assets/js/jquery.plugin.min.js') }} "></script>
    <script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }} "></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.elevateZoom.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wNumb.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/nouislider.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('frontend/assets/js/main.js') }} "></script>
    <!-- AOS Animation JS-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>

</html>
