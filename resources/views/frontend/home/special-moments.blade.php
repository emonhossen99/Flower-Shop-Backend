<!-- Special Moments Section -->
<section id="special-moments-section">
    <div class="container py-5">
        <div class="row align-items-end">
            <div class="col-md-3 col-6 text-end pe-2" id="special-moments-first-image">
                <img src="{{ config('settings.special_moments_section_first_image')  ? asset(config('settings.special_moments_section_first_image')) : asset('frontend/asset/image/default/about-01.jpg') }}"
                    class="special-img special-img-first" alt="about-01">
            </div>
            <div class="col-md-3 col-6 text-start" id="special-moments-second-image">
                <img src="{{ config('settings.special_moments_section_second_image') ? asset(config('settings.special_moments_section_second_image')) : asset('frontend/asset/image/default/about-02.jpg') }}"
                    class="special-img special-img-second" alt="about-02">
            </div>
            <div class="col-md-6 mt-3 mt-md-0" id="special-moments-last-image">
                <span class="common-title">{{ config('settings.specialmomentssectiontitle') ?? 'About Florist' }}</span>
                <h2 class="main-title">{{ config('settings.specialmomentssectionsubtitle') ?? "Blossoming Your Special Moments with Nature's Finest" }}</h2>
                <p class="common-short-title mb-4 pb-2">{!! config('settings.specialmomentssectionshortdescription') ?? '' !!}</p>
                <a href="{{ config('settings.specialmomentssectionbtnurltitle') ?? 'javascript:' }}" class="btn common-btn-flower">{{ config('settings.specialmomentssectionbtntitle') ?? 'Read More' }}</a>
            </div>
        </div>
    </div>
</section>
