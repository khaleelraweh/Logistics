@extends('layouts.admin')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('external_shipment.edit_external_shipment') }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.external_shipments.index') }}">{{ __('external_shipment.manage_external_shipments') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('external_shipment.edit_external_shipment') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">{{ __('external_shipment.external_shipment_info') }}</h4>

                <form action="{{ route('admin.external_shipments.update', $shipment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Shipping Partner --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="shipping_partner_id">{{ __('external_shipment.shipping_partner') }}</label>
                        <div class="col-sm-10">
                            <select name="shipping_partner_id" class="form-control select2">
                                <option value="">{{ __('external_shipment.select_shipping_partner') }}</option>
                                @foreach($partners as $partner)
                                    <option value="{{ $partner->id }}" {{ old('shipping_partner_id', $shipment->shipping_partner_id) == $partner->id ? 'selected' : '' }}>
                                        {{ $partner->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shipping_partner_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Package --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="package_id">{{ __('external_shipment.package') }}</label>
                        <div class="col-sm-10">
                            <select name="package_id" class="form-control select2">
                                <option value="">{{ __('external_shipment.select_package') }}</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" {{ old('package_id', $shipment->package_id) == $package->id ? 'selected' : '' }}>
                                        {{ $package->tracking_number }} - {{ $package->receiver_first_name }} {{ $package->receiver_last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('package_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- External Tracking Number --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="external_tracking_number">{{ __('external_shipment.external_tracking_number') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="external_tracking_number" class="form-control" id="external_tracking_number" value="{{ old('external_tracking_number', $shipment->external_tracking_number) }}">
                            @error('external_tracking_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Delivery Date --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="delivery_date">{{ __('external_shipment.delivery_date') }}</label>
                        <div class="col-sm-10">
                            <input type="date" name="delivery_date" class="form-control" id="delivery_date" value="{{ old('delivery_date', optional($shipment->delivery_date)->format('Y-m-d')) }}">
                            @error('delivery_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="status1">{{ __('external_shipment.status') }}</label>
                        <div class="col-sm-10">
                            <select name="status" id="status1" class="form-control select2">
                                <option value="pending" {{ old('status', $shipment->status) == 'pending' ? 'selected' : '' }}>{{ __('external_shipment.status_pending') }}</option>
                                <option value="cancelled" {{ old('status', $shipment->status) == 'cancelled' ? 'selected' : '' }}>{{ __('external_shipment.status_cancelled') }}</option>
                                <option value="in_transit" {{ old('status', $shipment->status) == 'in_transit' ? 'selected' : '' }}>{{ __('external_shipment.status_in_transit') }}</option>
                                <option value="delivered" {{ old('status', $shipment->status) == 'delivered' ? 'selected' : '' }}>{{ __('external_shipment.status_delivered') }}</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    @ability('admin', 'update_external_shipments')
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">{{ __('external_shipment.update_external_shipment') }}</button>
                        </div>
                    @endability

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
