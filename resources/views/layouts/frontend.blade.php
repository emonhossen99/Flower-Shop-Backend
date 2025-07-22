<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <meta name="title" content="@yield('metatitle')">
    <meta name="keywords" content="@yield('metakeywords')">
    <meta name="description" content="@yield('metadescription')">
    <meta name="author" content="p-themes">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(config('settings.favicon_first') ?? '') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(config('settings.favicon_second') ?? '') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts (optional, for DM Sans) -->
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/asset/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/asset/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ route('dynamic.style') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .required::after {
            content: '*';
            color: red;
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
    @stack('styles')
</head>

<body>
    {{-- <div id="main-page-loader">
        <div id="page-loader"></div>
    </div> --}}

    <div class="main" id="flower-shop">
        <!-- Header Start  -->
        @include('frontend.includes.header')

        <!-- Breadcrumb Start  -->
        @isset($breadcrumb)
            @include('frontend.includes.breadcrumb')
        @endisset

        <!-- Content Start  -->
        @yield('content')

        <!-- Footer Start  -->
        @include('frontend.includes.footer')
    </div>

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
        // document.onreadystatechange = function() {
        //     var state = document.readyState;
        //     if (state == "interactive") {
        //         document.getElementById("mainbody").style.visibility = "hidden";
        //     } else if (state == "complete") {
        //         setTimeout(function() {
        //             document.getElementById("interactive");
        //             document.getElementById("main-page-loader").style.visibility = "hidden";
        //             document.getElementById("mainbody").style.visibility = "visible";
        //         }, 10);
        //     }
        // }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/asset/js/main.js') }}"></script>
    <script src="{{ asset('frontend/asset/plugins/owl-carousel/owl.carousel.min.js') }} "></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    @stack('scripts')
</body>

</html>
