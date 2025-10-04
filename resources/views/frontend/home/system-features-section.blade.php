<style>
    /* قسم الميزات */
    .features-section {
        background-color: #f9fafc; /* لون مختلف عن الأقسام الأخرى */
        padding: 80px 0;
    }

    .features-section .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .features-section .section-title h2 {
        font-size: 32px;
        font-weight: 700;
        color: #222;
        margin-bottom: 10px;
    }

    .features-section .section-title p {
        color: #777;
        font-size: 16px;
    }

    .feature-item {
        text-align: center;
        padding: 30px 20px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
    }

    .feature-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .feature-item i {
        font-size: 40px;
        color: #19c8fa;
        margin-bottom: 20px;
    }

    .feature-item h4 {
        font-size: 20px;
        color: #333;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .feature-item p {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
    }
</style>

<!-- ✅ Start System Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-title">
            <h2>{{ __('panel.system_features_title') ?? 'Our System Features' }}</h2>
            <p>{{ __('panel.system_features_subtitle') ?? 'Explore what makes our platform powerful and easy to use.' }}</p>
        </div>

        <div class="row g-4">
            @forelse($system_features as $feature)
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="feature-item h-100">
                        <i class="{{ $feature->icon }}"></i>
                        <h4>{{ $feature->getTranslation('title', app()->getLocale()) }}</h4>
                        <p>{{ $feature->getTranslation('description', app()->getLocale()) }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">{{ __('panel.no_features_found') ?? 'No features available yet.' }}</p>
            @endforelse
        </div>
    </div>
</section>
<!-- ✅ End System Features Section -->
