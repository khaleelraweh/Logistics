@extends('layouts.driver')

@section('style')
    <style>
        .delivery-cards-container {
            --primary-gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            --success-gradient: linear-gradient(135deg, #4cc9f0 0%, #4895ef 100%);
            --info-gradient: linear-gradient(135deg, #7209b7 0%, #560bad 100%);
            --warning-gradient: linear-gradient(135deg, #f72585 0%, #b5179e 100%);
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
            position: relative;
        }

        .delivery-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .delivery-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 4px;
            background: var(--primary-gradient);
        }

        .delivery-card.success-card::before {
            background: var(--success-gradient);
        }

        .delivery-card.info-card::before {
            background: var(--info-gradient);
        }

        .delivery-card.warning-card::before {
            background: var(--warning-gradient);
        }

        .card-header-custom {
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            padding: 20px 24px;
            font-weight: 600;
            background: var(--primary-gradient);
            position: relative;
            overflow: hidden;
        }

        .card-header-custom::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
        }

        .card-header-success {
            background: var(--success-gradient);
        }

        .card-header-info {
            background: var(--info-gradient);
        }

        .card-header-warning {
            background: var(--warning-gradient);
        }

        .card-body-custom {
            padding: 24px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            transition: var(--transition);
            position: relative;
        }

        .info-item:hover {
            background-color: #f9fafc;
            padding-right: 12px;
            border-radius: 8px;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            color: #4361ee;
            margin-left: 12px;
            font-size: 20px;
            width: 28px;
            text-align: center;
            transition: var(--transition);
        }

        .info-item:hover .info-icon {
            transform: scale(1.2);
            color: #3a0ca3;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .driver-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: var(--success-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            margin-left: 20px;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(76, 201, 240, 0.3);
            transition: var(--transition);
        }

        .driver-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(76, 201, 240, 0.4);
        }

        .driver-info h6 {
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 1.1rem;
        }

        .driver-details {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .alert-custom {
            border-radius: 12px;
            padding: 20px;
            border: none;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #6c757d;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .table-custom {
            border-radius: 10px;
            overflow: hidden;
        }

        .table-custom th {
            font-weight: 500;
            color: #6c757d;
            padding: 12px 8px;
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
        }

        .table-custom td {
            padding: 12px 8px;
            border-bottom: 1px solid #f1f3f4;
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
            background: #fff;
        }

        .timeline-header {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            padding: 20px 24px;
            font-weight: 600;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            position: relative;
            overflow: hidden;
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
            background: linear-gradient(to bottom, #e9ecef, #6c757d, #e9ecef);
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
            width: calc(50% - 50px);
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .timeline-content:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .timeline-item:nth-child(odd) .timeline-content {
            text-align: right;
            border-right: 4px solid;
        }

        .timeline-item:nth-child(even) .timeline-content {
            text-align: right;
            border-left: 4px solid;
        }

        .timeline-item:nth-child(odd) .timeline-content::before {
            content: '';
            position: absolute;
            top: 20px;
            right: 100%;
            height: 0;
            width: 0;
            border: 8px solid transparent;
            border-right: 8px solid white;
        }

        .timeline-item:nth-child(even) .timeline-content::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 100%;
            height: 0;
            width: 0;
            border: 8px solid transparent;
            border-left: 8px solid white;
        }

        .timeline-dot {
            position: absolute;
            top: 20px;
            right: 50%;
            transform: translateX(50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 6px white, 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 2;
            transition: var(--transition);
        }

        .timeline-dot:hover {
            transform: translateX(50%) scale(1.1);
        }

        .timeline-content h3 {
            margin-top: 0;
            margin-bottom: 0.5em;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .timeline-content p {
            margin-bottom: 0.5em;
            line-height: 1.6;
        }

        .timeline-date {
            display: inline-block;
            font-size: 0.85rem;
            color: #6c757d;
            background: #f8f9fa;
            padding: 6px 12px;
            border-radius: 20px;
            margin-top: 0.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .driver-link {
            color: #4361ee;
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
        }

        .driver-link:hover {
            text-decoration: underline;
            color: #3a0ca3;
        }

        /* ألوان الحالات */
        .bg-delivered { background: linear-gradient(135deg, #38b2ac 0%, #319795 100%); }
        .bg-pending { background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%); }
        .bg-processing { background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%); }
        .bg-canceled { background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%); }
        .bg-out_for_delivery { background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%); }
        .bg-in_warehouse { background: linear-gradient(135deg, #673ab7 0%, #5e35b1 100%); }
        .bg-returned { background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%); }
        .bg-cancelled { background: linear-gradient(135deg, #607d8b 0%, #546e7a 100%); }
        .bg-delivery_failed { background: linear-gradient(135deg, #ff5722 0%, #f4511e 100%); }
        .bg-warning { background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%); }
        .bg-primary { background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); }
        .bg-info { background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%); }
        .bg-success { background: linear-gradient(135deg, #38b2ac 0%, #319795 100%); }
        .bg-danger { background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%); }
        .bg-secondary { background: linear-gradient(135deg, #6c757d 0%, #495057 100%); }

        .status-indicator {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            display: inline-block;
            margin-left: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* تأثيرات تفاعلية */
        .clickable {
            cursor: pointer;
            transition: var(--transition);
        }

        .clickable:hover {
            transform: translateY(-2px);
        }

        /* تحسينات للشاشات الصغيرة */
        @media (max-width: 768px) {
            .timeline-container::before {
                right: 16px;
                transform: none;
            }

            .timeline-item:nth-child(odd),
            .timeline-item:nth-child(even) {
                justify-content: flex-start;
            }

            .timeline-content {
                width: calc(100% - 70px);
                margin-right: 3em !important;
                margin-left: 0 !important;
                text-align: right !important;
                border-left: 4px solid !important;
                border-right: none !important;
            }

            .timeline-item:nth-child(odd) .timeline-content::before,
            .timeline-item:nth-child(even) .timeline-content::before {
                right: auto;
                left: 100%;
                border: 8px solid transparent;
                border-left: 8px solid white;
                border-right: none;
            }

            .timeline-dot {
                right: 2px;
                transform: none;
            }

            .col-lg-4 {
                margin-bottom: 24px;
            }

            .card-body-custom {
                padding: 20px;
            }

            .driver-avatar {
                width: 60px;
                height: 60px;
                font-size: 24px;
                margin-left: 15px;
            }
        }

        @media (max-width: 568px) {
            .timeline-content {
                padding: 1rem;
            }

            .timeline-dot {
                width: 40px;
                height: 40px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="driver-avatar bg-{{ $deliveryHelper->getStatusColor($delivery->status) }} me-3">
                        <i class="mdi mdi-truck-delivery"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 font-size-18">{{ __('delivery.view_delivery') }}</h4>
                        <p class="text-muted mb-0">#{{ $delivery->id }} - {{ $delivery->package->tracking_number ?? '' }}</p>
                    </div>
                </div>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('driver.deliveries.index') }}">{{ __('delivery.manage_deliveries') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('delivery.view_delivery') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="delivery-cards-container">
        <div class="row mt-4 g-4">
            <!-- بطاقة التوصيلة -->
            <div class="col-lg-4">
                <div class="delivery-card">
                    <div class="card-header-custom text-white d-flex align-items-center">
                        <i class="mdi mdi-truck-fast-outline me-2 fs-5"></i>
                        <h6 class="mb-0">{{ __('delivery.delivery_info') }}</h6>
                    </div>
                    <div class="card-body-custom">
                        <div class="info-item clickable">
                            <div class="d-flex align-items-center">
                                <span class="status-indicator bg-{{ $deliveryHelper->getStatusColor($delivery->status) }}"></span>
                                <span>{{ __('delivery.status') }}</span>
                            </div>
                            <span class="status-badge bg-{{ $deliveryHelper->getStatusColor($delivery->status) }} text-white">
                                {{ __('package.status_' . $delivery->status) }}
                            </span>
                        </div>

                        <div class="info-item clickable">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-calendar-clock info-icon"></i>
                                <span>{{ __('delivery.assigned_at') }}</span>
                            </div>
                            <span class="fw-bold">{{ $delivery->assigned_at ? $delivery->assigned_at->format('Y-m-d h:i A') : '-' }}</span>
                        </div>

                        <div class="info-item clickable">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-check-circle-outline info-icon"></i>
                                <span>{{ __('delivery.delivered_at') }}</span>
                            </div>
                            <span class="fw-bold">{{ $delivery->delivered_at ? $delivery->delivered_at->format('Y-m-d h:i A') : '-' }}</span>
                        </div>

                        <div class="info-item clickable">
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
                <div class="delivery-card success-card">
                    <div class="card-header-custom card-header-success text-white d-flex align-items-center">
                        <i class="mdi mdi-account-tie me-2 fs-5"></i>
                        <h6 class="mb-0">{{ __('delivery.driver_info') }}</h6>
                    </div>
                    <div class="card-body-custom">
                        @if($delivery->driver)
                            <div class="d-flex align-items-center mb-4">
                                <div class="driver-avatar bg-{{ $deliveryHelper->getStatusColor($delivery->status) }}">
                                    <i class="mdi mdi-account-outline"></i>
                                </div>
                                <div class="driver-info">
                                    <h6 class="mb-1">{{ $delivery->driver->driver_full_name }}</h6>
                                    <div class="driver-details">
                                        <span class="status-badge bg-{{ $deliveryHelper->getStatusColor($delivery->status) }} text-white">
                                            {{ __('package.status_' . $delivery->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-sm table-borderless table-custom">
                                    <tbody>
                                        <tr class="clickable">
                                            <th scope="row" width="30%"><i class="mdi mdi-phone-outline me-1 text-muted"></i> {{ __('driver.phone') }}</th>
                                            <td>{{ $delivery->driver->phone ?? '-' }}</td>
                                        </tr>
                                        <tr class="clickable">
                                            <th scope="row"><i class="mdi mdi-email-outline me-1 text-muted"></i> {{ __('driver.email') }}</th>
                                            <td>{{ $delivery->driver->email ?? '-' }}</td>
                                        </tr>
                                        <tr class="clickable">
                                            <th scope="row"><i class="mdi mdi-clock-outline me-1 text-muted"></i> حالة التسليم</th>
                                            <td>
                                                <span class="status-badge bg-{{ $deliveryHelper->getStatusColor($delivery->status) }} text-white">
                                                    {{ __('package.status_' . $delivery->status) }}
                                                </span>
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
                <div class="delivery-card info-card">
                    <div class="card-header-custom card-header-info text-white d-flex align-items-center">
                        <i class="mdi mdi-package-variant-closed me-2 fs-5"></i>
                        <h6 class="mb-0">{{ __('delivery.package_info') }}</h6>
                    </div>
                    <div class="card-body-custom">
                        @if($delivery->package)
                            <div class="info-item clickable">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-barcode-scan info-icon"></i>
                                    <span>{{ __('package.tracking_number') }}</span>
                                </div>
                                <span class="fw-bold">{{ $delivery->package->tracking_number ?? '-' }}</span>
                            </div>

                            <div class="info-item clickable">
                                <div class="d-flex align-items-center">
                                    <span class="status-indicator bg-{{ $deliveryHelper->getStatusColor($delivery->package->status) }}"></span>
                                    <span>{{ __('package.status') }}</span>
                                </div>
                                <span class="status-badge bg-{{ $deliveryHelper->getStatusColor($delivery->package->status) }} text-white">
                                    {{ __('package.status_' . $delivery->package->status) }}
                                </span>
                            </div>

                            <div class="info-item clickable">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-account-box-outline info-icon"></i>
                                    <span>{{ __('delivery.receiver') }}</span>
                                </div>
                                <span class="fw-bold">{{ $delivery->package->receiver_first_name }} {{ $delivery->package->receiver_last_name }}</span>
                            </div>

                            <div class="info-item clickable">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-cash-multiple info-icon"></i>
                                    <span>{{ __('package.total_fee') }}</span>
                                </div>
                                <span class="fw-bold text-success">{{ $delivery->package->total_fee ?? '-' }} ر.س</span>
                            </div>

                            <div class="info-item clickable">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-truck-delivery-outline info-icon"></i>
                                    <span>حالة التوصيل</span>
                                </div>
                                <span class="status-badge bg-{{ $deliveryHelper->getStatusColor($delivery->status) }} text-white">
                                    {{ __('package.status_' . $delivery->status) }}
                                </span>
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
                                $color = $deliveryHelper->getStatusColor($log->status);
                            @endphp

                            <div class="timeline-item">
                                <div class="timeline-dot bg-{{ $color }} text-white clickable">
                                    <i class="mdi mdi-adjust"></i>
                                </div>

                                <div class="timeline-content border-{{ $color }} clickable">
                                    <h3 class="d-flex align-items-center justify-content-between">
                                        <span>{{ $translatedStatus }}</span>
                                        <span class="status-badge bg-{{ $color }} text-white">
                                            {{ __('delivery.status_'.$log->status) }}
                                        </span>
                                    </h3>
                                    <p class="mb-2 text-muted">
                                        {{ $log->note ?? '-' }}
                                    </p>
                                    @if($log->driver_id)
                                        <p class="mb-2">
                                            <i class="mdi mdi-account-outline me-1"></i>
                                            {{ __('driver.the_driver') }}:
                                            {{-- <a href="{{ route('driver.drivers.show', $log->driver_id) }}" class="driver-link" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $log->driver->driver_full_name ?? '' }} , {{ $log->driver->phone ?? '' }} , {{ $log->driver->email ?? '' }}"> --}}
                                            <a href="#" class="driver-link" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $log->driver->driver_full_name ?? '' }} , {{ $log->driver->phone ?? '' }} , {{ $log->driver->email ?? '' }}">
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
        document.addEventListener('DOMContentLoaded', function() {
            // تهيئة أدوات التلميح
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // تأثيرات تفاعلية للعناصر القابلة للنقر
            const clickableElements = document.querySelectorAll('.clickable');
            clickableElements.forEach(element => {
                element.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });

            // تأثيرات تحوم للبطاقات
            const cards = document.querySelectorAll('.delivery-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endsection
