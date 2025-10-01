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
        --stat-active: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        --stat-delivered: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        --stat-failed: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        --stat-today: linear-gradient(135deg, #fd7e14 0%, #e3640c 100%);
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
    .stat-card.active { background: var(--stat-active); }
    .stat-card.delivered { background: var(--stat-delivered); }
    .stat-card.failed { background: var(--stat-failed); }
    .stat-card.today { background: var(--stat-today); }

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
        padding: 15px;
        text-align: center;
        transition: all 0.3s ease;
        color: #495057;
        text-decoration: none;
        display: block;
        margin-bottom: 12px;
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
    .quick-action-btn.active::before { background: var(--status-in_transit); }
    .quick-action-btn.today::before { background: var(--status-out_for_delivery); }
    .quick-action-btn.nearest::before { background: #6f42c1; }

    .quick-action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        text-decoration: none;
        color: white;
    }

    .quick-action-btn.pending:hover {
        background: linear-gradient(135deg, var(--status-pending) 0%, #495057 100%);
        border-color: var(--status-pending);
    }

    .quick-action-btn.assigned:hover {
        background: linear-gradient(135deg, var(--status-assigned_to_driver) 0%, #138496 100%);
        border-color: var(--status-assigned_to_driver);
    }

    .quick-action-btn.active:hover {
        background: linear-gradient(135deg, var(--status-in_transit) 0%, #0056b3 100%);
        border-color: var(--status-in_transit);
    }

    .quick-action-btn.today:hover {
        background: linear-gradient(135deg, var(--status-out_for_delivery) 0%, #e0a800 100%);
        border-color: var(--status-out_for_delivery);
    }

    .quick-action-btn.nearest:hover {
        background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);
        border-color: #6f42c1;
    }

    .quick-action-btn .count {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .quick-action-btn .text {
        font-size: 0.85rem;
        margin-bottom: 3px;
    }

    .quick-action-btn .subtext {
        font-size: 0.75rem;
        opacity: 0.8;
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

    .status-filter-item {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .status-filter-item:hover {
        background-color: rgba(0, 123, 255, 0.1);
        border-left-color: #007bff;
    }

    .status-filter-item.active {
        background-color: #007bff;
        color: white;
        border-left-color: #0056b3;
    }

    /* أنماط الأكورديون المخصصة */
    .sidebar-accordion .accordion-item {
        border: none;
        border-radius: 12px;
        margin-bottom: 15px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .sidebar-accordion .accordion-button {
        border-radius: 12px !important;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 1rem 1.25rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #495057;
    }

    .sidebar-accordion .accordion-button:not(.collapsed) {
        box-shadow: none;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
    }

    .sidebar-accordion .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%236c757d'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        transition: transform 0.3s ease;
    }

    .sidebar-accordion .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        transform: rotate(-180deg);
    }

    .sidebar-accordion .accordion-body {
        padding: 0;
        background: #f8f9fa;
        border-radius: 0 0 12px 12px;
        max-height: 400px;
        overflow-y: auto;
    }

    /* تحسينات الإجراءات السريعة داخل الأكورديون */
    .sidebar-accordion .quick-action-btn {
        margin: 8px;
        border-radius: 8px;
        padding: 12px;
    }

    .sidebar-accordion .quick-action-btn .count {
        font-size: 1.3rem;
    }

    .sidebar-accordion .quick-action-btn .text {
        font-size: 0.8rem;
    }

    .sidebar-accordion .quick-action-btn .subtext {
        font-size: 0.7rem;
    }

    /* تحسينات قائمة الفلترة */
    .sidebar-accordion .list-group-item {
        border: none;
        padding: 12px 15px;
        border-radius: 0;
        font-size: 0.9rem;
    }

    .sidebar-accordion .list-group-item:first-child {
        border-top: 1px solid rgba(0,0,0,0.05);
    }

    .sidebar-accordion .list-group-item:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    /* تصميم متجاوب للشاشات الصغيرة */
    @media (max-width: 991.98px) {
        .sidebar-accordion .accordion-collapse {
            border: 1px solid rgba(0,0,0,0.1);
            border-top: none;
            border-radius: 0 0 12px 12px;
        }

        .sidebar-accordion .quick-action-btn {
            margin: 6px;
            padding: 10px;
        }

        .sidebar-accordion .list-group-item {
            padding: 10px 12px;
            font-size: 0.85rem;
        }
    }

    /* أزرار التحكم الجانبية */
    .sidebar-toggle {
        position: fixed;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1050;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        color: white;
        box-shadow: 0 4px 15px rgba(0,123,255,0.3);
        transition: all 0.3s ease;
    }

    .sidebar-toggle:hover {
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 20px rgba(0,123,255,0.4);
    }

    .sidebar-collapsed .col-lg-3 {
        display: none;
    }

    .sidebar-collapsed .col-lg-9 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    /* أيقونات الشاشات الصغيرة */
    .mobile-quick-actions {
        display: none;
    }

    @media (max-width: 768px) {
        .mobile-quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .mobile-action-btn {
            flex: 1;
            min-width: 120px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px solid transparent;
            border-radius: 10px;
            padding: 12px 8px;
            text-align: center;
            transition: all 0.3s ease;
            color: #495057;
            text-decoration: none;
            cursor: pointer;
        }

        .mobile-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .mobile-action-btn.pending { border-left: 4px solid var(--status-pending); }
        .mobile-action-btn.assigned { border-left: 4px solid var(--status-assigned_to_driver); }
        .mobile-action-btn.active { border-left: 4px solid var(--status-in_transit); }
        .mobile-action-btn.today { border-left: 4px solid var(--status-out_for_delivery); }

        .mobile-action-btn .count {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .mobile-action-btn .text {
            font-size: 0.75rem;
            margin-bottom: 2px;
        }

        .mobile-action-btn .subtext {
            font-size: 0.65rem;
            opacity: 0.8;
        }

        /* إخفاء الشريط الجانبي في الشاشات الصغيرة */
        .col-lg-3 {
            display: none;
        }

        .col-lg-9 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    /* تأثيرات الحركة */
    .accordion-collapse {
        transition: all 0.3s ease;
    }

    /* تحسينات عامة */
    .sidebar-accordion .accordion-body::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-accordion .accordion-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .sidebar-accordion .accordion-body::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .sidebar-accordion .accordion-body::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>
@endsection

@section('content')

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
        <div class="stat-card active">
            <div class="number">{{ $activeDeliveries }}</div>
            <div class="label">{{ __('delivery.in_progress') }}</div>
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
        <div class="stat-card today">
            <div class="number">{{ $todayDeliveries }}</div>
            <div class="label">{{ __('delivery.today_deliveries') }}</div>
            <i class="mdi mdi-calendar-today fs-2 opacity-50 mt-2"></i>
        </div>
    </div>
</div>

<!-- الإجراءات السريعة للشاشات الصغيرة -->
<div class="mobile-quick-actions">
    <a href="{{ route('driver.deliveries.index', ['status' => 'pending']) }}" class="mobile-action-btn pending">
        <div class="count">{{ $pendingDeliveries }}</div>
        <div class="text">{{ __('delivery.pending') }}</div>
        <div class="subtext">{{ __('delivery.view_pending') }}</div>
    </a>
    <a href="{{ route('driver.deliveries.index', ['status' => 'assigned_to_driver']) }}" class="mobile-action-btn assigned">
        <div class="count">{{ $assignedDeliveries }}</div>
        <div class="text">{{ __('delivery.assigned') }}</div>
        <div class="subtext">{{ __('delivery.view_assigned') }}</div>
    </a>
    <a href="{{ route('driver.deliveries.index') }}?status[]=driver_picked_up&status[]=in_transit&status[]=out_for_delivery" class="mobile-action-btn active">
        <div class="count">{{ $activeDeliveries }}</div>
        <div class="text">{{ __('delivery.active') }}</div>
        <div class="subtext">{{ __('delivery.active_deliveries') }}</div>
    </a>
    <a href="{{ route('driver.deliveries.index', ['date_from' => today()->format('Y-m-d')]) }}" class="mobile-action-btn today">
        <div class="count">{{ $todayDeliveries }}</div>
        <div class="text">{{ __('delivery.today') }}</div>
        <div class="subtext">{{ __('delivery.today_deliveries') }}</div>
    </a>
</div>

<div class="row" id="mainContent">
    <!-- زر التحكم الجانبي -->
    <button class="sidebar-toggle d-none d-lg-block" id="sidebarToggle">
        <i class="mdi mdi-menu"></i>
    </button>

    <!-- Quick Actions & Filters Sidebar -->
    <div class="col-lg-3">
        <div class="sidebar-accordion">
            <!-- Quick Actions Accordion -->
            <div class="accordion" id="quickActionsAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="quickActionsHeading">
                        <button class="accordion-button" type="button"
                                data-bs-toggle="collapse" data-bs-target="#quickActionsCollapse"
                                aria-expanded="true" aria-controls="quickActionsCollapse">
                            <i class="mdi mdi-lightning-bolt-outline me-2"></i>
                            <span class="fw-semibold">{{ __('general.quick_actions') }}</span>
                            <span class="badge bg-primary ms-2">{{ $activeDeliveries + $pendingDeliveries }}</span>
                        </button>
                    </h2>
                    <div id="quickActionsCollapse" class="accordion-collapse collapse show"
                         aria-labelledby="quickActionsHeading" data-bs-parent="#quickActionsAccordion">
                        <div class="accordion-body">
                            <a href="{{ route('driver.deliveries.index', ['status' => 'pending']) }}"
                               class="quick-action-btn pending">
                                <div class="count">{{ $pendingDeliveries }}</div>
                                <div class="text">{{ __('delivery.view_pending') }}</div>
                                <div class="subtext">{{ __('delivery.awaiting_assignment') }}</div>
                            </a>

                            <a href="{{ route('driver.deliveries.index', ['status' => 'assigned_to_driver']) }}"
                               class="quick-action-btn assigned">
                                <div class="count">{{ $assignedDeliveries }}</div>
                                <div class="text">{{ __('delivery.view_assigned') }}</div>
                                <div class="subtext">{{ __('delivery.ready_for_pickup') }}</div>
                            </a>

                            <a href="{{ route('driver.deliveries.index') }}?status[]=driver_picked_up&status[]=in_transit&status[]=out_for_delivery"
                               class="quick-action-btn active">
                                <div class="count">{{ $activeDeliveries }}</div>
                                <div class="text">{{ __('delivery.active_deliveries') }}</div>
                                <div class="subtext">{{ __('delivery.in_progress') }}</div>
                            </a>

                            <a href="{{ route('driver.deliveries.index', ['date_from' => today()->format('Y-m-d')]) }}"
                               class="quick-action-btn today">
                                <div class="count">{{ $todayDeliveries }}</div>
                                <div class="text">{{ __('delivery.today_deliveries') }}</div>
                                <div class="subtext">{{ __('delivery.scheduled_today') }}</div>
                            </a>

                            <a href="#" class="quick-action-btn nearest" onclick="showNearestDeliveries()">
                                <div class="count">
                                    <i class="mdi mdi-near-me"></i>
                                </div>
                                <div class="text">{{ __('delivery.nearest_deliveries') }}</div>
                                <div class="subtext">{{ __('delivery.by_distance') }}</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Filter Accordion -->
            <div class="accordion mt-3" id="statusFilterAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="statusFilterHeading">
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#statusFilterCollapse"
                                aria-expanded="false" aria-controls="statusFilterCollapse">
                            <i class="mdi mdi-filter-outline me-2"></i>
                            <span class="fw-semibold">{{ __('general.filter_by_status') }}</span>
                            <span class="badge bg-info ms-2">{{ $totalDeliveries }}</span>
                        </button>
                    </h2>
                    <div id="statusFilterCollapse" class="accordion-collapse collapse"
                         aria-labelledby="statusFilterHeading" data-bs-parent="#statusFilterAccordion">
                        <div class="accordion-body p-0">
                            <div class="list-group list-group-flush">
                                @php
                                    $statusCounts = [
                                        'pending' => $pendingDeliveries,
                                        'assigned_to_driver' => $assignedDeliveries,
                                        'driver_picked_up' => $pickedUpDeliveries,
                                        'in_transit' => $inTransitDeliveries,
                                        'arrived_at_hub' => $arrivedAtHubDeliveries,
                                        'out_for_delivery' => $outForDeliveryDeliveries,
                                        'delivered' => $deliveredDeliveries,
                                        'delivery_failed' => $failedDeliveries,
                                        'returned' => $returnedDeliveries,
                                        'cancelled' => $cancelledDeliveries,
                                        'in_warehouse' => $inWarehouseDeliveries
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

                                    $currentStatus = request('status');
                                @endphp

                                <a href="{{ route('driver.deliveries.index') }}"
                                   class="list-group-item list-group-item-action status-filter-item d-flex justify-content-between align-items-center {{ !$currentStatus ? 'active' : '' }}">
                                    <span>
                                        <i class="mdi mdi-view-grid-outline me-2"></i>
                                        {{ __('general.all_statuses') }}
                                    </span>
                                    <span class="badge bg-secondary rounded-pill">{{ $totalDeliveries }}</span>
                                </a>

                                @foreach($statusCounts as $status => $count)
                                <a href="{{ route('driver.deliveries.index', ['status' => $status]) }}"
                                   class="list-group-item list-group-item-action status-filter-item d-flex justify-content-between align-items-center {{ $currentStatus == $status ? 'active' : '' }}">
                                    <span>
                                        <i class="mdi mdi-{{ $statusIcons[$status] }} me-2"></i>
                                        {{ __('delivery.status_' . $status) }}
                                    </span>
                                    <span class="badge bg-secondary rounded-pill">{{ $count }}</span>
                                </a>
                                @endforeach
                            </div>

                            @if(request()->hasAny(['keyword', 'status', 'package_id', 'date_from', 'date_to']))
                            <div class="p-3 border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{ __('general.filtered_results') }}:</small>
                                    <span class="badge bg-primary">{{ $deliveries->total() }}</span>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('driver.deliveries.index') }}" class="btn btn-sm btn-outline-primary w-100">
                                        <i class="mdi mdi-refresh me-1"></i>
                                        {{ __('general.reset_filters') }}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="col-lg-9">
        <!-- باقي المحتوى الرئيسي بدون تغيير -->
        <!-- ... نفس المحتوى السابق ... -->
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
        // إدارة الشريط الجانبي
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mainContent = document.getElementById('mainContent');

        if (sidebarToggle && mainContent) {
            // تحميل الحالة المحفوظة
            const sidebarState = localStorage.getItem('sidebarCollapsed');
            if (sidebarState === 'true') {
                mainContent.classList.add('sidebar-collapsed');
                sidebarToggle.innerHTML = '<i class="mdi mdi-chevron-right"></i>';
            }

            sidebarToggle.addEventListener('click', function() {
                mainContent.classList.toggle('sidebar-collapsed');

                if (mainContent.classList.contains('sidebar-collapsed')) {
                    this.innerHTML = '<i class="mdi mdi-chevron-right"></i>';
                    localStorage.setItem('sidebarCollapsed', 'true');
                } else {
                    this.innerHTML = '<i class="mdi mdi-menu"></i>';
                    localStorage.setItem('sidebarCollapsed', 'false');
                }
            });
        }

        // إدارة حالة الأكورديون
        function initAccordionState() {
            const quickActionsState = localStorage.getItem('quickActionsCollapsed');
            const statusFilterState = localStorage.getItem('statusFilterCollapsed');

            if (quickActionsState === 'true') {
                const quickActionsCollapse = document.getElementById('quickActionsCollapse');
                if (quickActionsCollapse) {
                    new bootstrap.Collapse(quickActionsCollapse, { toggle: false });
                }
            }

            if (statusFilterState === 'false') {
                const statusFilterCollapse = document.getElementById('statusFilterCollapse');
                if (statusFilterCollapse) {
                    new bootstrap.Collapse(statusFilterCollapse, { toggle: true });
                }
            }
        }

        function setupAccordionListeners() {
            const quickActionsCollapse = document.getElementById('quickActionsCollapse');
            const statusFilterCollapse = document.getElementById('statusFilterCollapse');

            if (quickActionsCollapse) {
                quickActionsCollapse.addEventListener('show.bs.collapse', function () {
                    localStorage.setItem('quickActionsCollapsed', 'false');
                });
                quickActionsCollapse.addEventListener('hide.bs.collapse', function () {
                    localStorage.setItem('quickActionsCollapsed', 'true');
                });
            }

            if (statusFilterCollapse) {
                statusFilterCollapse.addEventListener('show.bs.collapse', function () {
                    localStorage.setItem('statusFilterCollapsed', 'false');
                });
                statusFilterCollapse.addEventListener('hide.bs.collapse', function () {
                    localStorage.setItem('statusFilterCollapsed', 'true');
                });
            }
        }

        // تهيئة الخرائط والأدوات
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

        function initTooltips() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        // التهيئة
        initAccordionState();
        setupAccordionListeners();
        setTimeout(initMiniMaps, 1000);
        initTooltips();

        // باقي الدوال
        window.showRouteToDelivery = function(lat, lng, recipientName) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                    const googleMapsUrl = `https://www.google.com/maps/dir/${userLat},${userLng}/${lat},${lng}/`;
                    window.open(googleMapsUrl, '_blank');
                }, function(error) {
                    const googleMapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;
                    window.open(googleMapsUrl, '_blank');
                });
            } else {
                const googleMapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;
                window.open(googleMapsUrl, '_blank');
            }
        }

        window.showNearestDeliveries = function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    window.location.href = '{{ route("driver.deliveries.index") }}?sort=nearest&lat=' +
                                        position.coords.latitude + '&lng=' + position.coords.longitude;
                }, function(error) {
                    alert('{{ __("general.location_access_required") }}');
                });
            } else {
                alert('{{ __("general.location_not_supported") }}');
            }
        }

        // معالجة النماذج
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

        document.querySelectorAll('.status-update-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('button');
                button.disabled = true;
                button.innerHTML = '<i class="mdi mdi-loading mdi-spin me-2"></i> جاري التحديث...';
            });
        });

        const statusFilterItems = document.querySelectorAll('.status-filter-item');
        statusFilterItems.forEach(item => {
            item.addEventListener('click', function() {
                statusFilterItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
@endsection
