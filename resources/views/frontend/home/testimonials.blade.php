<!-- Testimonials -->
<section id="testimonials-section">
    <div class="container py-5">
        <h6 data-aos="fade-up" class="common-title text-center mb-4">{{ config('settings.testimonailsectiontitle') ?? 'TESTIMONAIL' }}</h6>
        <h2 data-aos="fade-down" class="section-title">{{ config('settings.testimonailsectionsubtitle') ?? 'Hear From Our Happy Customers' }}
        </h2>
        <p data-aos="fade-up" class="common-short-title text-center">
            {{ config('settings.testimonailsectiondescriptiontitle') ??
                'Share some details here. This is Flexible section where you can share anything you want..' }}
        </p>
        <div class="row g-4">
            @forelse ($testimonails as $testimonail)
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="star-rating mb-2">
                            {!! reviewstar($testimonail->ratting ?? 1) !!}
                        </div>
                        <p class="mb-2 client-review">"{!! $testimonail->review ?? '' !!}</p>
                        <div class="d-flex justify-content-center mt-4">
                            <div>
                                @if ($testimonail->image != null)
                                    <img data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000" src="{{ asset($testimonail->image ?? '') }}" class="testimonial-img" alt="image">
                                @else
                                    <img data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000" src="{{ asset('backend/assets/img/avatars/blank image.jpg') }}" class="testimonial-img" alt="image">
                                @endif
                            </div>
                            <div class="ms-3 client-info">
                                <h5 class="name mb-0" data-aos="fade-up" data-aos-duration="500">{{ $testimonail->name ?? '' }} </h5>
                                <p class="designation mb-0" data-aos="fade-down" data-aos-duration="500">{{ $testimonail->designation ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
