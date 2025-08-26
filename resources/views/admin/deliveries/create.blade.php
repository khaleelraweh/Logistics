@extends('layouts.admin')

@section('content')

<!-- Page Header -->
<div class="row ">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('delivery.add_delivery') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.deliveries.index') }}">{{ __('delivery.manage_deliveries') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('delivery.add_delivery') }}</li>
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

                <form action="{{ route('admin.deliveries.store') }}" method="POST">
                    @csrf

                    {{-- Driver --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="driver_id">{{ __('delivery.driver') }}</label>
                        <div class="col-sm-10">
                            <select name="driver_id" class="form-control select2">
                                <option value="">{{ __('delivery.select_driver') }}</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->driver_full_name }} - {{ $driver->phone }} - {{ __('driver.vehicle_type_' . $driver->vehicle_type) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('driver_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Package --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="package_id">{{ __('delivery.package') }}</label>
                        <div class="col-sm-10">
                            <select name="package_id" class="form-control select2">
                                <option value="">{{ __('delivery.select_package') }}</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                        {{ $package->tracking_number }} - {{ $package->receiver_first_name }} {{ $package->receiver_last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('package_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Assigned At --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="assigned_at">{{ __('delivery.assigned_at') }}</label>
                        <div class="col-sm-10">
                            <input type="date" name="assigned_at" class="form-control" id="assigned_at" value="{{ old('assigned_at', now()->format('Y-m-d')) }}">
                            @error('assigned_at')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="row mb-3">
                        <label class=" col-sm-2 col-form-label" for="status1">{{ __('package.status') }}</label>
                        <div class="col-sm-10">
                            <select name="status" id="status1" class="form-select">
                                @foreach (\App\Models\Package::statuses() as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $package->status ?? '') == $key ? 'selected' : '' }}>
                                        {{ $label }}
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
                            <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
                            @error('note')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                     <!-- Submit Button -->
                    <div class="text-end pt-3">
                        @ability('admin', 'create_deliveries')
                            <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                <i class="ri-save-3-line me-2"></i>
                                <i class="bi bi-save me-2"></i>
                                {{ __('delivery.save_delivery') }}
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
