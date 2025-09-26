@extends('layouts.admin')

@section('content')

    <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('pricing_rules.edit_pricing_rule') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.pricing_rules.index') }}">{{ __('pricing_rules.pricing_rules') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('pricing_rules.edit_pricing_rule') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ __('pricing_rules.pricing_rule_info') }}</h4>

                    <form action="{{ route('admin.pricing_rules.update', $pricingRule->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="name">{{ __('pricing_rules.name') }}</label>
                            <div class="col-sm-10">
                                <input name="name" class="form-control" id="name" type="text" value="{{ old('name', $pricingRule->name) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="description">{{ __('pricing_rules.description') }}</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" rows="5" class="form-control">{{ old('description', $pricingRule->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="type">{{ __('pricing_rules.type') }}</label>
                            <div class="col-sm-10">
                                <select name="type" id="type" class="form-select">
                                    <option value="delivery" {{ old('type', $pricingRule->type) == 'delivery' ? 'selected' : '' }}>{{ __('pricing_rules.delivery') }}</option>
                                    <option value="storage" {{ old('type', $pricingRule->type) == 'storage' ? 'selected' : '' }}>{{ __('pricing_rules.storage') }}</option>
                                    <option value="handling" {{ old('type', $pricingRule->type) == 'handling' ? 'selected' : '' }}>{{ __('pricing_rules.handling') }}</option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Zone -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="zone">{{ __('pricing_rules.zone') }}</label>
                            <div class="col-sm-10">
                                <input name="zone" class="form-control" id="zone" type="text" value="{{ old('zone', $pricingRule->zone) }}">
                                @error('zone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Weight -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('pricing_rules.min_weight') }} / {{ __('pricing_rules.max_weight') }} (g)</label>
                            <div class="col-sm-5">
                                <input name="min_weight" class="form-control" type="number" value="{{ old('min_weight', $pricingRule->min_weight) }}" placeholder="{{ __('pricing_rules.min_weight') }}">
                                @error('min_weight')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-5">
                                <input name="max_weight" class="form-control" type="number" value="{{ old('max_weight', $pricingRule->max_weight) }}" placeholder="{{ __('pricing_rules.max_weight') }}">
                                @error('max_weight')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Dimensions -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('pricing_rules.dimensions') }} (cm)</label>
                            <div class="col-sm-4">
                                <input name="max_length" class="form-control" type="number" value="{{ old('max_length', $pricingRule->max_length) }}" placeholder="{{ __('pricing_rules.max_length') }}">
                                @error('max_length')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <input name="max_width" class="form-control" type="number" value="{{ old('max_width', $pricingRule->max_width) }}" placeholder="{{ __('pricing_rules.max_width') }}">
                                @error('max_width')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <input name="max_height" class="form-control" type="number" value="{{ old('max_height', $pricingRule->max_height) }}" placeholder="{{ __('pricing_rules.max_height') }}">
                                @error('max_height')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Prices -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('pricing_rules.base_price') }}</label>
                            <div class="col-sm-4">
                                <input name="base_price" class="form-control" type="number" step="0.01" value="{{ old('base_price', $pricingRule->base_price) }}">
                                @error('base_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <label class="col-sm-2 col-form-label">{{ __('pricing_rules.price_per_kg') }}</label>
                            <div class="col-sm-4">
                                <input name="price_per_kg" class="form-control" type="number" step="0.01" value="{{ old('price_per_kg', $pricingRule->price_per_kg) }}">
                                @error('price_per_kg')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('pricing_rules.extra_fee') }}</label>
                            <div class="col-sm-4">
                                <input name="extra_fee" class="form-control" type="number" step="0.01" value="{{ old('extra_fee', $pricingRule->extra_fee) }}">
                                @error('extra_fee')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Flags -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('pricing_rules.flags') }}</label>
                            <div class="col-sm-10">
                                @php
                                    $flags = ['oversized', 'fragile', 'perishable', 'express', 'same_day'];
                                @endphp
                                @foreach ($flags as $flag)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="{{ $flag }}" id="{{ $flag }}" value="1" {{ old($flag, $pricingRule->$flag) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $flag }}">{{ __('pricing_rules.' . $flag) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">{{ __('general.status') }}</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="status" id="status" {{ old('status', $pricingRule->status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">{{ __('pricing_rules.active_status') }}</label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="text-end pt-3">
                            @ability('admin', 'update_pricing_rules')
                                <button type="submit" class="btn btn-primary px-3">
                                    <i class="ri-save-3-line me-2"></i>
                                    {{ __('pricing_rules.update_pricing_rule') }}
                                </button>
                            @endability
                            <a href="{{ route('admin.pricing_rules.index') }}" class="btn btn-outline-danger ms-2">
                                <i class="ri-arrow-go-back-line me-1"></i>{{ __('panel.cancel') }}
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
