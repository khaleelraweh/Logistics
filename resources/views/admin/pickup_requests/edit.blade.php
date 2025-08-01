@extends('layouts.admin')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('pickup_request.edit_pickup_request') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.pickup_requests.index') }}">{{ __('pickup_request.manage_pickup_requests') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('pickup_request.edit_pickup_request') }}</li>
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

                    <form action="{{ route('admin.pickup_requests.update', $pickupRequest->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                <select name="driver_id" class="form-control select2" id="driver_id">
                                    <option value="">{{ __('pickup_request.select_driver') }}</option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}"
                                            {{ old('driver_id', $pickupRequest->driver_id) == $driver->id ? 'selected' : '' }}>
                                            {{ $driver->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('driver_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="pickup_address">{{ __('pickup_request.pickup_address') }}</label>
                            <div class="col-sm-10">
                                <input name="pickup_address" class="form-control" id="pickup_address" type="text"
                                    value="{{ old('pickup_address', $pickupRequest->pickup_address) }}">
                                @error('pickup_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
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

                        <hr>

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
