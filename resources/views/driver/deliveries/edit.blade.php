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
                            <textarea name="note" class="form-control" rows="3">{{ old('note', $delivery->note) }}</textarea>
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
