@extends('layouts.driver')

@section('style')
<!-- مكتبة Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin=""/>

<style>
    :root {
        /* نظام ألوان موحد لحالات التسليم */
        --status-pending: #6c757d;
        --status-assigned_to_driver: #17a2b8;
        --status-driver_picked_up: #fd7e14;
        --status-in_transit: #007bff;
        --status-arrived_at_hub: #6610f2;
        --status-out_for_delivery: #ffc107;
        --status-delivered: #28a745;
        --status-delivery_failed: #dc3545;
        --status-returned: #e83e8c;
        --status-cancelled: #343a40;
        --status-in_warehouse: #20c997;

        /* ألوان متدرجة للإحصائيات */
        --stat-total: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --stat-pending: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        --stat-assigned: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        --stat-in_transit: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        --stat-delivered: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        --stat-failed: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    }

    .stat-card {
        color: white;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        margin-bottom: 20px;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: rgba(255,255,255,0.3);
    }

    .stat-card.total { background: var(--stat-total); }
    .stat-card.pending { background: var(--stat-pending); }
    .stat-card.assigned { background: var(--stat-assigned); }
    .stat-card.in_transit { background: var(--stat-in_transit); }
    .stat-card.delivered { background: var(--stat-delivered); }
    .stat-card.failed { background: var(--stat-failed); }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .stat-card .number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .stat-card .label {
        font-size: 0.9rem;
        opacity: 0.9;
        font-weight: 500;
    }

    /* أزرار سريعة متناسقة */
    .quick-action-btn {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px solid transparent;
        border-radius: 10px;
        padding: 12px;
        text-align: center;
        transition: all 0.3s ease;
        color: #495057;
        text-decoration: none;
        display: block;
        margin-bottom: 10px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .quick-action-btn::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: transparent;
        transition: all 0.3s ease;
    }

    .quick-action-btn.pending::before { background: var(--status-pending); }
    .quick-action-btn.assigned::before { background: var(--status-assigned_to_driver); }
    .quick-action-btn.today::before { background: var(--status-out_for_delivery); }
    .quick-action-btn.nearest::before { background: #6f42c1; }

    .quick-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-decoration: none;
    }

    .quick-action-btn.pending:hover {
        background: linear-gradient(135deg, var(--status-pending) 0%, #495057 100%);
        color: white;
        border-color: var(--status-pending);
    }

    .quick-action-btn.assigned:hover {
        background: linear-gradient(135deg, var(--status-assigned_to_driver) 0%, #138496 100%);
        color: white;
        border-color: var(--status-assigned_to_driver);
    }

    .quick-action-btn.today:hover {
        background: linear-gradient(135deg, var(--status-out_for_delivery) 0%, #e0a800 100%);
        color: white;
        border-color: var(--status-out_for_delivery);
    }

    .quick-action-btn.nearest:hover {
        background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);
        color: white;
        border-color: #6f42c1;
    }

    /* حالة موحدة لل badges */
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        border: 2px solid transparent;
        color: white;
    }

    .badge-pending { background: var(--status-pending); border-color: #495057; }
    .badge-assigned_to_driver { background: var(--status-assigned_to_driver); border-color: #138496; }
    .badge-driver_picked_up { background: var(--status-driver_picked_up); border-color: #e3640c; }
    .badge-in_transit { background: var(--status-in_transit); border-color: #0056b3; }
    .badge-arrived_at_hub { background: var(--status-arrived_at_hub); border-color: #520dc2; }
    .badge-out_for_delivery { background: var(--status-out_for_delivery); border-color: #e0a800; color: #212529; }
    .badge-delivered { background: var(--status-delivered); border-color: #1e7e34; }
    .badge-delivery_failed { background: var(--status-delivery_failed); border-color: #c82333; }
    .badge-returned { background: var(--status-returned); border-color: #d91a6d; }
    .badge-cancelled { background: var(--status-cancelled); border-color: #23272b; }
    .badge-in_warehouse { background: var(--status-in_warehouse); border-color: #199d7e; }

    .map-mini {
        height: 120px;
        border-radius: 8px;
        overflow: hidden;
        margin-top: 10px;
        border: 2px solid #e9ecef;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(74, 111, 220, 0.04);
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }

    .package-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e9ecef;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }

    .action-dropdown .dropdown-menu {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: none;
    }

    .filter-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .recipient-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.8rem;
        font-weight: bold;
    }

    .cod-badge {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        color: #212529;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
    }
</style>
@endsection

@section('content')

@php
    // إحصائيات التسليمات
    $totalDeliveries = $deliveries->total();
    $pendingDeliveries = $deliveries->where('status', 'pending')->count();
    $assignedDeliveries = $deliveries->where('status', 'assigned_to_driver')->count();
    $inTransitDeliveries = $deliveries->where('status', 'in_transit')->count();
    $deliveredDeliveries = $deliveries->where('status', 'delivered')->count();
    $failedDeliveries = $deliveries->whereIn('status', ['delivery_failed', 'returned'])->count();

    // تسليمات اليوم
    $todayDeliveries = $deliveries->where('assigned_at', '>=', now()->startOfDay())->count();
@endphp

<!-- Statistics Cards -->
{{-- <div class="row mb-4">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card total">
            <div class="number">{{ $totalDeliveries }}</div>
            <div class="label">{{ __('delivery.total_deliveries') }}</div>
            <i class="mdi mdi-package-variant fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card pending">
            <div class="number">{{ $pendingDeliveries }}</div>
            <div class="label">{{ __('delivery.pending_deliveries') }}</div>
            <i class="mdi mdi-clock-outline fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card assigned">
            <div class="number">{{ $assignedDeliveries }}</div>
            <div class="label">{{ __('delivery.assigned_deliveries') }}</div>
            <i class="mdi mdi-truck-check fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card in_transit">
            <div class="number">{{ $inTransitDeliveries }}</div>
            <div class="label">{{ __('delivery.in_transit_deliveries') }}</div>
            <i class="mdi mdi-truck-delivery fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card delivered">
            <div class="number">{{ $deliveredDeliveries }}</div>
            <div class="label">{{ __('delivery.delivered_deliveries') }}</div>
            <i class="mdi mdi-check-circle fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card failed">
            <div class="number">{{ $failedDeliveries }}</div>
            <div class="label">{{ __('delivery.failed_deliveries') }}</div>
            <i class="mdi mdi-alert-circle fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
</div> --}}
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card total">
            <div class="number">{{ $totalDeliveries }}</div>
            <div class="label">{{ __('delivery.total_deliveries') }}</div>
            <i class="mdi mdi-package-variant fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card pending">
            <div class="number">{{ $pendingDeliveries }}</div>
            <div class="label">{{ __('delivery.pending') }}</div>
            <i class="mdi mdi-clock-outline fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card assigned">
            <div class="number">{{ $assignedDeliveries }}</div>
            <div class="label">{{ __('delivery.assigned') }}</div>
            <i class="mdi mdi-truck-check fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card in_transit">
            <div class="number">{{ $inTransitDeliveries + $pickedUpDeliveries }}</div>
            <div class="label">{{ __('delivery.in_transit') }}</div>
            <i class="mdi mdi-truck-delivery fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card delivered">
            <div class="number">{{ $deliveredDeliveries }}</div>
            <div class="label">{{ __('delivery.delivered') }}</div>
            <i class="mdi mdi-check-circle fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="stat-card failed">
            <div class="number">{{ $failedDeliveries + $returnedDeliveries + $cancelledDeliveries }}</div>
            <div class="label">{{ __('delivery.failed_cancelled') }}</div>
            <i class="mdi mdi-alert-circle fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
</div>

<!-- Detailed Statistics Row -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-3">
                    <i class="mdi mdi-chart-bar me-2"></i>
                    {{ __('delivery.detailed_statistics') }}
                </h6>
                <div class="row text-center">
                    <div class="col-md-2 col-4 mb-3">
                        <div class="text-primary">
                            <div class="fw-bold fs-4">{{ $pickedUpDeliveries }}</div>
                            <small class="text-muted">{{ __('delivery.picked_up') }}</small>
                        </div>
                    </div>
                    <div class="col-md-2 col-4 mb-3">
                        <div class="text-info">
                            <div class="fw-bold fs-4">{{ $arrivedAtHubDeliveries }}</div>
                            <small class="text-muted">{{ __('delivery.at_hub') }}</small>
                        </div>
                    </div>
                    <div class="col-md-2 col-4 mb-3">
                        <div class="text-warning">
                            <div class="fw-bold fs-4">{{ $outForDeliveryDeliveries }}</div>
                            <small class="text-muted">{{ __('delivery.out_for_delivery') }}</small>
                        </div>
                    </div>
                    <div class="col-md-2 col-4 mb-3">
                        <div class="text-success">
                            <div class="fw-bold fs-4">{{ $deliveredDeliveries }}</div>
                            <small class="text-muted">{{ __('delivery.successful') }}</small>
                        </div>
                    </div>
                    <div class="col-md-2 col-4 mb-3">
                        <div class="text-danger">
                            <div class="fw-bold fs-4">{{ $failedDeliveries }}</div>
                            <small class="text-muted">{{ __('delivery.failed') }}</small>
                        </div>
                    </div>
                    <div class="col-md-2 col-4 mb-3">
                        <div class="text-secondary">
                            <div class="fw-bold fs-4">{{ $returnedDeliveries }}</div>
                            <small class="text-muted">{{ __('delivery.returned') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Quick Actions Sidebar -->
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="mdi mdi-lightning-bolt-outline me-2"></i>
                    {{ __('general.quick_actions') }}
                </h5>
            </div>
            <div class="card-body">
                <a href="{{ route('driver.deliveries.index', ['status' => 'pending']) }}"
                   class="quick-action-btn pending">
                    <i class="mdi mdi-clock-outline me-2"></i>
                    <div>{{ __('delivery.view_pending') }}</div>
                    <small class="opacity-75">{{ $pendingDeliveries }} {{ __('general.deliveries') }}</small>
                </a>

                <a href="{{ route('driver.deliveries.index', ['status' => 'assigned_to_driver']) }}"
                   class="quick-action-btn assigned">
                    <i class="mdi mdi-truck-check me-2"></i>
                    <div>{{ __('delivery.view_assigned') }}</div>
                    <small class="opacity-75">{{ $assignedDeliveries }} {{ __('general.deliveries') }}</small>
                </a>

                <a href="{{ route('driver.deliveries.index', ['assigned_at' => today()->format('Y-m-d')]) }}"
                   class="quick-action-btn today">
                    <i class="mdi mdi-calendar-today me-2"></i>
                    <div>{{ __('delivery.today_deliveries') }}</div>
                    <small class="opacity-75">{{ $todayDeliveries }} {{ __('delivery.scheduled_today') }}</small>
                </a>

                <a href="#" class="quick-action-btn nearest" onclick="showNearestDeliveries()">
                    <i class="mdi mdi-map-marker-distance me-2"></i>
                    <div>{{ __('delivery.nearest_deliveries') }}</div>
                    <small class="opacity-75">{{ __('delivery.by_distance') }}</small>
                </a>
            </div>
        </div>

        <!-- Status Filter -->
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="mdi mdi-filter-outline me-2"></i>
                    {{ __('general.filter_by_status') }}
                </h5>
            </div>
            <div class="card-body">
                @php
                    $statusCounts = [
                        'pending' => $pendingDeliveries,
                        'assigned_to_driver' => $assignedDeliveries,
                        'in_transit' => $inTransitDeliveries,
                        'delivered' => $deliveredDeliveries,
                        'delivery_failed' => $failedDeliveries
                    ];

                    $statusIcons = [
                        'pending' => 'clock-outline',
                        'assigned_to_driver' => 'truck-check',
                        'in_transit' => 'truck-delivery',
                        'delivered' => 'check-circle',
                        'delivery_failed' => 'alert-circle'
                    ];
                @endphp

                @foreach(['pending', 'assigned_to_driver', 'in_transit', 'delivered', 'delivery_failed'] as $status)
                <a href="{{ route('driver.deliveries.index', ['status' => $status]) }}"
                   class="d-flex justify-content-between align-items-center p-2 rounded mb-2
                          {{ request('status') == $status ? 'bg-primary text-white' : 'bg-light' }}">
                    <span>
                        <i class="mdi mdi-{{ $statusIcons[$status] }} status-icon"></i>
                        {{ __('delivery.status_' . $status) }}
                    </span>
                    <span class="badge bg-secondary rounded-pill">{{ $statusCounts[$status] }}</span>
                </a>
                @endforeach

                @if(request()->hasAny(['keyword', 'status', 'package_id', 'delivered_from', 'delivered_to']))
                <div class="mt-3 pt-3 border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ __('general.filtered_results') }}:</small>
                        <span class="badge bg-primary">{{ $deliveries->total() }}</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="card-head d-flex justify-content-between align-items-center mb-4">
                    <div class="head">
                        <h4 class="card-title mb-1">
                            <i class="mdi mdi-truck-delivery me-2 text-primary"></i>
                            {{ __('delivery.manage_deliveries') }}
                        </h4>
                        <p class="card-title-desc text-muted mb-0">
                            {{ __('delivery.delivery_description') }}

                            @if(request()->hasAny(['keyword', 'status', 'package_id', 'delivered_from', 'delivered_to']))
                            <span class="badge bg-info ms-2">
                                <i class="mdi mdi-filter me-1"></i>
                                {{ __('general.filter_applied') }} ({{ $deliveries->total() }})
                            </span>
                            @endif
                        </p>
                    </div>

                    <div class="button-items">
                        <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filtersSection">
                            <i class="mdi mdi-filter-outline me-1"></i>
                            {{ __('general.filters') }}
                            @if(request()->hasAny(['keyword', 'status', 'package_id', 'delivered_from', 'delivered_to']))
                            <span class="badge bg-white text-primary ms-1">{{ $deliveries->total() }}</span>
                            @endif
                        </button>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="collapse mb-4" id="filtersSection">
                    @include('driver.deliveries.filter.filter')
                </div>

                <div class="table-responsive">
                    <table id="datatable" class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th width="80">{{ __('delivery.package') }}</th>
                                <th>{{ __('delivery.recipient') }}</th>
                                <th>{{ __('delivery.address') }}</th>
                                <th width="100">{{ __('delivery.cod_amount') }}</th>
                                <th width="120">{{ __('delivery.status') }}</th>
                                <th width="120">{{ __('delivery.assigned_at') }}</th>
                                <th width="100">{{ __('general.actions') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($deliveries as $delivery)
                                <tr>
                                    <td class="fw-bold text-primary">#{{ $delivery->id }}</td>

                                    <!-- Package Information -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="package-avatar me-3">
                                                <i class="mdi mdi-package-variant"></i>
                                            </div>
                                            <div>
                                                <strong class="d-block">{{ $delivery->package->tracking_number ?? '-' }}</strong>
                                                <small class="text-muted">
                                                    {{ Str::limit($delivery->package->package_content ?? '', 20) }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Recipient Information -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recipient-avatar me-3">
                                                {{ substr($delivery->package->receiver_first_name ?? 'R', 0, 1) }}
                                            </div>
                                            <div>
                                                <strong class="d-block">
                                                    {{ $delivery->package->receiver_first_name ?? '' }} {{ $delivery->package->receiver_last_name ?? '' }}
                                                </strong>
                                                <small class="text-muted">
                                                    <i class="mdi mdi-phone me-1"></i>
                                                    {{ $delivery->package->receiver_phone ?? '-' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Address Information -->
                                    <td>
                                        <div class="location-info">
                                            @php
                                                $addressParts = array_filter([
                                                    $delivery->package->receiver_city,
                                                    $delivery->package->receiver_district,
                                                    $delivery->package->receiver_region,
                                                ]);
                                                $fullAddress = $delivery->package ?
                                                    implode(' - ', array_filter([
                                                        $delivery->package->receiver_country,
                                                        $delivery->package->receiver_region,
                                                        $delivery->package->receiver_city,
                                                        $delivery->package->receiver_district,
                                                        $delivery->package->receiver_postal_code,
                                                    ])) : '-';
                                            @endphp

                                            <strong class="d-block">
                                                <i class="mdi mdi-map-marker-outline me-1 text-danger"></i>
                                                {{ implode(' - ', array_slice($addressParts, 0, 2)) ?: '-' }}
                                            </strong>
                                            <small class="text-muted">
                                                {{ Str::limit($fullAddress, 40) }}
                                            </small>

                                            @if($delivery->package && $delivery->package->receiver_latitude && $delivery->package->receiver_longitude)
                                            <div class="map-mini"
                                                 id="mini-map-{{ $delivery->id }}"
                                                 data-lat="{{ $delivery->package->receiver_latitude }}"
                                                 data-lng="{{ $delivery->package->receiver_longitude }}">
                                            </div>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- COD Amount -->
                                    <td>
                                        @if($delivery->package && $delivery->package->cod_amount > 0)
                                            <span class="cod-badge">
                                                <i class="mdi mdi-cash me-1"></i>
                                                {{ number_format($delivery->package->cod_amount, 2) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <!-- Status Information -->
                                    <td>
                                        <div class="status-info">
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'badge-pending',
                                                    'assigned_to_driver' => 'badge-assigned_to_driver',
                                                    'driver_picked_up' => 'badge-driver_picked_up',
                                                    'in_transit' => 'badge-in_transit',
                                                    'arrived_at_hub' => 'badge-arrived_at_hub',
                                                    'out_for_delivery' => 'badge-out_for_delivery',
                                                    'delivered' => 'badge-delivered',
                                                    'delivery_failed' => 'badge-delivery_failed',
                                                    'returned' => 'badge-returned',
                                                    'cancelled' => 'badge-cancelled',
                                                    'in_warehouse' => 'badge-in_warehouse'
                                                ];

                                                $statusIcons = [
                                                    'pending' => 'clock-outline',
                                                    'assigned_to_driver' => 'truck-check',
                                                    'driver_picked_up' => 'package-variant',
                                                    'in_transit' => 'truck-delivery',
                                                    'arrived_at_hub' => 'warehouse',
                                                    'out_for_delivery' => 'walk',
                                                    'delivered' => 'check-circle',
                                                    'delivery_failed' => 'alert-circle',
                                                    'returned' => 'package-up',
                                                    'cancelled' => 'cancel',
                                                    'in_warehouse' => 'archive'
                                                ];
                                            @endphp

                                            <span class="status-badge {{ $statusClasses[$delivery->status] }} d-flex align-items-center">
                                                <i class="mdi mdi-{{ $statusIcons[$delivery->status] }} me-1"></i>
                                                {{ __('delivery.status_' . $delivery->status) }}
                                            </span>

                                            @if($delivery->status == 'delivered' && $delivery->delivered_at)
                                            <small class="text-muted d-block mt-1">
                                                {{ $delivery->delivered_at->diffForHumans() }}
                                            </small>
                                            @elseif($delivery->status == 'assigned_to_driver' && $delivery->assigned_at)
                                            <small class="text-muted d-block mt-1">
                                                {{ $delivery->assigned_at->diffForHumans() }}
                                            </small>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Assigned At -->
                                    <td>
                                        <div class="schedule-info text-center">
                                            @if($delivery->assigned_at)
                                            <strong class="d-block text-primary">
                                                {{ $delivery->assigned_at->format('d M') }}
                                            </strong>
                                            <small class="text-muted">
                                                {{ $delivery->assigned_at->format('H:i') }}
                                            </small>
                                            <div class="mt-1">
                                                @if($delivery->assigned_at->isToday())
                                                <span class="badge bg-success badge-sm">{{ __('general.today') }}</span>
                                                @elseif($delivery->assigned_at->isTomorrow())
                                                <span class="badge bg-info badge-sm">{{ __('general.tomorrow') }}</span>
                                                @endif
                                            </div>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Actions -->
                                    <td>
                                        <div class="action-dropdown">
                                            <div class="btn-group">
                                                <a href="{{ route('driver.deliveries.show', $delivery->id) }}"
                                                   class="btn btn-sm btn-outline-primary"
                                                   data-bs-toggle="tooltip"
                                                   title="{{ __('general.view_details') }}">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>

                                                @if(count($delivery->availableStatusesForDriver()) > 0)
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-warning dropdown-toggle dropdown-toggle-split"
                                                            data-bs-toggle="dropdown"
                                                            data-bs-toggle="tooltip"
                                                            title="{{ __('general.update_status') }}">
                                                        <i class="mdi mdi-update"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        @foreach($delivery->availableStatusesForDriver() as $status)
                                                        <li>
                                                            <form action="{{ route('driver.deliveries.update_status', $delivery->id) }}"
                                                                method="POST" class="d-inline status-update-form">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="{{ $status }}">
                                                                <button type="submit" class="dropdown-item status-update-btn"
                                                                        data-status="{{ $status }}"
                                                                        data-delivery-id="{{ $delivery->id }}">
                                                                    <i class="mdi mdi-{{ $statusIcons[$status] }} me-2"></i>
                                                                    {{ __('delivery.mark_as') }} {{ __('delivery.status_' . $status) }}
                                                                </button>
                                                            </form>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>

                                            <div class="btn-group mt-1">
                                                @if($delivery->package && $delivery->package->receiver_latitude && $delivery->package->receiver_longitude)
                                                    <a href="#"
                                                    class="btn btn-sm btn-outline-success"
                                                    onclick="showRouteToDelivery({{ $delivery->package->receiver_latitude }}, {{ $delivery->package->receiver_longitude }}, '{{ $delivery->package->receiver_first_name }}')"
                                                    data-bs-toggle="tooltip"
                                                    title="{{ __('general.view_route') }}">
                                                        <i class="mdi mdi-map-marker-path"></i>
                                                    </a>
                                                @endif

                                                @ability('driver', 'update_deliveries')
                                                 <a href="{{ route('driver.deliveries.edit', $delivery->id) }}"
                                                            class="btn btn-sm btn-outline-warning"
                                                            data-bs-toggle="tooltip"
                                                            title="{{ __('general.edit') }}">
                                                        <i class="mdi mdi-square-edit-outline"></i>
                                                </a>
                                                @endability
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="mdi mdi-truck-remove-outline fs-1 text-muted"></i>
                                            <h5 class="mt-3">{{ __('delivery.no_deliveries_found') }}</h5>
                                            <p class="text-muted">{{ __('delivery.no_deliveries_description') }}</p>
                                            <a href="{{ route('driver.deliveries.index') }}" class="btn btn-primary">
                                                <i class="mdi mdi-refresh me-2"></i>
                                                {{ __('general.reset_filters') }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($deliveries->hasPages())
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                {{ __('general.showing') }} {{ $deliveries->firstItem() }} - {{ $deliveries->lastItem() }}
                                {{ __('general.of') }} {{ $deliveries->total() }}
                                {{ __('general.records') }}

                                @if(request()->hasAny(['keyword', 'status', 'package_id', 'delivered_from', 'delivered_to']))
                                <span class="badge bg-info ms-2">
                                    <i class="mdi mdi-filter me-1"></i>
                                    {{ __('general.filtered') }}
                                </span>
                                @endif
                            </div>
                            <div>
                                {{ $deliveries->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<!-- مكتبة Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize mini maps for delivery locations
        function initMiniMaps() {
            const mapContainers = document.querySelectorAll('.map-mini');

            mapContainers.forEach(container => {
                const lat = parseFloat(container.getAttribute('data-lat'));
                const lng = parseFloat(container.getAttribute('data-lng'));
                const mapId = container.id;

                if (!isNaN(lat) && !isNaN(lng)) {
                    const map = L.map(mapId).setView([lat, lng], 15);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    L.marker([lat, lng]).addTo(map)
                        .bindPopup('{{ __("delivery.delivery_location") }}');
                }
            });
        }

        // Show route to delivery location
        window.showRouteToDelivery = function(lat, lng, recipientName) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;

                    const googleMapsUrl = `https://www.google.com/maps/dir/${userLat},${userLng}/${lat},${lng}/`;
                    window.open(googleMapsUrl, '_blank');
                }, function(error) {
                    // If location access denied, open direct location
                    const googleMapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;
                    window.open(googleMapsUrl, '_blank');
                });
            } else {
                const googleMapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;
                window.open(googleMapsUrl, '_blank');
            }
        }

        // Show nearest deliveries
        window.showNearestDeliveries = function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Redirect to nearest deliveries page or filter
                    window.location.href = '{{ route("driver.deliveries.index") }}?sort=distance&lat=' +
                                        position.coords.latitude + '&lng=' + position.coords.longitude;
                }, function(error) {
                    alert('{{ __("general.location_access_required") }}');
                });
            } else {
                alert('{{ __("general.location_not_supported") }}');
            }
        }

        // Initialize tooltips
        function initTooltips() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        // Initialize everything
        setTimeout(initMiniMaps, 1000);
        initTooltips();

        // إضافة تأكيد عند تغيير الحالة
        document.querySelectorAll('.status-update-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const status = this.getAttribute('data-status');
                const deliveryId = this.getAttribute('data-delivery-id');
                const statusText = this.textContent.trim();

                if (!confirm(`هل أنت متأكد من تغيير حالة التوصيل #${deliveryId} إلى "${statusText}"؟`)) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
        });

        // معالجة النماذج بشكل غير متزامن
        document.querySelectorAll('.status-update-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                this.querySelector('button').disabled = true;
                this.querySelector('button').innerHTML =
                    '<i class="mdi mdi-loading mdi-spin me-2"></i> جاري التحديث...';
            });
        });
    });
</script>
@endsection
