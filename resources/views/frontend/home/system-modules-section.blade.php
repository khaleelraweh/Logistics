<style>
    /* ✅ قسم وحدات النظام */
    .modules-section {
        background-color: #ffffff; /* خلفية مختلفة عن القسم السابق */
        padding: 100px 0;
    }

    .modules-section .section-title {
        text-align: center;
        margin-bottom: 60px;
    }

    .modules-section .section-title h2 {
        font-size: 32px;
        font-weight: 700;
        color: #222;
    }

    .modules-section .section-title p {
        color: #777;
        font-size: 16px;
    }

    .module-item {
        background: #f9fafc;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
    }

    .module-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .module-item i {
        font-size: 45px;
        color: #19c8fa;
        margin-bottom: 20px;
    }

    .module-item h4 {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }

    .module-item p {
        color: #666;
        font-size: 15px;
        line-height: 1.6;
    }

    .module-properties {
        list-style: none;
        padding: 0;
        margin-top: 20px;
    }

    .module-properties li {
        color: #555;
        font-size: 14px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .module-properties li i {
        color: #19c8fa;
        margin-right: 8px;
        font-size: 13px;
    }
</style>

<!-- ✅ Start System Modules Section -->
<section class="modules-section">
    <div class="container">
        <div class="section-title">
            <h2>{{ __('panel.system_modules_title') ?? 'System Modules' }}</h2>
            <p>{{ __('panel.system_modules_subtitle') ?? 'Explore our integrated logistics management systems' }}</p>
        </div>

        <div class="row g-4">
            @forelse($system_modules as $module)
                <div class="col-lg-3 col-md-6">
                    <div class="module-item h-100">
                        <i class="{{ $module->icon }}"></i>
                        <h4>{{ $module->getTranslation('title', app()->getLocale()) }}</h4>
                        <p>{{ $module->getTranslation('description', app()->getLocale()) }}</p>

                        @if($module->properties->isNotEmpty())
                            <ul class="module-properties">
                                @foreach($module->properties as $property)
                                    <li>
                                        <i class="fa fa-check-circle"></i>
                                        {{ $property->getTranslation('property_value', app()->getLocale()) }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">{{ __('panel.no_modules_found') ?? 'No modules available yet.' }}</p>
            @endforelse
        </div>
    </div>
</section>
<!-- ✅ End System Modules Section -->
