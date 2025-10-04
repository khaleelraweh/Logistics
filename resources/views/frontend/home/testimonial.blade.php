<div class="rs-testimonial main-home pt-100 pb-100 md-pt-70 md-pb-70">
    <div class="container">
        <div class="sec-title3 mb-50 md-mb-30 text-center">
            <div class="sub-title primary">{{ __('frontend.testimonial_subtitle') ?? 'Testimonial' }}</div>
            <h2 class="title white-color">{{ __('frontend.testimonial_title') ?? 'What Our Students Say' }}</h2>
        </div>

        <div class="rs-carousel owl-carousel"
            data-loop="true"
            data-items="2"
            data-margin="30"
            data-autoplay="true"
            data-hoverpause="true"
            data-autoplay-timeout="5000"
            data-smart-speed="800"
            data-dots="true"
            data-nav="false"
            data-md-device="2"
            data-md-device-dots="true"
            data-center-mode="false"
            data-ipad-device="2"
            data-ipad-device-dots="true"
            data-mobile-device="1"
            data-mobile-device-dots="true">

            @foreach($testimonials as $testimonial)
                <div class="testi-item">
                    <div class="author-desc">
                        <div class="desc">
                            <img class="quote" src="{{ asset('frontend/images/testimonial/main-home/test-2.png') }}" alt="quote">
                            {!! $testimonial->getTranslation('content', app()->getLocale()) !!}
                        </div>
                        <div class="author-img">
                            <img src="{{ $testimonial->image && file_exists(public_path('assets/testimonials/'.$testimonial->image))
                                    ? asset('assets/testimonials/'.$testimonial->image)
                                    : asset('frontend/images/testimonial/default.png') }}"
                                 alt="{{ $testimonial->getTranslation('name', app()->getLocale()) }}">
                        </div>
                    </div>

                    <div class="author-part">
                        <a class="name" href="#">
                            {{ $testimonial->getTranslation('name', app()->getLocale()) }}
                        </a>
                        <span class="designation">
                            {{ $testimonial->getTranslation('title', app()->getLocale()) }}
                        </span>
                    </div>
                </div>
            @endforeach

            @if($testimonials->isEmpty())
                <p class="text-center text-muted">{{ __('frontend.no_testimonials_found') ?? 'No testimonials available yet.' }}</p>
            @endif

        </div>
    </div>
</div>
