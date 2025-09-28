@extends('layouts.driver')

@section('content')

<!-- Page Header -->
<div class="row ">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('delivery.edit_delivery') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('driver.deliveries.index') }}">{{ __('delivery.manage_deliveries') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('delivery.edit_delivery') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">{{ __('delivery.delivery_info') }}</h4>

                <form action="{{ route('driver.deliveries.update', $delivery->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- معلومات الطرد الأساسية -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('package.receiver_info') }}</h5>
                                </div>
                                <div class="card-body">
                                    {{-- معلومات المستلم --}}
                                    <div class="mb-2">
                                        <strong>{{ __('package.receiver_name') }}:</strong>
                                        {{ $delivery->package->receiver_first_name ?? '' }}
                                        {{ $delivery->package->receiver_middle_name ?? '' }}
                                        {{ $delivery->package->receiver_last_name ?? '' }}
                                    </div>

                                    {{-- هاتف المستلم --}}
                                    <div class="mb-2">
                                        <strong>{{ __('package.receiver_phone') }}:</strong>
                                        <a href="tel:{{ $delivery->package->receiver_phone ?? '' }}" class="text-primary">
                                            {{ $delivery->package->receiver_phone ?? '' }}
                                        </a>
                                    </div>

                                    {{-- ايميل المستلم --}}
                                    <div class="mb-2">
                                        <strong>{{ __('package.receiver_email') }}:</strong>
                                        <a href="mailto:{{ $delivery->package->receiver_email ?? '' }}" class="text-primary">
                                            {{ $delivery->package->receiver_email ?? '' }}
                                        </a>
                                    </div>

                                    {{-- عنوان المستلم --}}
                                    <div class="mb-2">
                                        <strong>{{ __('package.receiver_address') }}:</strong>
                                        {{ $delivery->package->receiver_country ?? '' }},
                                        {{ $delivery->package->receiver_region ?? '' }},
                                        {{ $delivery->package->receiver_city ?? '' }},
                                        {{ $delivery->package->receiver_district ?? '' }}
                                    </div>

                                    {{-- الرمز البريدي --}}
                                    @if($delivery->package->receiver_postal_code)
                                    <div class="mb-2">
                                        <strong>{{ __('package.postal_code') }}:</strong>
                                        {{ $delivery->package->receiver_postal_code }}
                                    </div>
                                    @endif

                                    {{-- معلومات إضافية --}}
                                    @if($delivery->package->receiver_others)
                                    <div class="mb-2">
                                        <strong>{{ __('package.additional_info') }}:</strong>
                                        {{ $delivery->package->receiver_others }}
                                    </div>
                                    @endif

                                    {{-- رابط الموقع --}}
                                    @if($delivery->package->receiver_latitude && $delivery->package->receiver_longitude)
                                    <div class="mt-3">
                                        <a href="https://maps.google.com/?q={{ $delivery->package->receiver_latitude }},{{ $delivery->package->receiver_longitude }}"
                                           target="_blank"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="ri-map-pin-line me-1"></i>
                                            {{ __('package.view_on_map') }}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('package.sender_info') }}</h5>
                                </div>
                                <div class="card-body">
                                    {{-- معلومات المرسل --}}
                                    <div class="mb-2">
                                        <strong>{{ __('package.sender_name') }}:</strong>
                                        {{ $delivery->package->sender_first_name ?? '' }}
                                        {{ $delivery->package->sender_middle_name ?? '' }}
                                        {{ $delivery->package->sender_last_name ?? '' }}
                                    </div>

                                    {{-- هاتف المرسل --}}
                                    @if($delivery->package->sender_phone)
                                    <div class="mb-2">
                                        <strong>{{ __('package.sender_phone') }}:</strong>
                                        <a href="tel:{{ $delivery->package->sender_phone }}" class="text-primary">
                                            {{ $delivery->package->sender_phone }}
                                        </a>
                                    </div>
                                    @endif

                                    {{-- عنوان المرسل --}}
                                    @if($delivery->package->sender_city)
                                    <div class="mb-2">
                                        <strong>{{ __('package.sender_address') }}:</strong>
                                        {{ $delivery->package->sender_city ?? '' }},
                                        {{ $delivery->package->sender_district ?? '' }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- معلومات الطرد --}}
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ __('package.package_details') }}</h5>
                                </div>
                                <div class="card-body">
                                    {{-- رقم التتبع --}}
                                    <div class="mb-2">
                                        <strong>{{ __('package.tracking_number') }}:</strong>
                                        {{ $delivery->package->tracking_number ?? '' }}
                                    </div>

                                    {{-- محتويات الطرد --}}
                                    @if($delivery->package->package_content)
                                    <div class="mb-2">
                                        <strong>{{ __('package.content') }}:</strong>
                                        {{ $delivery->package->package_content }}
                                    </div>
                                    @endif

                                    {{-- ملاحظات --}}
                                    @if($delivery->package->package_note)
                                    <div class="mb-2">
                                        <strong>{{ __('package.notes') }}:</strong>
                                        {{ $delivery->package->package_note }}
                                    </div>
                                    @endif

                                    {{-- الوزن والأبعاد --}}
                                    <div class="mb-2">
                                        <strong>{{ __('package.weight') }}:</strong>
                                        {{ $delivery->package->weight ? $delivery->package->weight . ' جرام' : 'غير محدد' }}
                                    </div>

                                    {{-- نوع الطرد --}}
                                    <div class="mb-2">
                                        <strong>{{ __('package.package_type') }}:</strong>
                                        {{ __('package.type_' . $delivery->package->package_type) }}
                                    </div>

                                    {{-- حجم الطرد --}}
                                    <div class="mb-2">
                                        <strong>{{ __('package.package_size') }}:</strong>
                                        {{ __('package.size_' . $delivery->package->package_size) }}
                                    </div>

                                    {{-- طريقة الدفع --}}
                                    <div class="mb-2">
                                        <strong>{{ __('package.payment_method') }}:</strong>
                                        {{ __('package.' . $delivery->package->payment_method) }}
                                    </div>

                                    {{-- مبلغ COD --}}
                                    @if($delivery->package->cod_amount > 0)
                                    <div class="mb-2 text-danger">
                                        <strong>{{ __('package.cod_amount') }}:</strong>
                                        {{ number_format($delivery->package->cod_amount, 2) }} ر.س
                                    </div>
                                    @endif

                                    {{-- خصائص خاصة --}}
                                    @php
                                        // التصحيح: الحقل attributes يتم تحويله تلقائياً إلى array في لارافيل
                                        $attributes = is_array($delivery->package->attributes)
                                            ? $delivery->package->attributes
                                            : json_decode($delivery->package->attributes ?? '{}', true);

                                        $specialAttributes = array_filter($attributes ?? [], function($value) {
                                            return $value === true;
                                        });
                                    @endphp

                                    @if(count($specialAttributes) > 0)
                                    <div class="mt-2">
                                        <strong>{{ __('package.special_instructions') }}:</strong>
                                        <div class="mt-1">
                                            @if($attributes['is_fragile'] ?? false)
                                                <span class="badge bg-warning me-1">{{ __('package.fragile') }}</span>
                                            @endif
                                            @if($attributes['is_signature_required'] ?? false)
                                                <span class="badge bg-info me-1">{{ __('package.signature_required') }}</span>
                                            @endif
                                            @if($attributes['is_special_handling_required'] ?? false)
                                                <span class="badge bg-danger me-1">{{ __('package.special_handling') }}</span>
                                            @endif
                                            @if($attributes['is_perishable'] ?? false)
                                                <span class="badge bg-success me-1">{{ __('package.perishable') }}</span>
                                            @endif
                                            @if($attributes['is_confidential'] ?? false)
                                                <span class="badge bg-dark me-1">{{ __('package.confidential') }}</span>
                                            @endif
                                            @if($attributes['is_temperature_controlled'] ?? false)
                                                <span class="badge bg-primary me-1">{{ __('package.temperature_controlled') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Driver (fixed, read-only) --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{ __('delivery.driver') }}</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">{{ $delivery->driver?->driver_full_name ?? __('driver.no_name') }}</p>
                            <input type="hidden" name="driver_id" value="{{ $delivery->driver_id }}">
                        </div>
                    </div>

                    {{-- Package (fixed, read-only) --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{ __('delivery.package') }}</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext">
                                {{ $delivery->package->tracking_number ?? '' }} -
                                {{ $delivery->package->receiver_first_name ?? '' }} {{ $delivery->package->receiver_last_name ?? '' }}
                            </p>
                            <input type="hidden" name="package_id" value="{{ $delivery->package_id }}">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="status1">{{ __('package.status') }}</label>
                        <div class="col-sm-10">
                            <select name="status" id="status1" class="form-select">
                                @foreach($delivery->availableStatusesForDriver() as $status)
                                    <option value="{{ $status }}" {{ old('status', $delivery->status) == $status ? 'selected' : '' }}>
                                        {{ __('package.status_' . $status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Note --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="note">{{ __('general.note') }}</label>
                        <div class="col-sm-10">
                            <textarea name="note" class="form-control" rows="3" placeholder="{{ __('delivery.add_delivery_note') }}">{{ old('note', $delivery->note) }}</textarea>
                            @error('note')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end pt-3">
                        @ability('driver', 'update_deliveries')
                            <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                <i class="ri-save-3-line me-2"></i>
                                <i class="bi bi-save me-2"></i>
                                {{ __('delivery.update_delivery') }}
                            </button>
                        @endability

                        <a href="{{ route('driver.deliveries.index') }}" class="btn btn-outline-danger ms-2">
                            <i class="ri-arrow-go-back-line me-1"></i>
                            {{ __('panel.cancel') }}
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
