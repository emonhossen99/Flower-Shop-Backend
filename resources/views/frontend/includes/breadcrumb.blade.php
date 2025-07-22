<!-- Breadcrumbs -->
<div id="main-breadcrumb" class="page-header text-center mb-2"
    style="background-image: url('{{ asset('frontend/asset/image/default/from-bright-flower-shrub-min.jpg') }}')">
    <div class="container">
        <div class="bread-inner pt-5 pb-3">
            <div class="row">
                <div class="col-12">
                    <h1>{{ $title }}</h1>
                    <ul class="bread-list d-flex justify-content-center mt-1">
                        @foreach ($breadcrumb as $title => $url)
                            @if ($loop->last)
                                <li class="active">{{ $title }}</li>
                            @else
                                <li><a href="{{ $url }}">{{ $title }}</a></li>
                                <li><i class="fa-solid fa-chevron-right"></i></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
