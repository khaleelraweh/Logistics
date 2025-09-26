@extends('layouts.admin')

@section('content')

    <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('pricing_rules.view_pricing_rule') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.pricing_rules.index') }}">{{ __('pricing_rules.pricing_rules') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('pricing_rules.view_pricing_rule') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Rule Card -->
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-black py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 text-black">{{ $pricingRule->name }}</h4>
                        <span class="badge bg-light text-dark">{{ $pricingRule->status ? __('general.active') : __('general.inactive') }}</span>
                    </div>
                    <h6 class="card-subtitle mt-2 text-black-50">{{ ucfirst($pricingRule->type) }}</h6>
                </div>

                <div class="card-body p-4">
                    <div class="mb-3">
                        <strong>{{ __('pricing_rules.description') }}:</strong>
                        <div class="border p-2 rounded bg-light">{!! $pricingRule->description !!}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>{{ __('pricing_rules.zone') }}:</strong> {{ $pricingRule->zone }}
                        </div>
                        <div class="col-md-6">
                            <strong>{{ __('pricing_rules.weight_range') }}:</strong> {{ $pricingRule->min_weight }} - {{ $pricingRule->max_weight }} g
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>{{ __('pricing_rules.dimensions') }}:</strong> {{ $pricingRule->max_length }} x {{ $pricingRule->max_width }} x {{ $pricingRule->max_height }} cm
                        </div>
                        <div class="col-md-4">
                            <strong>{{ __('pricing_rules.base_price') }}:</strong> {{ number_format($pricingRule->base_price, 2) }}
                        </div>
                        <div class="col-md-4">
                            <strong>{{ __('pricing_rules.price_per_kg') }}:</strong> {{ number_format($pricingRule->price_per_kg, 2) }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>{{ __('pricing_rules.extra_fee') }}:</strong> {{ number_format($pricingRule->extra_fee, 2) }}
                    </div>

                    <div class="mb-3">
                        <strong>{{ __('pricing_rules.flags') }}:</strong>
                        @php
                            $flags = ['oversized', 'fragile', 'perishable', 'express', 'same_day'];
                        @endphp
                        @foreach ($flags as $flag)
                            @if($pricingRule->$flag)
                                <span class="badge bg-primary me-1">{{ __('pricing_rules.' . $flag) }}</span>
                            @endif
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <strong>{{ __('general.created_at') }}:</strong> {{ $pricingRule->created_at->format('Y-m-d') }}
                    </div>
                </div>

                <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.pricing_rules.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> {{ __('general.back') }}
                    </a>
                    <div>
                        @ability('admin', 'update_pricing_rules')
                            <a href="{{ route('admin.pricing_rules.edit', $pricingRule->id) }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit me-1"></i> {{ __('general.update') }}
                            </a>
                        @endability
                        @ability('admin', 'delete_pricing_rules')
                            <a class="btn btn-danger" href="javascript:void(0)" onclick="confirmDelete('delete-pricing-rule-{{ $pricingRule->id }}',
                                                                                    '{{ __('panel.confirm_delete_message') }}',
                                                                                    '{{ __('panel.yes_delete') }}',
                                                                                    '{{ __('panel.cancel') }}')">
                                <i class="fas fa-trash me-1"></i> {{ __('general.delete') }}
                            </a>

                            <form action="{{ route('admin.pricing_rules.destroy', $pricingRule->id) }}"
                                  method="post" class="d-none"
                                  id="delete-pricing-rule-{{ $pricingRule->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endability
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
<style>
    .card {
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }

    .card:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
</style>
@endpush
