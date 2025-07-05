<style>
    .breadcrumb-item+.breadcrumb-item::before {
        float: none !important;
        padding-right: 0rem !important;
    }

    .page-header {
        border: 1px solid #dee2e6 !important;
        display: flex;
        justify-content: space-between;
        background: white;
        align-items: center;
    }

    .page-header .material-icons {
        font-size: 20px !important;
    }
    .page-header .create-btn {
        background:var(--bs-btn-bg);
    }
</style>
<div class="page-header border mb-3">
    <nav>
        <ol class="breadcrumb mb-0 border-0 bg-white d-flex align-items-center py-3 ">
            @foreach ($breadcrumb as $title => $url)
                <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }} align-items-center me-1">
                    @if ($loop->last)
                        <span class="">{{ $title }}</span>
                    @else
                        <a class="ms-2"
                            href="{{ $url }}">{{ $title }}</a>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
    @yield('add_button')
</div>
