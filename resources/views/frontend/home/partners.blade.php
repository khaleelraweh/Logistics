<style>
    .partner-item img.partner-logo {
    max-height: 80px;
    width: auto;
    margin: 0 auto;
    transition: transform 0.3s ease;
}

.partner-item img.partner-logo:hover {
    transform: scale(1.1);
}

</style>

<!-- Start Partners Section -->
<div class="rs-partner pt-80 pb-80 md-pt-50 md-pb-50">
    <div class="container">
        <div class="sec-title3 mb-50 text-center">
            <div class="sub-title primary">{{ __('panel.partners_subtitle') ?? 'Our Partners' }}</div>
            <h2 class="title">{{ __('panel.partners_title') ?? 'Trusted by Leading Companies' }}</h2>
        </div>

        <div class="rs-carousel owl-carousel"
             data-loop="true"
             data-items="5"
             data-margin="30"
             data-autoplay="true"
             data-hoverpause="true"
             data-autoplay-timeout="3000"
             data-smart-speed="600"
             data-dots="false"
             data-nav="false"
             data-md-device="4"
             data-ipad-device="3"
             data-mobile-device="2">

            @foreach($partners as $partner)
                <div class="partner-item text-center">
                    @php
                        $imagePath = $partner->partner_image && file_exists(public_path('assets/partners/' . $partner->partner_image))
                            ? asset('assets/partners/' . $partner->partner_image)
                            : asset('frontend/images/partners/default.png');
                    @endphp

                    @if(!empty($partner->partner_link))
                        <a href="{{ $partner->getTranslation('partner_link', app()->getLocale()) }}" target="_blank" rel="noopener">
                            <img src="{{ $imagePath }}" alt="{{ $partner->getTranslation('name', app()->getLocale()) }}" class="partner-logo img-fluid">
                        </a>
                    @else
                        <img src="{{ $imagePath }}" alt="{{ $partner->getTranslation('name', app()->getLocale()) }}" class="partner-logo img-fluid">
                    @endif
                </div>
            @endforeach

            @if($partners->isEmpty())
                <p class="text-center text-muted">{{ __('panel.no_partners_found') ?? 'No partners available yet.' }}</p>
            @endif
        </div>
    </div>
</div>
<!-- End Partners Section -->
