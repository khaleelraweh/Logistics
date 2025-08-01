@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ __('pickup_request.details') }} #{{ $pickupRequest->id }}</h4>
            <a href="{{ route('admin.pickup_requests.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> {{ __('general.back') }}
            </a>
        </div>
    </div>

    <div class="row">
        <!-- معلومات الطلب -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    {{ __('pickup_request.request_info') }}
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th>{{ __('pickup_request.pickup_address') }}</th>
                            <td>{{ $pickupRequest->pickup_address }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.scheduled_at') }}</th>
                            <td>{{ $pickupRequest->scheduled_at ? $pickupRequest->scheduled_at->format('Y-m-d h:i A') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.status') }}</th>
                            <td>
                                @if($pickupRequest->status == 'pending')
                                    <span class="badge bg-warning">{{ __('pickup_request.status_pending') }}</span>
                                @elseif($pickupRequest->status == 'accepted')
                                    <span class="badge bg-info">{{ __('pickup_request.status_accepted') }}</span>
                                @elseif($pickupRequest->status == 'completed')
                                    <span class="badge bg-success">{{ __('pickup_request.status_completed') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $pickupRequest->status }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.note') }}</th>
                            <td>{{ $pickupRequest->note ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.created_at') }}</th>
                            <td>{{ $pickupRequest->created_at->format('Y-m-d h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- التاجر المرتبط -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    {{ __('merchant.merchant_info') }}
                </div>
                <div class="card-body">
                    @if($pickupRequest->merchant)
                    <p><strong>{{ __('merchant.name') }}:</strong> {{ $pickupRequest->merchant->name }}</p>
                    <p><strong>{{ __('merchant.email') }}:</strong> {{ $pickupRequest->merchant->email }}</p>
                    @else
                    <p class="text-muted">{{ __('pickup_request.no_merchant') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- السائق المرتبط -->
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    {{ __('driver.driver_info') }}
                </div>
                <div class="card-body">
                    @if($pickupRequest->driver)
                    <p><strong>{{ __('driver.name') }}:</strong> {{ $pickupRequest->driver->name }}</p>
                    @else
                    <p class="text-muted">{{ __('pickup_request.no_driver_assigned') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
