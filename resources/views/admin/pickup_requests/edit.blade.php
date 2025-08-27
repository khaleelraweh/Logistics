@extends('layouts.admin')

@section('content')

      <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('pickup_request.edit_pickup_request') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.pickup_requests.index') }}">{{ __('pickup_request.manage_pickup_requests') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('pickup_request.edit_pickup_request') }}</li>
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


                    <form action="{{ route('admin.pickup_requests.update', $pickupRequest->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Address Section -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-geo-alt text-primary"></i>
                                </div>
                                <h5 class="mb-0">{{ __('pickup_request.pickup_request_info') }}</h5>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="merchant_id">{{ __('merchant.name') }}</label>
                                <div class="col-sm-10">
                                    <select name="merchant_id" class="form-control select2" id="merchant_id">
                                        <option value="">{{ __('pickup_request.select_merchant') }}</option>
                                        @foreach ($merchants as $merchant)
                                            <option value="{{ $merchant->id }}"
                                                {{ old('merchant_id', $pickupRequest->merchant_id) == $merchant->id ? 'selected' : '' }}>
                                                {{ $merchant->name }} - {{ $merchant->email }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('merchant_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="driver_id">{{ __('pickup_request.assign_driver') }}</label>
                                <div class="col-sm-10">

                                    <select name="driver_id" id="driver_id" class="form-control select2" required>
                                        <option value="" disabled>{{ __('pickup_request.assign_driver') }}</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}"
                                                {{ old('driver_id', $pickupRequest->driver_id) == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->driver_full_name ?? __('driver.no_name') }}
                                                - {{ $driver->phone ?? __('driver.no_phone') }}
                                                - {{ $driver->vehicle_type ? __('driver.vehicle_type_' . $driver->vehicle_type) : __('driver.no_vehicle_type') }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('driver_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Address Section -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-geo-alt text-primary"></i>
                                </div>
                                <h5 class="mb-0">{{ __('general.address_details') }}</h5>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">{{ __('general.address') }}</label>
                                <div class="col-md-10">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <input name="country" class="form-control" id="country" type="text" value="{{ old('country') }}" placeholder="{{ __('general.country') }}">
                                            @error('country')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input name="region" class="form-control" id="region" type="text" value="{{ old('region') }}" placeholder="{{ __('general.region') }}">
                                            @error('region')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input name="city" class="form-control" id="city" type="text" value="{{ old('city') }}" placeholder="{{ __('general.city') }}">
                                            @error('city')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input name="district" class="form-control" id="district" type="text" value="{{ old('district') }}" placeholder="{{ __('general.district') }}">
                                            @error('district')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>



                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('general.geographical_location') }}</label>
                                <div class="col-md-10">
                                    <div class="row">
                                            <div class="col-md-4">
                                            <input type="text" id="latitude" name="latitude" class="form-control mb-2" placeholder="{{ __('general.latitude') }}" value="{{ old('latitude', $merchant->latitude ?? '') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" id="longitude" name="longitude" class="form-control mb-2" placeholder="{{ __('general.longitude') }}" value="{{ old('longitude', $merchant->longitude ?? '') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input name="postal_code" class="form-control" id="postal_code" type="text" value="{{ old('postal_code') }}" placeholder="{{ __('general.postal_code') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="map" style="width: 100%; height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>

                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-geo-alt text-primary"></i>
                                </div>
                                <h5 class="mb-0">{{ __('general.schedule_event') }}</h5>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="scheduled_at">{{ __('pickup_request.scheduled_at') }}</label>
                                <div class="col-sm-10">
                                    <input name="scheduled_at" class="form-control" id="scheduled_at" type="date"
                                    value="{{ old('scheduled_at', $pickupRequest->scheduled_at ? \Carbon\Carbon::parse($pickupRequest->scheduled_at)->toDateString() : '') }}">

                                    @error('scheduled_at')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Note -->
                            <div class="row mb-4">
                                <label for="note" class="col-sm-2 col-form-label">{{ __('delivery.note') }}</label>
                                <div class="col-sm-10">
                                    <textarea name="note" id="note" class="form-control">{{ old('note', $pickupRequest->note) }}</textarea>
                                    @error('note')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="status1">{{ __('general.status') }}</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control" id="status1">
                                        <option value="pending" {{ old('status', $pickupRequest->status) == 'pending' ? 'selected' : '' }}>
                                            {{ __('pickup_request.status_pending') }}
                                        </option>
                                        <option value="accepted" {{ old('status', $pickupRequest->status) == 'accepted' ? 'selected' : '' }}>
                                            {{ __('pickup_request.status_accepted') }}
                                        </option>
                                        <option value="completed" {{ old('status', $pickupRequest->status) == 'completed' ? 'selected' : '' }}>
                                            {{ __('pickup_request.status_completed') }}
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @ability('admin', 'update_pickup_requests')
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">{{ __('pickup_request.update_pickup_request') }}</button>
                            </div>
                        @endability

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function() {
            $('.select2').select2();
        });
    </script>
@endsection
