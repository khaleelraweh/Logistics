@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    <!-- رأس الصفحة -->
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
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    {{ __('pickup_request.request_info') }}
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th>{{ __('merchant.merchant') }}</th>
                            <td>{{ $pickupRequest->merchant->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.status') }}</th>
                            <td>
                                @php
                                    $status = $pickupRequest->status;
                                @endphp
                                @if($status == 'pending')
                                    <span class="badge bg-warning">{{ __('pickup_request.status_pending') }}</span>
                                @elseif($status == 'accepted')
                                    <span class="badge bg-info">{{ __('pickup_request.status_accepted') }}</span>
                                @elseif($status == 'completed')
                                    <span class="badge bg-success">{{ __('pickup_request.status_completed') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $status }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.note') }}</th>
                            <td>{{ $pickupRequest->note ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.scheduled_at') }}</th>
                            <td>{{ $pickupRequest->scheduled_at ? $pickupRequest->scheduled_at->format('Y-m-d h:i A') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.accepted_at') }}</th>
                            <td>{{ $pickupRequest->accepted_at ? $pickupRequest->accepted_at->format('Y-m-d h:i A') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.completed_at') }}</th>
                            <td>{{ $pickupRequest->completed_at ? $pickupRequest->completed_at->format('Y-m-d h:i A') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.created_at') }}</th>
                            <td>{{ $pickupRequest->created_at ? $pickupRequest->created_at->format('Y-m-d h:i A') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.updated_at') }}</th>
                            <td>{{ $pickupRequest->updated_at ? $pickupRequest->updated_at->format('Y-m-d h:i A') : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- بيانات الموقع -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    {{ __('pickup_request.location_info') }}
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th>{{ __('general.country') }}</th>
                            <td>{{ $pickupRequest->country ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.region') }}</th>
                            <td>{{ $pickupRequest->region ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.city') }}</th>
                            <td>{{ $pickupRequest->city ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.district') }}</th>
                            <td>{{ $pickupRequest->district ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.postal_code') }}</th>
                            <td>{{ $pickupRequest->postal_code ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.latitude') }}</th>
                            <td>{{ $pickupRequest->latitude ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.longitude') }}</th>
                            <td>{{ $pickupRequest->longitude ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- التاجر المرتبط -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header bg-success text-white">
                    {{ __('merchant.merchant_info') }}
                </div>
                <div class="card-body">
                    @if($pickupRequest->merchant)
                    <p><strong>{{ __('merchant.name') }}:</strong> {{ $pickupRequest->merchant->name }}</p>
                    <p><strong>{{ __('merchant.phone') }}:</strong> {{ $pickupRequest->merchant->phone }}</p>
                    <p><strong>{{ __('merchant.email') }}:</strong> {{ $pickupRequest->merchant->email }}</p>
                    <p><strong>{{ __('merchant.contact_person') }}:</strong> {{ $pickupRequest->merchant->contact_person ?? '-' }}</p>
                    <p><strong>{{ __('merchant.address') }}:</strong> {{ $pickupRequest->merchant->city ?? '-' }}, {{ $pickupRequest->merchant->region ?? '-' }}, {{ $pickupRequest->merchant->country ?? '-' }}</p>
                    @else
                    <p class="text-muted">{{ __('pickup_request.no_merchant') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- السائق المرتبط -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header bg-info text-white">
                    {{ __('driver.driver_info') }}
                </div>
                <div class="card-body">
                    @if($pickupRequest->driver)
                    <p><strong>{{ __('driver.name') }}:</strong>
                        {{ $pickupRequest->driver->first_name ?? '' }}
                        {{ $pickupRequest->driver->middle_name ?? '' }}
                        {{ $pickupRequest->driver->last_name ?? '' }}
                    </p>
                    <p><strong>{{ __('driver.phone') }}:</strong> {{ $pickupRequest->driver->phone ?? '-' }}</p>
                    <p><strong>{{ __('driver.vehicle_number') }}:</strong> {{ $pickupRequest->driver->vehicle_number ?? '-' }}</p>
                    <p><strong>{{ __('driver.vehicle_type') }}:</strong> {{ $pickupRequest->driver->vehicle_type ?? '-' }}</p>
                    @else
                    <p class="text-muted">{{ __('pickup_request.no_driver_assigned') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
