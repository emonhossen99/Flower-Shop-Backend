<!-- Latest Additions -->
<section id="latest-additions-section">
    <div class="container py-5">
        <h6 class="common-title text-center mb-4">{{ config('settings.latestadditionssectiontitle') ?? 'NEW ARRIVAL' }}
        </h6>
        <h2 class="section-title">
            {{ config('settings.latestadditionssectionsubtitle') ??
                'Discover the Latest Additions at Your Top Choice Flower Shop' }}
        </h2>
        <p class="common-short-title text-center mb-5">
            {{ config('settings.latestadditionssectionbtntitle') ??
                'Share some details here. This is Flexible section where you can share anything you want.' }}
        </p>
        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-md-3 col-12">
                    <a href="{{ route('view.product',['id' => $product->id ?? 0]) }}">
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
                                <a href="{{ route('add.to.cart',['id' => $product->id ]) }}"><span class="badge-second"><i class="fa-solid fa-cart-plus"></i></span></a>
                            </div>
                            <div class="product-card-body">
                                @if($product?->categories?->isNotEmpty())
                                    <div class="category-title">{{ $product->categories[0]->name ?? '' }}</div>
                                @endif
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
                    </a>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
