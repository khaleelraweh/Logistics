@extends('layouts.admin')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('pickup_request.manage_pickup_requests') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('pickup_request.add_pickup_request') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('pickup_request.manage_pickup_requests') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ __('pickup_request.pickup_request_info') }}</h4>

                    <form action="{{ route('admin.pickup_requests.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="merchant_id">{{ __('merchant.name') }}</label>
                            <div class="col-sm-10">
                                <select name="merchant_id" class="form-control select2">
                                    <option value="">{{ __('pickup_request.select_merchant') }}</option>
                                    @foreach ($merchants as $merchant)
                                        <option value="{{ $merchant->id }}" {{ old('merchant_id') == $merchant->id ? 'selected' : '' }}>
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
                                    <option value="" disabled selected>{{ __('delivery.select_driver') }}</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}" @selected(old('driver_id') == $driver->id)>
                                            {{ $driver->driver_full_name ?? __('driver.no_name') }}
                                            - {{ $driver->phone ?? __('driver.no_phone') }}
                                            - {{ $driver->vehicle_type ? __('driver.vehicle_type_' . $driver->vehicle_type) : __('driver.no_vehicle_type') }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('driver_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="pickup_address">{{ __('pickup_request.pickup_address') }}</label>
                            <div class="col-sm-10">
                                <input name="pickup_address" class="form-control" id="pickup_address" type="text" value="{{ old('pickup_address') }}">
                                @error('pickup_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="scheduled_at">{{ __('pickup_request.scheduled_at') }}</label>
                            <div class="col-sm-10">
                                <input name="scheduled_at" class="form-control" id="scheduled_at" type="date" value="{{ old('scheduled_at', now()->format('Y-m-d')) }}">
                                @error('scheduled_at')
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

                        <hr>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">{{ __('general.status') }}</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control">
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>{{ __('pickup_request.status_pending') }}</option>
                                    <option value="accepted" {{ old('status') == 'accepted' ? 'selected' : '' }}>{{ __('pickup_request.status_accepted') }}</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>{{ __('pickup_request.status_completed') }}</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @ability('admin', 'create_pickup_requests')
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">{{ __('pickup_request.save_pickup_request') }}</button>
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
