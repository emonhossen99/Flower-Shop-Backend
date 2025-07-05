<!-- Testimonials -->
<section id="testimonials-section">
    <div class="container py-5">
        <h6 class="common-title text-center mb-4">{{ config('settings.testimonailsectiontitle') ?? 'TESTIMONAIL' }}</h6>
        <h2 class="section-title">{{ config('settings.testimonailsectionsubtitle') ?? 'Hear From Our Happy Customers' }}
        </h2>
        <p class="common-short-title text-center">
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
                                    <img src="{{ asset($testimonail->image ?? '') }}" class="testimonial-img" alt="image">
                                @else
                                    <img src="{{ asset('backend/assets/img/avatars/blank image.jpg') }}" class="testimonial-img" alt="image">
                                @endif
                            </div>
                            <div class="ms-3 client-info">
                                <h5 class="name mb-0">{{ $testimonail->name ?? '' }} </h5>
                                <p class="designation mb-0">{{ $testimonail->designation ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
