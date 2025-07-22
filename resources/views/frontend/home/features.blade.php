<!-- Features -->
@if (isset($features) && count($features) > 0)
    <section id="features-section">
        <div class="container py-4">
            <div class="features-section-wapper">
                <div class="row g-3">
                    @forelse ($features as $key => $feature)
                        @php
                            $aos = 'fade-right';
                            if($key == 0){
                                $aos = 'fade-right';
                            }else if ($key == 1) {
                               $aos = 'fade-down';
                            }else if ($key == 2) {
                               $aos = 'fade-up';
                            }else{
                                $aos = 'fade-left';
                            }
                        @endphp
                        <div class="col-md-3 col-12" data-aos="{{ $aos ?? '' }}"
                            data-aos-duration="{{ ($key) * 1000 }}">
                            <div class="feature-card">
                                <span>{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
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
