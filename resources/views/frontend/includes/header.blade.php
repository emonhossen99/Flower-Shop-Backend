<!-- Navbar -->
@php
    use Modules\Menu\App\Models\Menu;
    use Illuminate\Support\Facades\Cache;

    $menus = Cache::remember('navbar_menus', 60*60, function () {
        return Menu::where('parent_id', '0')
            ->where('status', '1')
            ->where('position', '0')
            ->orderBy('order_by', 'asc')
            ->get();
    });
@endphp
<nav id="mastheader" class="navbar navbar-expand-lg mastheader py-3">
    <div class="container">
        <a class="navbar-brand" href="#">Flower Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i id="navbar-collapse-btn" class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                @forelse ($menus as $key => $menu)
                    <li class="nav-item">
                        <a class="nav-link {{  $key == 0 ? 'active' : '' }}" target="{{ $menu->target == 1 ? '_blank' : '' }}" href="{{ $menu->url ?? '' }}">{{ $menu->name ?? '' }}</a>
                    </li>
                @empty
                @endforelse
            </ul>
        </div>
        <div class="position-relative cart-section">
            <a class href="#"><i class="fa-solid fa-cart-plus"></i></a>
            <span>{{ count((array) session('cart')) }}</span>
        </div>
    </div>
</nav>
