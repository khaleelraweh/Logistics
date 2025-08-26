@extends('layouts.admin')

@section('content')

<!-- Page Header -->
<div class="row ">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('delivery.edit_delivery') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.deliveries.index') }}">{{ __('delivery.manage_deliveries') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('delivery.edit_delivery') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Delivery Form -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    <i class="mdi mdi-truck-delivery-outline me-1"></i> {{ __('delivery.delivery_info') }}
                </h4>

                <form action="{{ route('admin.deliveries.update', $delivery->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Driver Selection -->
                    <div class="row mb-4">
                        <label for="driver_id" class="col-sm-2 col-form-label">{{ __('driver.name') }}</label>
                        <div class="col-sm-10">
                            <select name="driver_id" id="driver_id" class="form-select select2">
                                <option disabled selected>{{ __('delivery.select_driver') }}</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('driver_id', $delivery->driver_id) == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->name }} - {{ $driver->phone }}
                                    </option>
                                @endforeach
                            </select>
                            @error('driver_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Package Selection -->
                    <div class="row mb-4">
                        <label for="package_id" class="col-sm-2 col-form-label">{{ __('delivery.package') }}</label>
                        <div class="col-sm-10">
                            <select name="package_id" id="package_id" class="form-select select2">
                                <option disabled selected>{{ __('delivery.select_package') }}</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}" {{ old('package_id', $delivery->package_id) == $package->id ? 'selected' : '' }}>
                                        {{  $package->tracking_number ?? __('package.package') . "#". $package->id }} - {{ $package->receiver_first_name }} {{ $package->receiver_last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('package_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Assigned At Date -->
                    <div class="row mb-4">
                        <label for="assigned_at" class="col-sm-2 col-form-label">{{ __('delivery.assigned_at') }}</label>
                        <div class="col-sm-10">
                            <input type="date" name="assigned_at" id="assigned_at" class="form-control"
                                value="{{ old('assigned_at', optional($delivery->assigned_at)->format('Y-m-d')) }}">
                            @error('assigned_at')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="row mb-4">
                        <label for="status1" class="col-sm-2 col-form-label">{{ __('general.status') }}</label>
                        <div class="col-sm-10">
                            <select name="status" id="status1" class="form-select">
                                @foreach(\App\Models\Package::statuses() as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $delivery->status) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Note -->
                    <div class="row mb-4">
                        <label for="note" class="col-sm-2 col-form-label">{{ __('delivery.note') }}</label>
                        <div class="col-sm-10">
                            <textarea name="note" id="note" class="form-control">{{ old('note', $delivery->note) }}</textarea>
                            @error('note')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>



                    <!-- Submit Button -->
                    <div class="text-end pt-3">
                        @ability('admin', 'update_deliveries')
                            <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                <i class="ri-save-3-line me-2"></i>
                                <i class="bi bi-save me-2"></i>
                                {{ __('delivery.update_delivery') }}
                            </button>
                        @endability

                        <a href="{{ route('admin.deliveries.index') }}" class="btn btn-outline-danger ms-2">
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
