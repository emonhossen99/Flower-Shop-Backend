<!-- Final CTA Section -->
<section id="final-cta-section">
    <div class="cta-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center mb-3 mb-md-0">
                    <img data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1200" src="{{ config('settings.call_to_action_section_image') ? asset(config('settings.call_to_action_section_image')) : asset('frontend/asset/image/default/final-cta.jpg') }}" alt="image">
                </div>
                <div class="col-md-6 cta-content text-md-start text-center">
                    <p data-aos="fade-up" class="common-title">{{ config('settings.calltoactionsectiontitle') ?? 'Call to action' }}</p>
                    <h2 data-aos="fade-down" class="cta-section-title">{{ config('settings.calltoactionsectionsubtitle') ?? 'Explore Our
                        Exquisite Floral Collections & Shop Now for the Perfect Blooms' }}</h2>
                    <a data-aos="fade-up" href="{{ config('settings.calltoactionsectionbtnurltitle') ?? 'javascript:' }}" class="btn common-btn-flower mt-4">{{ config('settings.calltoactionsectionbtntitle') ?? 'Shop Now' }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
