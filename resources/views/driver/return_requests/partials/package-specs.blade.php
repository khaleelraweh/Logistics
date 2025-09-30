{{-- resources/views/driver/return_requests/partials/package-specs.blade.php --}}
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-light border-0 text-center h-100">
            <div class="card-body">
                <i class="mdi mdi-package-variant fs-1 text-primary mb-3"></i>
                <div class="info-label">{{ __('package.package_type') }}</div>
                <div class="info-value fw-bold">{{ __('package.type_' . $package->package_type) }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-light border-0 text-center h-100">
            <div class="card-body">
                <i class="mdi mdi-arrow-expand-all fs-1 text-info mb-3"></i>
                <div class="info-label">{{ __('package.package_size') }}</div>
                <div class="info-value fw-bold">{{ __('package.size_' . $package->package_size) }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-light border-0 text-center h-100">
            <div class="card-body">
                <i class="mdi mdi-weight fs-1 text-warning mb-3"></i>
                <div class="info-label">{{ __('package.weight') }}</div>
                <div class="info-value fw-bold">{{ $package->weight }} {{ __('package.kgm') }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-light border-0 text-center h-100">
            <div class="card-body">
                <i class="mdi mdi-ruler-square fs-1 text-success mb-3"></i>
                <div class="info-label">{{ __('package.dimensionss') }}</div>
                <div class="info-value fw-bold">
                    {{ $package->dimensions['length'] ?? 0 }}×{{ $package->dimensions['width'] ?? 0 }}×{{ $package->dimensions['height'] ?? 0 }}
                    {{ __('package.cm') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 bg-light">
            <div class="card-body">
                <div class="info-label">{{ __('package.package_content') }}</div>
                <div class="info-value">
                    @if($package->package_content)
                        {{ $package->package_content }}
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mb-4">
        <div class="card border-0 bg-light">
            <div class="card-body">
                <div class="info-label">{{ __('package.package_note') }}</div>
                <div class="info-value">
                    @if($package->package_note)
                        {{ $package->package_note }}
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 bg-light">
            <div class="card-body">
                <div class="info-label">{{ __('package.estimated_value') }}</div>
                <div class="info-value fw-bold text-success">
                    @if($package->estimated_value)
                        {{ number_format($package->estimated_value, 2) }} {{ __('general.currency') }}
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 bg-light">
            <div class="card-body">
                <div class="info-label">{{ __('package.insurance_required') }}</div>
                <div class="info-value">
                    @if($package->insurance_required)
                        <span class="badge bg-success badge-status">{{ __('general.yes') }}</span>
                    @else
                        <span class="badge bg-secondary badge-status">{{ __('general.no') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($package->fragile || $package->perishable || $package->hazardous)
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-warning">
            <div class="card-header bg-warning text-white">
                <i class="mdi mdi-alert-outline me-2"></i>
                {{ __('package.special_handling') }}
            </div>
            <div class="card-body">
                <div class="row">
                    @if($package->fragile)
                    <div class="col-md-4 mb-2">
                        <span class="badge bg-danger badge-status">
                            <i class="mdi mdi-glass-fragile me-1"></i>
                            {{ __('package.fragile') }}
                        </span>
                    </div>
                    @endif
                    @if($package->perishable)
                    <div class="col-md-4 mb-2">
                        <span class="badge bg-warning badge-status">
                            <i class="mdi mdi-snowflake me-1"></i>
                            {{ __('package.perishable') }}
                        </span>
                    </div>
                    @endif
                    @if($package->hazardous)
                    <div class="col-md-4 mb-2">
                        <span class="badge bg-dark badge-status">
                            <i class="mdi mdi-alert-octagon me-1"></i>
                            {{ __('package.hazardous') }}
                        </span>
                    </div>
                    @endif
                </div>
                @if($package->handling_instructions)
                <div class="mt-3">
                    <div class="info-label">{{ __('package.handling_instructions') }}</div>
                    <div class="info-value">{{ $package->handling_instructions }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
