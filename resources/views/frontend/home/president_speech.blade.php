@if ($president_speech)
    <div id="rs-about" class="rs-about style1 pt-100 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 pl-110 order-last md-pl-15 md-mb-60">
                    <div class="img-part js-tilt">
                        @php
                            if ($president_speech->promotional_image != null) {
                                $president_speech_img = asset(
                                    'assets/president_speeches/' . $president_speech->promotional_image,
                                );

                                if (
                                    !file_exists(
                                        public_path(
                                            'assets/president_speeches/' . $president_speech->promotional_image,
                                        ),
                                    )
                                ) {
                                    $president_speech_img = asset('image/not_found/placeholder.jpg');
                                }
                            } else {
                                $president_speech_img = asset('image/not_found/placeholder.jpg');
                            }
                        @endphp
                        {{-- <img class="ima" src="{{ asset('frontend/images/president_speech/president_img.png') }}"
                            alt=""> --}}
                        <img class="ima" src="{{ $president_speech_img }} " alt="">
                        <img class="shape top-center animated rotate infinite"
                            src="{{ asset('frontend/images/president_speech/image-center-circle.png') }}"
                            alt="Cirle Shape Img">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="sec-title mb-40 md-mb-20 text-left">
                        <h2 class="title mb-0 header-news"> {!! $president_speech->title ?? '' !!} </h2>
                    </div>
                    <div class="sec-title mb-26 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                        {!! $president_speech->content ?? '' !!}
                    </div>
                    <div class="btn-part wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms">
                        <a class="readon2" href="#">{{ __('panel.move_to_the_rest_of_the_speech') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
