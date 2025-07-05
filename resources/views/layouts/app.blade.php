<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"  content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(config('settings.favicon_first') ?? '') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(config('settings.favicon_second') ?? '') }}">
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <!-- Font Family  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@100..800&family=Hind+Siliguri:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">  

    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('backend/assets/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/multipleimage.css') }}">
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/responsive.css') }}" rel="stylesheet">

    {{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- select2-bootstrap4-theme -->
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">

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
        .dropdown-toggle::after {
            display: none !important;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="wrapper position-relative" >
        <div class="spinner-borders text-success d-none" role="status" id="commonLoadeBackend">
            <span class="visually-hidden">Loading...</span>
        </div>
        <!-- Sidebar Start -->
        @include('backend.includes.sidebar')
        <!-- Sidebar End -->

        <div class="main">
            <!-- Header Start -->
            @include('backend.includes.header')
            <!-- Header End -->

            <main class="content">
                <div class="container-fluid p-0">
                    <!-- Breadcrumb -->
                    @isset($breadcrumb)
                        @include('backend.includes.breadcrumb')
                    @endisset
                    <!-- Content -->
                    @yield('content')
                </div>
            </main>

            <!-- Footer Start -->
            @include('backend.includes.footer')
            <!-- Footer End -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <!-- Toastr JS-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        var _token = "{{ csrf_token() }}";

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


    <!--=================== Datatables Script ==================-->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/assets/js/image-preview.js') }}"></script>
    <script src="{{ asset('backend/assets/js/image-gallary.js') }}"></script>
    <script src="{{ asset('backend/assets/js/deletealert.js') }}"></script>

    <!--=================== Summernote Script ==================-->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!--=================== Apexcharts Script ==================-->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
   <script>
       $('.summernote').summernote({
           placeholder: 'Enter Your Text !!',
           tabsize: 2,
           height: 100
       });
   </script>
   <script>
    window.localizationTexts = {
        deleteTitle: "{{ __f('Delete Alert Text') }}",
        confirmButton: "{{ __f('Delete Confirem Text') }}",
        cancelButton: "{{ __f('Delete Cancel Text') }}",
        successMessage: "{{ __f('Delete Success Message') }}",
        successOkButton: "{{ __f('OK Button Text') }}"
    };
</script>

   @stack('scripts')
</body>

</html>
