<!-- CTA Section -->
<section id="cta-section">
    <section class="cta-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center mb-3 mb-md-0">
                    <img data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1200" src="{{ config('settings.special_offer_section_image') ? asset(config('settings.special_offer_section_image')) : asset('frontend/asset/image/default/offer.jpg')}}" alt="image">
                </div>
                <div class="col-md-6 cta-content text-md-start text-center">
                    <p data-aos="fade-down" class="common-title">{{ config('settings.specialoffersectiontitle') ?? 'SPECIAL OFFER' }}</p>
                    <h2 data-aos="fade-up" class="cta-section-title">{{ config('settings.specialoffersectionsubtitle') ?? 'Your Floral
                        Journey Begins Here: Get 20% Off Your First Order!' }}</h2>
                    <a data-aos="fade-down" href="{{ config('settings.specialoffersectionbtnurltitle') ?? 'javascript:' }}" class="btn common-btn-flower mt-4">{{ config('settings.specialoffersectionbtntitle') ?? 'Shop Now' }}</a>
                </div>
            </div>
        </div>
    </section>
</section>
