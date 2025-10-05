<section class="modules-section rs-services">
    <div class="container">
        <div class="section-title text-center mb-60">
            <span class="sub-title primary-color">{{ __('panel.system_modules_subtitle') ?? 'Integrated Solutions' }}</span>
            <h2 class="title mb-20">{{ __('panel.system_modules_title') ?? 'System Modules' }}</h2>
            <p class="desc mb-0">{{ __('panel.system_modules_description') ?? 'Explore our comprehensive logistics management systems designed to streamline your operations' }}</p>
        </div>

        <div class="row justify-content-center">
            @forelse($system_modules as $module)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-30">
                    <div class="module-item h-100">
                        <div class="module-header">
                            <div class="module-icon">
                                <i class="{{ $module->icon }}"></i>
                            </div>
                            <h4 class="module-title">{{ $module->getTranslation('title', app()->getLocale()) }}</h4>
                        </div>

                        <div class="module-body">
                            <p class="module-description">{{ $module->getTranslation('description', app()->getLocale()) }}</p>

                            @if($module->properties->isNotEmpty())
                                <div class="module-features">
                                    <h5 class="features-title">{{ __('panel.module_features') ?? 'Key Features' }}</h5>
                                    <ul class="module-properties">
                                        @foreach($module->properties as $property)
                                            <li class="property-item">
                                                <div class="property-content">
                                                    <i class="fas fa-check-circle property-icon"></i>
                                                    <span class="property-text">{{ $property->getTranslation('property_value', app()->getLocale()) }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="module-footer">
                            <button class="module-btn">
                                <span>{{ __('panel.learn_more') ?? 'Learn More' }}</span>
                                <i class="fas fa-arrow-left"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="no-modules text-center py-60">
                        <div class="empty-state">
                            <i class="flaticon-package display-1 primary-color mb-30"></i>
                            <h4 class="title-color mb-15">{{ __('panel.no_modules_found') ?? 'No modules available yet.' }}</h4>
                            <p class="text-muted mb-0">{{ __('panel.modules_coming_soon') ?? 'We are working on exciting new modules. Stay tuned!' }}</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
.modules-section {
    background: linear-gradient(135deg, #ffffff 0%, var(--light-gray) 100%);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}

.modules-section::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background:
        radial-gradient(circle at 20% 80%, rgba(0, 120, 191, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(224, 48, 50, 0.03) 0%, transparent 50%);
    pointer-events: none;
}

/* تباعد مضبوط */
.mb-60 { margin-bottom: 60px !important; }
.mb-30 { margin-bottom: 30px !important; }
.mb-20 { margin-bottom: 20px !important; }
.mb-15 { margin-bottom: 15px !important; }
.py-60 { padding-top: 60px !important; padding-bottom: 60px !important; }

.module-item {
    background: #ffffff;
    border-radius: 16px;
    padding: 0;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid #f8f9fa;
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.module-item::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-red), var(--dark-blue), var(--medium-blue));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.6s ease;
}

.module-item:hover::before {
    transform: scaleX(1);
}

.module-header {
    padding: 40px 30px 30px;
    text-align: center;
    background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
    position: relative;
}

.module-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, var(--primary-red), var(--dark-blue));
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all 0.4s ease;
}

.module-icon::before {
    content: '';
    position: absolute;
    width: 90px;
    height: 90px;
    background: rgba(224, 48, 50, 0.1);
    border-radius: 25px;
    top: 50%;
    right: 50%;
    transform: translate(50%, -50%);
    transition: all 0.4s ease;
}

.module-icon i {
    font-size: 32px;
    color: #ffffff;
    position: relative;
    z-index: 2;
    transition: all 0.4s ease;
}

.module-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--dark-text);
    margin: 0;
    line-height: 1.4;
    transition: all 0.3s ease;
}

.module-body {
    padding: 0 30px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.module-description {
    color: #666;
    line-height: 1.7;
    margin-bottom: 25px;
    font-size: 15px;
    text-align: center;
}

.module-features {
    margin-top: auto;
}

.features-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--dark-blue);
    margin-bottom: 15px;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.module-properties {
    list-style: none;
    padding: 0;
    margin: 0;
}

.property-item {
    margin-bottom: 12px;
    animation: fadeInLeft 0.5s ease forwards;
    opacity: 0;
    transform: translateX(-10px);
}

.property-content {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 8px 0;
}

.property-icon {
    color: var(--primary-red);
    font-size: 16px;
    margin-top: 2px;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.property-text {
    color: #555;
    font-size: 14px;
    line-height: 1.5;
    flex: 1;
}

.module-footer {
    padding: 25px 30px 30px;
    text-align: center;
    border-top: 1px solid #f0f0f0;
    margin-top: auto;
}

.module-btn {
    background: linear-gradient(135deg, var(--primary-red), var(--dark-blue));
    color: #ffffff;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.module-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(224, 48, 50, 0.3);
}

.module-btn i {
    transition: transform 0.3s ease;
}

.module-btn:hover i {
    transform: translateX(-3px);
}

/* Hover Effects */
.module-item:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
}

.module-item:hover .module-icon {
    transform: scale(1.1) rotate(5deg);
}

.module-item:hover .module-icon::before {
    transform: translate(50%, -50%) scale(1.1);
}

.module-item:hover .module-title {
    color: var(--primary-red);
}

.module-item:hover .property-icon {
    transform: scale(1.2);
}

/* Animations */
@keyframes fadeInLeft {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

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

.module-item {
    animation: fadeInUp 0.6s ease forwards;
}

.property-item:nth-child(1) { animation-delay: 0.1s; }
.property-item:nth-child(2) { animation-delay: 0.2s; }
.property-item:nth-child(3) { animation-delay: 0.3s; }
.property-item:nth-child(4) { animation-delay: 0.4s; }
.property-item:nth-child(5) { animation-delay: 0.5s; }

/* Empty State */
.no-modules {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
}

.empty-state {
    padding: 60px 30px;
}

.empty-state i {
    opacity: 0.7;
}

/* Responsive Design */
@media (max-width: 1199px) {
    .modules-section {
        padding: 90px 0;
    }

    .module-header {
        padding: 35px 25px 25px;
    }

    .module-body {
        padding: 0 25px;
    }

    .module-footer {
        padding: 20px 25px 25px;
    }
}

@media (max-width: 991px) {
    .modules-section {
        padding: 80px 0;
    }

    .section-title .title {
        font-size: 36px;
    }

    .module-item {
        margin-bottom: 25px;
    }

    .mb-60 { margin-bottom: 50px !important; }
    .mb-30 { margin-bottom: 25px !important; }
}

@media (max-width: 767px) {
    .modules-section {
        padding: 70px 0;
    }

    .section-title .title {
        font-size: 32px;
    }

    .section-title .desc {
        font-size: 16px;
    }

    .module-header {
        padding: 30px 20px 20px;
    }

    .module-body {
        padding: 0 20px;
    }

    .module-footer {
        padding: 20px 20px 25px;
    }

    .module-icon {
        width: 70px;
        height: 70px;
    }

    .module-icon i {
        font-size: 28px;
    }

    .mb-60 { margin-bottom: 40px !important; }
    .mb-30 { margin-bottom: 20px !important; }
    .py-60 { padding-top: 50px !important; padding-bottom: 50px !important; }
}

@media (max-width: 575px) {
    .modules-section {
        padding: 60px 0;
    }

    .section-title .title {
        font-size: 28px;
    }

}

/* تحسينات الوصول */
@media (prefers-reduced-motion: reduce) {
    .module-item,
    .property-item,
    .module-btn {
        animation: none;
        transition: none;
    }
}

/* تحسينات الطباعة */
@media print {
    .module-item {
        break-inside: avoid;
        box-shadow: none;
        border: 2px solid #ddd;
    }

    .module-btn {
        display: none;
    }
}
</style>
