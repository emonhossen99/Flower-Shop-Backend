<!-- Features -->
@if (isset($features) && count($features) > 0)
<section id="features-section">
    <div class="container py-4">
        <div class="features-section-wapper">
            <div class="row g-3">
                @forelse ($features as $key => $feature)
                    <div class="col-md-3 col-12">
                        <div class="feature-card">
                            <span>{{ '0' . $key + 1 }}</span>
                            <h5>{{ Str::limit($feature->title ?? '', 20, '...') }}</h5>
                            <p class="common-short-title mb-0">{!! $feature->description ?? '' !!}</p>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</section>
@endif

