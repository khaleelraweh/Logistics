<!-- Features Section start -->
<div id="rs-features" class="rs-features main-home">
    <div class="container">
        <div class="row">

            @foreach ($main_sliders->where('section', 2)->take(3) as $adv_slider)
                <div class="col-lg-4 col-md-12 md-mb-30 ">
                    <div class="features-wrap ">

                        <div class="icon-part">

                            @php
                                if ($adv_slider->firstMedia != null && $adv_slider->firstMedia->file_name != null) {
                                    $advertisor_slider_img = asset(
                                        'assets/advertisor_sliders/' . $adv_slider->firstMedia->file_name,
                                    );

                                    if (
                                        !file_exists(
                                            public_path(
                                                'assets/advertisor_sliders/' . $adv_slider->firstMedia->file_name,
                                            ),
                                        )
                                    ) {
                                        // $advertisor_slider_img = asset('image/not_found/placeholder.jpg');
                                        $advertisor_slider_img = asset('frontend/images/features/icon/3.png');
                                    }
                                } else {
                                    // $advertisor_slider_img = asset('image/not_found/placeholder.jpg');
                                    $advertisor_slider_img = asset('frontend/images/features/icon/3.png');
                                }
                            @endphp

                            {{-- <i class="{{ $adv_slider->icon }}"></i> --}}
                            <img src="{{ $advertisor_slider_img }}" alt="">
                        </div>
                        <div class="content-part">
                            <h4 class="title">
                                <span class="watermark">{{ $adv_slider->title }}</span>
                            </h4>
                            <p class="dese">
                                {{ $adv_slider->subtitle }}
                            </p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Features Section End -->
