<!-- Top-Selling Flowers -->
@if ($dynamicCategorySection && count($dynamicCategorySection) > 0)
    <section id="top-selling-flowers-section">
        <div class="container py-5">
            <h6 class="common-title text-center mb-4">{{ config('settings.bestsellingsectiontitle') ?? 'BEST SELLING' }}
            </h6>
            <h2 class="section-title">
                {{ config('settings.bestsellingsectionsubtitle') ?? 'Blossom with the Best Our Top-Selling Flowers' }}
            </h2>
            <p class="common-short-title text-center mb-5">
                {{ config('settings.bestsellingsectiondescriptiontitle') ??
                    'Share some details here. This is Flexible section where you can share anything you want..' }}
            </p>
            @forelse ($dynamicCategorySection as $key => $dynamicCategory)
                <div class="position-relative">
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <h4>{{ $dynamicCategory->name ?? '' }}</h4>
                    </div>
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow owl-carousel-{{ $key }} mb-3">
                        @forelse ($dynamicCategory->products as $product)
                            <div class="product-card">
                                <div class="product-card-image">
                                    @if ($product->product_image != null)
                                        <img src="{{ asset($product->product_image ?? '') }}" class="card-img-top"
                                            alt="Red Rose Delight">
                                    @else
                                        <img src="{{ asset('backend/assets/img/avatars/blank image.jpg') }}"
                                            class="card-img-top" alt="Red Rose Delight">
                                    @endif
                                    @if ($product->tag != null)
                                        <span class="badge-first">{{ $product->tag ?? '' }}</span>
                                    @endif
                                    <a href="{{ route('add.to.cart', ['id' => $product->id]) }}"><span
                                            class="badge-second"><i class="fa-solid fa-cart-plus"></i></span></a>
                                </div>
                                <div class="product-card-body">
                                    <div class="category-title">{{ $dynamicCategory->name ?? '' }}</div>
                                    <div class="card-title">{{ $product?->name ?? '' }}</div>
                                    <div class="card-text">
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </div>
                                    <div class="price-section">
                                         @if($product?->discount_price != null)
                                            <del class="discount-price">{{ currency() ?? '$' }}{{ $product?->price ?? '' }}</del> 
                                            {{ currency() ?? '$' }}{{ $product?->discount_price ?? '' }}
                                        @else 
                                            {{ currency() ?? '$' }}{{ $product?->price ?? 0.00 }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </section>
    <script>
        $(document).ready(function() {
            @foreach ($dynamicCategorySection as $key => $category)
                $('.owl-carousel-{{ $key }}').owlCarousel({
                    nav: true,
                    dots: true,
                    margin: 20,
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: {{ $key + 3000 ?? 4000 }},
                    responsive: {
                        0: {
                            items: 2
                        },
                        480: {
                            items: 2
                        },
                        768: {
                            items: 3
                        },
                        992: {
                            items: 4
                        },
                        1280: {
                            items: 4,
                            nav: true
                        }
                    }
                });
            @endforeach
        });
    </script>
@endif
