@extends('layouts.admin')

@section('style')
    <style>
        .delivery-cards-container {
            --primary-gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            --success-gradient: linear-gradient(135deg, #4cc9f0 0%, #4895ef 100%);
            --info-gradient: linear-gradient(135deg, #7209b7 0%, #560bad 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --card-radius: 16px;
            --transition: all 0.3s ease;
        }

        .delivery-card {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
            height: 100%;
            background: #fff;
        }

        .delivery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .card-header-custom {
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            padding: 16px 20px;
            font-weight: 600;
            background: var(--primary-gradient);
        }

        .card-header-success {
            background: var(--success-gradient);
        }

        .card-header-info {
            background: var(--info-gradient);
        }

        .card-body-custom {
            padding: 20px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            transition: var(--transition);
        }

        .info-item:hover {
            background-color: #f9fafc;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            color: #4361ee;
            margin-left: 10px;
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .driver-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--success-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-left: 15px;
            flex-shrink: 0;
        }

        .driver-info h6 {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .driver-details {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .alert-custom {
            border-radius: 12px;
            padding: 16px;
            border: none;
            background-color: #f8f9fa;
            color: #6c757d;
        }

        .table-custom {
            border-radius: 10px;
        }

        .table-custom th {
            font-weight: 500;
            color: #6c757d;
            padding: 8px 5px;
        }

        .table-custom td {
            padding: 8px 5px;
        }

        .text-success {
            color: #38b2ac !important;
            font-weight: 600;
        }

        .fw-bold {
            font-weight: 600 !important;
        }

        /* ألوان الحالات */
        .bg-delivered { background-color: #38b2ac; color: white; }
        .bg-pending { background-color: #ed8936; color: white; }
        .bg-processing { background-color: #4299e1; color: white; }
        .bg-canceled { background-color: #f56565; color: white; }

        @media (max-width: 992px) {
            .col-lg-4 {
                margin-bottom: 24px;
            }
        }
    </style>
@endsection

@section('content')



    <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('delivery.view_delivery') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.deliveries.index') }}">{{ __('delivery.manage_deliveries') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('delivery.view_delivery') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>





    {{-- <div class="row mt-4 g-3">

        <!-- بطاقة التوصيلة -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="mdi mdi-truck-fast-outline me-2 fs-5"></i>
                    <h6 class="mb-0">{{ __('delivery.delivery_info') }}</h6>
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

        <!-- بطاقة السائق -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-success text-white d-flex align-items-center">
                    <i class="mdi mdi-account-tie me-2 fs-5"></i>
                    <h6 class="mb-0">{{ __('delivery.driver_info') }}</h6>
                </div>
                <div class="card-body">
                    @if($delivery->driver)
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-sm me-3">
                                <span class="avatar-title bg-soft-success rounded-circle text-success fs-5">
                                    <i class="mdi mdi-account-outline"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $delivery->driver->driver_full_name }}</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row"><i class="mdi mdi-phone-outline me-1 text-muted"></i> {{ __('driver.phone') }}</th>
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
                        <div class="alert alert-info mb-0 d-flex align-items-center">
                            <i class="mdi mdi-information-outline me-2"></i> {{ __('delivery.no_driver_assigned') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- بطاقة الطرد -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-info text-white d-flex align-items-center">
                    <i class="mdi mdi-package-variant-closed me-2 fs-5"></i>
                    <h6 class="mb-0">{{ __('delivery.package_info') }}</h6>
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
                        <div class="alert alert-info mb-0 d-flex align-items-center">
                            <i class="mdi mdi-information-outline me-2"></i> {{ __('delivery.no_package_assigned') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div> --}}




<div class="delivery-cards-container">
    <div class="row mt-4 g-3">
        <!-- بطاقة التوصيلة -->
        <div class="col-lg-4">
            <div class="delivery-card">
                <div class="card-header-custom text-white d-flex align-items-center">
                    <i class="mdi mdi-truck-fast-outline me-2 fs-5"></i>
                    <h6 class="mb-0">{{ __('delivery.delivery_info') }}</h6>
                </div>
                <div class="card-body-custom">
                    <div class="info-item">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-circle-medium info-icon"></i>
                            <span>{{ __('delivery.status') }}</span>
                        </div>

                        <span class="status-badge bg-{{ getStatusColor($delivery->status) }}">{{ __('package.status_' . $delivery->status) }}</span>
                    </div>

                    <div class="info-item">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-calendar-clock info-icon"></i>
                            <span>{{ __('delivery.assigned_at') }}</span>
                        </div>
                        <span class="fw-bold">{{ $delivery->assigned_at ? $delivery->assigned_at->format('Y-m-d h:i A') : '-' }}</span>
                    </div>

                    <div class="info-item">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-check-circle-outline info-icon"></i>
                            <span>{{ __('delivery.delivered_at') }}</span>
                        </div>
                        <span class="fw-bold">{{ $delivery->delivered_at ? $delivery->delivered_at->format('Y-m-d h:i A') : '-' }}</span>
                    </div>

                    <div class="info-item">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-note-text-outline info-icon"></i>
                            <span>{{ __('delivery.note') }}</span>
                        </div>
                        <span class="fw-bold">{{ $delivery->note ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- بطاقة السائق -->
        <div class="col-lg-4">
            <div class="delivery-card">
                <div class="card-header-custom card-header-success text-white d-flex align-items-center">
                    <i class="mdi mdi-account-tie me-2 fs-5"></i>
                    <h6 class="mb-0">{{ __('delivery.driver_info') }}</h6>
                </div>
                <div class="card-body-custom">
                    @if($delivery->driver)
                        <div class="d-flex align-items-center mb-4">
                            <div class="driver-avatar">
                                <i class="mdi mdi-account-outline"></i>
                            </div>
                            <div class="driver-info">
                                <h6 class="mb-1">{{ $delivery->driver->driver_full_name }}</h6>
                                <div class="driver-details">سائق معتمد</div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-sm table-borderless table-custom">
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
                        <div class="alert alert-info alert-custom d-flex align-items-center mb-0">
                            <i class="mdi mdi-information-outline me-2"></i> {{ __('delivery.no_driver_assigned') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- بطاقة الطرد -->
        <div class="col-lg-4">
            <div class="delivery-card">
                <div class="card-header-custom card-header-info text-white d-flex align-items-center">
                    <i class="mdi mdi-package-variant-closed me-2 fs-5"></i>
                    <h6 class="mb-0">{{ __('delivery.package_info') }}</h6>
                </div>
                <div class="card-body-custom">
                    @if($delivery->package)
                        <div class="info-item">
                            <span>{{ __('package.tracking_number') }}</span>
                            <span class="fw-bold">{{ $delivery->package->tracking_number ?? '-' }}</span>
                        </div>

                        <div class="info-item">
                            <span>{{ __('package.status') }}</span>
                            <span class="status-badge bg-{{ getStatusColor($delivery->package->status) }}">{{ __('package.status_' . $delivery->package->status) }}</span>
                        </div>

                        <div class="info-item">
                            <span>{{ __('delivery.receiver') }}</span>
                            <span class="fw-bold">{{ $delivery->package->receiver_first_name }} {{ $delivery->package->receiver_last_name }}</span>
                        </div>

                        <div class="info-item">
                            <span>{{ __('package.total_fee') }}</span>
                            <span class="fw-bold text-success">{{ $delivery->package->total_fee ?? '-' }}</span>
                        </div>
                    @else
                        <div class="alert alert-info alert-custom d-flex align-items-center mb-0">
                            <i class="mdi mdi-information-outline me-2"></i> {{ __('delivery.no_package_assigned') }}
                        </div>
                    @endif
                </div>
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
                                    <h3>{{ $translatedStatus }} </h3>
                                    <p class="mb-0 text-muted font-14">
                                        {{ $log->note ?? '-' }}
                                        @if($log->driver_id)
                                            <a href="{{ route('admin.drivers.show' , $log->driver_id) }}"  data-bs-toggle="tooltip"  data-bs-placement="top" title="{{ $log->driver->driver_full_name ?? '' }} , {{ $log->driver->phone ?? '' }} , {{ $log->driver->email ?? '' }}" >
                                                {{ optional($log->driver)->driver_full_name }}
                                            </a>
                                        @endif
                                    </p>
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


@endsection


