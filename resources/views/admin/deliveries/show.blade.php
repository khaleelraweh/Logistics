@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-sm-0">{{ __('delivery.delivery_details') }} #{{ $delivery->id }}</h3>
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> {{ __('general.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- معلومات التوصيلة -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="mdi mdi-truck-fast-outline me-2"></i> {{ __('delivery.delivery_info') }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-circle-medium me-2 text-muted"></i> {{ __('delivery.status') }}</span>
                            <span class="badge bg-{{ getStatusColor($delivery->status) }}">{{ __('package.status_' . $delivery->status) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-calendar-clock me-2 text-muted"></i> {{ __('delivery.assigned_at') }}</span>
                            <span class="fw-bold">{{ $delivery->assigned_at ? $delivery->assigned_at->format('Y-m-d h:i A') : '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-check-circle-outline me-2 text-muted"></i> {{ __('delivery.delivered_at') }}</span>
                            <span class="fw-bold">{{ $delivery->delivered_at ? $delivery->delivered_at->format('Y-m-d h:i A') : '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="mdi mdi-note-text-outline me-2 text-muted"></i> {{ __('delivery.note') }}</span>
                            <span class="fw-bold">{{ $delivery->note ?? '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- معلومات السائق -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0"><i class="mdi mdi-account-tie me-2"></i> {{ __('delivery.driver_info') }}</h5>
                </div>
                <div class="card-body">
                    @if($delivery->driver)
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-sm me-3">
                            <span class="avatar-title bg-soft-success rounded-circle text-success font-size-16">
                                <i class="mdi mdi-account-outline"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1">{{ $delivery->driver->driver_full_name }} </h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row" width="30%"><i class="mdi mdi-phone-outline me-1 text-muted"></i> {{ __('driver.phone') }}</th>
                                    <td>{{ $delivery->driver->phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row"><i class="mdi mdi-email-outline me-1 text-muted"></i> {{ __('driver.email') }}</th>
                                    <td>{{ $delivery->driver->email ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="mdi mdi-information-outline me-2"></i> {{ __('delivery.no_driver_assigned') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- معلومات الطرد المرتبط -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0"><i class="mdi mdi-package-variant-closed me-2"></i> {{ __('delivery.package_info') }}</h5>
                </div>
                <div class="card-body">
                    @if($delivery->package)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ __('package.tracking_number') }}</span>
                            <span class="fw-bold">{{ $delivery->package->tracking_number ?? '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ __('package.status') }}</span>
                            <span class="badge bg-{{ getStatusColor($delivery->package->status) }}">{{ __('package.status_' . $delivery->package->status) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ __('delivery.receiver') }}</span>
                            <span class="fw-bold">{{ $delivery->package->receiver_first_name }} {{ $delivery->package->receiver_last_name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ __('package.total_fee') }}</span>
                            <span class="fw-bold text-success">{{ $delivery->package->total_fee ?? '-' }}</span>
                        </li>
                    </ul>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="mdi mdi-information-outline me-2"></i> {{ __('delivery.no_package_assigned') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- الخط الزمني -->
    <div class="row mt-2">
        <div class="col-sm-12">
            <div class="card mt-4">
                <div class="card-header">{{ __('delivery.timeline_title') }}</div>
                <div class="card-body">
                    <section id="cd-timeline" class="cd-container">
                        @forelse($delivery->package?->packageLogs as $log)
                            @php
                                $translatedStatus = __('package.status_' . $log->status);
                                $color = match($log->status) {
                                    'delivered'        => 'success',
                                    'out_for_delivery' => 'info',
                                    'in_warehouse'     => 'primary',
                                    'returned'         => 'danger',
                                    'pending'          => 'warning',
                                    'cancelled'        => 'dark',
                                    'delivery_failed'  => 'danger',
                                    default            => 'secondary',
                                };
                            @endphp

                            <div class="cd-timeline-block">
                                <div class="cd-timeline-img bg-{{ $color }} text-white">
                                    <i class="mdi mdi-adjust"></i>
                                </div>

                                <div class="cd-timeline-content">
                                    <h3>{{ $translatedStatus }}</h3>
                                    <p class="mb-0 text-muted font-14">{{ $log->note ?? '-' }}</p>
                                    <span class="cd-date">{{ $log->logged_at->format('Y-m-d h:i A') }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">{{ __('package.timeline_empty') }}</p>
                        @endforelse
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@php
function getStatusColor($status) {
    return match($status) {
        'delivered'        => 'success',
        'out_for_delivery' => 'info',
        'in_warehouse'     => 'primary',
        'returned'         => 'danger',
        'pending'          => 'warning',
        'cancelled'        => 'dark',
        'delivery_failed'  => 'danger',
        default            => 'secondary',
    };
}
@endphp
