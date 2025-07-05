<!-- Hero Section -->
<section class="hero-section-overlay" style="background-image: url({{ config('settings.hero_section_bg_image') ? asset(config('settings.hero_section_bg_image')) : asset('frontend/asset/image/default/hero-bg.jpg') }})">
    <div class="hero-section d-flex">
        <div class="container d-flex align-items-center justify-content-center">
            <div class="hero-overlay">

                <h6 class="text-uppercase title">{{ config('settings.herosectiontitle') ?? 'Welcome to Florist'}}</h6>
                <h1 class="my-2 main-title">{{ config('settings.herosectionsubtitle') ?? "Let's Make Beautiful Flowers a Part of Your Life."}} </h1>
                <p class="mb-4 sub-title">
                    {!! config('settings.herosectionshortdescription') ?? '' !!} 
                </p>
                <a href="{{ config('settings.herosectionbtnurltitle') ?? 'javascript:' }}" class="btn common-btn-flower btn-lg">{{ config('settings.herosectionbtntitle') ?? 'Shop Now'  }}</a>
            </div>
        </div>
    </div>
</section>
