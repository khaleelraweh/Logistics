<div class="rs-degree rs-college-institute style1 modify gray-bg pt-100 pb-100 md-pt-70 md-pb-70 qabg">
    <div class="container">
        <div class="sec-title mb-60 md-mb-30 text-left">
            <h2 class="title-1 mb-0 qa-title-line text-white">{{ __('panel.quick_access') }}</h2>
        </div>
        <div class="row">
            @foreach ($main_sliders->where('section', 2)->take(3) as $adv_slider)
                <div class="col-6  col-md-4 col-lg-4 col-xl-2 mb-4 d-flex justify-content-stretch align-items-stretch">
                    <div class="qa-content p-3 flex-fill">
                        @php
                            if ($adv_slider->firstMedia != null && $adv_slider->firstMedia->file_name != null) {
                                $advertisor_slider_img = asset(
                                    'assets/advertisor_sliders/' . $adv_slider->firstMedia->file_name,
                                );

                                if (
                                    !file_exists(
                                        public_path('assets/advertisor_sliders/' . $adv_slider->firstMedia->file_name),
                                    )
                                ) {
                                    $advertisor_slider_img = asset('frontend/images/quick_access/icon/1.png');
                                }
                            } else {
                                $advertisor_slider_img = asset('frontend/images/quick_access/icon/1.png');
                            }
                        @endphp
                        <img style="width: 5.06em;height:5.43em" src="{{ $advertisor_slider_img }}"
                            class="d-block my-0 mb-4 mx-auto" alt="Icon">
                        <h5 class="text-white text-center">{{ $adv_slider->title }}</h5>
                    </div>

                </div>
            @endforeach


            {{-- <div class="col-6  col-md-4 col-lg-4 col-xl-2 mb-4">
                <div class="qa-content p-3">
                    <img src="{{ asset('frontend/images/quick_access/icon/1.png') }}" class="d-block my-0 mb-4 mx-auto"
                        alt="Icon">
                    <h5 class="text-white text-center">محاضرات الأقسام</h5>
                </div>

            </div>
            <div class="col-6  col-md-4 col-lg-4 col-xl-2 mb-4">
                <div class="qa-content p-3">
                    <img src="{{ asset('frontend/images/quick_access/icon/1.png') }}" class="d-block my-0 mb-4 mx-auto"
                        alt="Icon">
                    <h5 class="text-white text-center">محاضرات الأقسام</h5>
                </div>

            </div>
            <div class="col-6  col-md-4 col-lg-4 col-xl-2 mb-4">
                <div class="qa-content p-3">
                    <img src="{{ asset('frontend/images/quick_access/icon/1.png') }}" class="d-block my-0 mb-4 mx-auto"
                        alt="Icon">
                    <h5 class="text-white text-center">محاضرات الأقسام</h5>
                </div>
            </div>
            <div class="col-6  col-md-4 col-lg-4 col-xl-2 ">
                <div class="qa-content p-3">
                    <img src="{{ asset('frontend/images/quick_access/icon/1.png') }}" class="d-block my-0 mb-4 mx-auto"
                        alt="Icon">
                    <h5 class="text-white text-center">محاضرات الأقسام</h5>
                </div>

            </div>
            <div class="col-6  col-md-4 col-lg-4 col-xl-2  ">
                <div class="qa-content p-3">
                    <img src="{{ asset('frontend/images/quick_access/icon/1.png') }}" class="d-block my-0 mb-4 mx-auto"
                        alt="Icon">
                    <h5 class="text-white text-center">محاضرات الأقسام</h5>
                </div>

            </div> --}}


        </div>
    </div>
</div>
