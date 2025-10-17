<section class="features-section rs-services home12-style">
    <div class="container">
        <div class="section-title text-center mb-5">
            <span class="sub-title primary-color">{{ __('panel.system_features_subtitle') ?? 'Why Choose Us' }}</span>
            <h2 class="title mb-3">{{ __('panel.system_features_title') ?? 'Our System Features' }}</h2>
            {{-- <p class="desc mb-0">{{ __('panel.system_features_description') ?? 'Explore what makes our platform powerful and easy to use.' }}</p> --}}
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($system_features as $feature)
                <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                    <div class="feature-item services-item text-center h-100">
                        <div class="services-image">
                            <div class="services-icons">
                                <i class="{{ $feature->icon }}"></i>
                            </div>
                            <div class="services-text">
                                <h3 class="services-title">
                                    <a class="title" href="javascript:void(0)">
                                        {{ $feature->getTranslation('title', app()->getLocale()) }}
                                    </a>
                                </h3>
                                <p class="text">
                                    {{ $feature->getTranslation('description', app()->getLocale()) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="no-features text-center py-5">
                        <i class="flaticon-search-engine display-1 primary-color mb-3"></i>
                        <h4 class="title-color mb-2">{{ __('panel.no_features_found') ?? 'No features available yet.' }}</h4>
                        <p class="text-muted">{{ __('panel.check_back_later') ?? 'Please check back later for updates.' }}</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
.features-section {
    background: var(--light-gray);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}

.features-section::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="none"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(224, 48, 50, 0.03)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.5;
}

.feature-item {
    background: #ffffff;
    padding: 50px 30px 45px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
    border: 1px solid #f0f0f0;
    position: relative;
    overflow: hidden;
}

.feature-item::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-red), var(--dark-blue));
    transform: translateX(-100%);
    transition: transform 0.4s ease;
}

.feature-item:hover::before {
    transform: translateX(0);
}

.feature-item .services-icons {
    margin-bottom: 25px;
    position: relative;
}

.feature-item .services-icons i {
    font-size: 60px;
    color: var(--primary-red);
    display: inline-block;
    transition: all 0.4s ease;
    position: relative;
    z-index: 2;
}

.feature-item .services-icons::before {
    content: '';
    position: absolute;
    width: 80px;
    height: 80px;
    background: rgba(224, 48, 50, 0.1);
    border-radius: 50%;
    top: 50%;
    right: 50%;
    transform: translate(50%, -50%);
    transition: all 0.4s ease;
}

.feature-item:hover .services-icons::before {
    background: rgba(224, 48, 50, 0.15);
    transform: translate(50%, -50%) scale(1.1);
}

.feature-item .services-title {
    margin-bottom: 15px;
}

.feature-item .services-title .title {
    font-size: 22px;
    font-weight: 700;
    color: var(--dark-text);
    text-decoration: none;
    transition: all 0.3s ease;
    line-height: 1.4;
}

.feature-item .text {
    color: #505050;
    line-height: 1.8;
    margin: 0;
    font-size: 16px;
}

.feature-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    border-color: var(--primary-red);
}

.feature-item:hover .services-icons i {
    transform: scale(1.1);
    color: var(--dark-blue);
}

.feature-item:hover .services-title .title {
    color: var(--primary-red);
}

.no-features {
    background: #ffffff;
    padding: 60px 30px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border: 2px dashed #e0e0e0;
}

.no-features i {
    opacity: 0.7;
}

.section-title .sub-title {
    font-size: 18px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: block;
    margin-bottom: 10px;
}

.section-title .title {
    font-size: 42px;
    font-weight: 700;
    color: var(--dark-text);
    line-height: 1.3;
}

.section-title .desc {
    font-size: 18px;
    color: #505050;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
}

/* Responsive Design */
@media (max-width: 991px) {
    .features-section {
        padding: 80px 0;
    }

    .section-title .title {
        font-size: 36px;
    }

    .feature-item {
        padding: 40px 25px 35px;
    }
}

@media (max-width: 767px) {
    .features-section {
        padding: 60px 0;
    }

    .section-title .title {
        font-size: 32px;
    }

    .feature-item {
        padding: 35px 20px 30px;
    }

    .feature-item .services-icons i {
        font-size: 50px;
    }
}

/* Animation for feature items */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.feature-item {
    animation: fadeInUp 0.6s ease forwards;
}

.feature-item:nth-child(1) { animation-delay: 0.1s; }
.feature-item:nth-child(2) { animation-delay: 0.2s; }
.feature-item:nth-child(3) { animation-delay: 0.3s; }
.feature-item:nth-child(4) { animation-delay: 0.4s; }
.feature-item:nth-child(5) { animation-delay: 0.5s; }
.feature-item:nth-child(6) { animation-delay: 0.6s; }
</style>
