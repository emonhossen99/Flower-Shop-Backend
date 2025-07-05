@php
    use Modules\Menu\App\Models\Menu;
    use Illuminate\Support\Facades\Cache;

    $footers = Cache::remember('footers_menus', 60*60, function () {
        return Menu::where('status', '1')->where('position', '1')->get();
    });
@endphp
<!-- Footer -->
<footer id="footer" class="footer mt-0">
    <div class="container">
        <div class="footer-wapper">
            <div class="row">
                <div class="col-md-6 mb-2 mb-md-0">
                    <h5 class="footer-title mb-0">Flower Shop</h5><br>
                    <span class="copyright-title">{!! config('settings.footer_section_description_text') ?? 'Welcome to the world of Florist, where flowers come to life with love and creativity. Discover our story, our passion for flowers, and our commitment to making every moment memorable.' !!}</span>
                </div>
                <div class="col-md-3">
                    <h5 class="footer-title mb-0">{{ config('settings.footer_second_gird_title') ?? 'Links' }}</h5><br>
                    @forelse ($footers  as $key => $menu)
                        <a class="footer-link {{  $key == 0 ? 'active' : '' }}" target="{{ $menu->target == 1 ? '_blank' : '' }}" href="{{ $menu->url ?? '' }}">{{ $menu->name ?? '' }}</a>
                    @empty
                    @endforelse
                </div>
                <div class="col-md-3">
                    <h5 class="footer-title mb-0">{{ config('settings.footer_section_third_title') ?? 'Contact Us' }}</h5><br>
                    <span class="footer-contact">{{ config('settings.footer_section_email') ?? 'info@flowershop.com' }}</span><br>
                    <span class="footer-contact">{{ config('settings.footer_section_phone') ?? '+1 234 567 8901' }}</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <p class="mb-0">{{ config('settings.footer_section_copyright') ?? 'Copyright © 2025 Flower Shop' }}</p>
            <div class="d-flex align-items-center footer-social-icons">
                @if(config('settings.footer_section_facebook_url') != null)
                    <a href="{{ config('settings.footer_section_facebook_url') ?? '' }}"><i id="facebook" class="fa-brands fa-facebook"></i></a>
                @endif
                @if(config('settings.footer_section_twitter_url') != null)
                    <a href="{{ config('settings.footer_section_twitter_url') ?? '' }}"><i id="twitter" class="fa-brands fa-x-twitter"></i></a>
                @endif
                @if(config('settings.footer_section_instagram_url') != null)
                    <a href="{{ config('settings.footer_section_instagram_url') ?? '' }}"><i id="instagram" class="fa-brands fa-instagram"></i></a>
                @endif
                @if(config('settings.footer_section_youtube_url') != null)
                    <a href="{{ config('settings.footer_section_youtube_url') ?? '' }}"><i id="youtube" class="fa-brands fa-youtube"></i></a>
                @endif
            </div>
        </div>
    </div>
</footer>
<button id="backToTopBtn" title="Go to top">↑</button>
