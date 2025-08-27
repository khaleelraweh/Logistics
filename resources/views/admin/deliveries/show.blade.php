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

        /* تنسيقات الخط الزمني المحسنة */
        .timeline-card {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-top: 2rem;
        }

        .timeline-header {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            padding: 16px 20px;
            font-weight: 600;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .timeline-container {
            position: relative;
            padding: 2rem 0;
        }

        .timeline-container::before {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            transform: translateX(50%);
            height: 100%;
            width: 4px;
            background: #e9ecef;
            border-radius: 2px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
            display: flex;
            width: 100%;
        }

        .timeline-item:nth-child(odd) {
            justify-content: flex-start;
        }

        .timeline-item:nth-child(even) {
            justify-content: flex-end;
        }

        .timeline-content {
            position: relative;
            width: calc(50% - 40px);
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .timeline-item:nth-child(odd) .timeline-content {
            text-align: right;
            border-right: 3px solid;
        }

        .timeline-item:nth-child(even) .timeline-content {
            /* text-align: left; */
            text-align: right;
            border-left: 3px solid;
        }

        .timeline-item:nth-child(odd) .timeline-content::before {
            content: '';
            position: absolute;
            top: 16px;
            right: 100%;
            height: 0;
            width: 0;
            border: 7px solid transparent;
            border-right: 7px solid white;
        }

        .timeline-item:nth-child(even) .timeline-content::before {
            content: '';
            position: absolute;
            top: 16px;
            left: 100%;
            height: 0;
            width: 0;
            border: 7px solid transparent;
            border-left: 7px solid white;
        }

        .timeline-dot {
            position: absolute;
            top: 20px;
            right: 50%;
            transform: translateX(50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 4px white, inset 0 2px 0 rgba(0, 0, 0, 0.08), 0 3px 0 4px rgba(0, 0, 0, 0.05);
            z-index: 2;
        }

        .timeline-content h3 {
            margin-top: 0;
            margin-bottom: 0.5em;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .timeline-content p {
            margin-bottom: 0.5em;
        }

        .timeline-date {
            display: inline-block;
            font-size: 0.85rem;
            color: #6c757d;
            background: #f8f9fa;
            padding: 4px 10px;
            border-radius: 12px;
            margin-top: 0.5rem;
        }

        .driver-link {
            color: #4361ee;
            text-decoration: none;
            transition: var(--transition);
        }

        .driver-link:hover {
            text-decoration: underline;
            color: #3a0ca3;
        }

        /* ألوان الحدود للاتجاهين */
        .timeline-item:nth-child(odd) .border-delivered { border-right-color: #38b2ac; }
        .timeline-item:nth-child(odd) .border-pending { border-right-color: #ed8936; }
        .timeline-item:nth-child(odd) .border-processing { border-right-color: #4299e1; }
        .timeline-item:nth-child(odd) .border-canceled { border-right-color: #f56565; }
        .timeline-item:nth-child(odd) .border-out_for_delivery { border-right-color: #9c27b0; }
        .timeline-item:nth-child(odd) .border-in_warehouse { border-right-color: #673ab7; }
        .timeline-item:nth-child(odd) .border-returned { border-right-color: #f44336; }
        .timeline-item:nth-child(odd) .border-cancelled { border-right-color: #607d8b; }
        .timeline-item:nth-child(odd) .border-delivery_failed { border-right-color: #ff5722; }

        .timeline-item:nth-child(even) .border-delivered { border-left-color: #38b2ac; }
        .timeline-item:nth-child(even) .border-pending { border-left-color: #ed8936; }
        .timeline-item:nth-child(even) .border-processing { border-left-color: #4299e1; }
        .timeline-item:nth-child(even) .border-canceled { border-left-color: #f56565; }
        .timeline-item:nth-child(even) .border-out_for_delivery { border-left-color: #9c27b0; }
        .timeline-item:nth-child(even) .border-in_warehouse { border-left-color: #673ab7; }
        .timeline-item:nth-child(even) .border-returned { border-left-color: #f44336; }
        .timeline-item:nth-child(even) .border-cancelled { border-left-color: #607d8b; }
        .timeline-item:nth-child(even) .border-delivery_failed { border-left-color: #ff5722; }

        /* ألوان الخلفية للأسهم لتتناسب مع لون الحدود */
        .timeline-item:nth-child(odd) .border-delivered::before { border-right-color: #38b2ac !important; }
        .timeline-item:nth-child(odd) .border-pending::before { border-right-color: #ed8936 !important; }
        .timeline-item:nth-child(odd) .border-processing::before { border-right-color: #4299e1 !important; }
        .timeline-item:nth-child(odd) .border-canceled::before { border-right-color: #f56565 !important; }
        .timeline-item:nth-child(odd) .border-out_for_delivery::before { border-right-color: #9c27b0 !important; }
        .timeline-item:nth-child(odd) .border-in_warehouse::before { border-right-color: #673ab7 !important; }
        .timeline-item:nth-child(odd) .border-returned::before { border-right-color: #f44336 !important; }
        .timeline-item:nth-child(odd) .border-cancelled::before { border-right-color: #607d8b !important; }
        .timeline-item:nth-child(odd) .border-delivery_failed::before { border-right-color: #ff5722 !important; }

        .timeline-item:nth-child(even) .border-delivered::before { border-left-color: #38b2ac !important; }
        .timeline-item:nth-child(even) .border-pending::before { border-left-color: #ed8936 !important; }
        .timeline-item:nth-child(even) .border-processing::before { border-left-color: #4299e1 !important; }
        .timeline-item:nth-child(even) .border-canceled::before { border-left-color: #f56565 !important; }
        .timeline-item:nth-child(even) .border-out_for_delivery::before { border-left-color: #9c27b0 !important; }
        .timeline-item:nth-child(even) .border-in_warehouse::before { border-left-color: #673ab7 !important; }
        .timeline-item:nth-child(even) .border-returned::before { border-left-color: #f44336 !important; }
        .timeline-item:nth-child(even) .border-cancelled::before { border-left-color: #607d8b !important; }
        .timeline-item:nth-child(even) .border-delivery_failed::before { border-left-color: #ff5722 !important; }

        /* ألوان الحالات */
        .bg-delivered { background-color: #38b2ac; }
        .bg-pending { background-color: #ed8936; }
        .bg-processing { background-color: #4299e1; }
        .bg-canceled { background-color: #f56565; }
        .bg-out_for_delivery { background-color: #9c27b0; }
        .bg-in_warehouse { background-color: #673ab7; }
        .bg-returned { background-color: #f44336; }
        .bg-cancelled { background-color: #607d8b; }
        .bg-delivery_failed { background-color: #ff5722; }

        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-left: 8px;
        }

        @media (max-width: 768px) {
            .timeline-container::before {
                /* right: 31px; */
                right: 16px;
                transform: none;
            }

            .timeline-item:nth-child(odd),
            .timeline-item:nth-child(even) {
                justify-content: flex-start;
            }

            .timeline-content {
                width: calc(100% - 70px);
                /* margin-right: 70px !important; */
                /* margin-right: 5em !important; */
                margin-right: 3em !important;
                margin-left: 0 !important;
                text-align: right !important;
                border-left: 3px solid !important;
                border-right: none !important;
            }

            .timeline-item:nth-child(odd) .timeline-content::before,
            .timeline-item:nth-child(even) .timeline-content::before {
                right: auto;
                left: 100%;
                border: 7px solid transparent;
                border-left: 7px solid white;
                border-right: none;
            }

            .timeline-dot {
                /* right: 31px; */
                right: 2px;
                transform: none;
            }

            .col-lg-4 {
                margin-bottom: 24px;
            }

            /* ألوان الحدود للشاشات الصغيرة */
            .timeline-content.border-delivered { border-left-color: #38b2ac !important; }
            .timeline-content.border-pending { border-left-color: #ed8936 !important; }
            .timeline-content.border-processing { border-left-color: #4299e1 !important; }
            .timeline-content.border-canceled { border-left-color: #f56565 !important; }
            .timeline-content.border-out_for_delivery { border-left-color: #9c27b0 !important; }
            .timeline-content.border-in_warehouse { border-left-color: #673ab7 !important; }
            .timeline-content.border-returned { border-left-color: #f44336 !important; }
            .timeline-content.border-cancelled { border-left-color: #607d8b !important; }
            .timeline-content.border-delivery_failed { border-left-color: #ff5722 !important; }

            /* ألوان الأسهم للشاشات الصغيرة */
            .timeline-content.border-delivered::before { border-left-color: #38b2ac !important; }
            .timeline-content.border-pending::before { border-left-color: #ed8936 !important; }
            .timeline-content.border-processing::before { border-left-color: #4299e1 !important; }
            .timeline-content.border-canceled::before { border-left-color: #f56565 !important; }
            .timeline-content.border-out_for_delivery::before { border-left-color: #9c27b0 !important; }
            .timeline-content.border-in_warehouse::before { border-left-color: #673ab7 !important; }
            .timeline-content.border-returned::before { border-left-color: #f44336 !important; }
            .timeline-content.border-cancelled::before { border-left-color: #607d8b !important; }
            .timeline-content.border-delivery_failed::before { border-left-color: #ff5722 !important; }
        }

        @media (max-width: 568px) {
            .timeline-content{
                /* border-left: none !important; */
            }

            .timeline-content::before {
                /* display: none !important; */
            }
        }
    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <div class="row">
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
                                <span class="status-indicator bg-{{ getStatusColor($delivery->status) }}"></span>
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
                                <div class="driver-avatar bg-{{ getStatusColor($delivery->status) }}">
                                    <i class="mdi mdi-account-outline"></i>
                                </div>
                                <div class="driver-info">
                                    <h6 class="mb-1">{{ $delivery->driver->driver_full_name }}</h6>
                                    {{-- <div class="driver-details">
                                        <span class="status-badge bg-{{ getStatusColor($delivery->status) }}"> {{ __('package.status_' . $delivery->status) }}</span>
                                    </div> --}}
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
                                        <tr>
                                            <th scope="row"><i class="mdi mdi-clock-outline me-1 text-muted"></i> حالة التسليم</th>
                                            <td>
                                                <span class="status-badge bg-{{ getStatusColor($delivery->status) }}">{{ __('package.status_' . $delivery->status) }}</span>
                                            </td>
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
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-barcode-scan info-icon"></i>
                                    <span>{{ __('package.tracking_number') }}</span>
                                </div>
                                <span class="fw-bold">{{ $delivery->package->tracking_number ?? '-' }}</span>
                            </div>

                            <div class="info-item">
                                <div class="d-flex align-items-center">
                                    <span class="status-indicator bg-{{ getStatusColor($delivery->package->status) }}"></span>
                                    <span>{{ __('package.status') }}</span>
                                </div>
                                <span class="status-badge bg-{{ getStatusColor($delivery->package->status) }}">{{ __('package.status_' . $delivery->package->status) }}</span>
                            </div>

                            <div class="info-item">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-account-box-outline info-icon"></i>
                                    <span>{{ __('delivery.receiver') }}</span>
                                </div>
                                <span class="fw-bold">{{ $delivery->package->receiver_first_name }} {{ $delivery->package->receiver_last_name }}</span>
                            </div>

                            <div class="info-item">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-cash-multiple info-icon"></i>
                                    <span>{{ __('package.total_fee') }}</span>
                                </div>
                                <span class="fw-bold text-success">{{ $delivery->package->total_fee ?? '-' }} ر.س</span>
                            </div>

                            <!-- حالة التوصيل مع التلوين الموحد -->
                            <div class="info-item">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-truck-delivery-outline info-icon"></i>
                                    <span>حالة التوصيل</span>
                                </div>
                                <span class="status-badge bg-{{ getStatusColor($delivery->status) }}">{{ __('package.status_' . $delivery->status) }}</span>
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

    <!-- الخط الزمني المحسّن -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="timeline-card">
                <div class="timeline-header d-flex align-items-center">
                    <i class="mdi mdi-timeline-outline me-2 fs-5"></i>
                    <h6 class="mb-0">{{ __('delivery.timeline_title') }}</h6>
                </div>
                <div class="card-body">
                    <div class="timeline-container">
                        @forelse($delivery->package?->packageLogs->sortBy('logged_at') as $log)
                            @php
                                $translatedStatus = __('package.status_' . $log->status);
                                $color = match($log->status) {
                                    'delivered'        => 'delivered',
                                    'out_for_delivery' => 'out_for_delivery',
                                    'in_warehouse'     => 'in_warehouse',
                                    'returned'         => 'returned',
                                    'pending'          => 'pending',
                                    'cancelled'        => 'cancelled',
                                    'delivery_failed'  => 'delivery_failed',
                                    default            => 'processing',
                                };
                            @endphp

                            <div class="timeline-item">
                                <div class="timeline-dot bg-{{ $color }} text-white">
                                    <i class="mdi mdi-adjust"></i>
                                </div>

                                <div class="timeline-content border-{{ $color }}">
                                    <h3 class="d-flex align-items-center">
                                        <span>{{ $translatedStatus }}</span>
                                        <span class="status-badge bg-{{ $color }} ms-2">{{ __('delivery.status_'.$log->status) }}  </span>
                                    </h3>
                                    <p class="mb-2 text-muted">
                                        {{ $log->note ?? '-' }}
                                    </p>
                                    @if($log->driver_id)
                                        <p class="mb-2">
                                            <i class="mdi mdi-account-outline me-1"></i>
                                            {{ __('driver.the_driver') }}:
                                            <a href="{{ route('admin.drivers.show', $log->driver_id) }}" class="driver-link" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $log->driver->driver_full_name ?? '' }} , {{ $log->driver->phone ?? '' }} , {{ $log->driver->email ?? '' }}">
                                                {{ optional($log->driver)->driver_full_name }}
                                            </a>
                                        </p>
                                    @endif
                                    <div class="timeline-date">
                                        <i class="mdi mdi-clock-outline me-1"></i>
                                        {{ $log->logged_at->format('Y-m-d h:i A') }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="mdi mdi-timeline-question-outline fs-1 text-muted"></i>
                                <p class="text-muted mt-2">{{ __('package.timeline_empty') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // تهيئة أدوات التلميح
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
@endsection
