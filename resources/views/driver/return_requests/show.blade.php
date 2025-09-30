@extends('layouts.driver')

@section('style')
<!-- مكتبة Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin=""/>

<!-- مكتبة Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
        border: none;
        transition: all 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }
    .card-header {
        background: linear-gradient(135deg, #4a6fdc 0%, #3a5fc8 100%);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        padding: 20px 25px;
        font-weight: 600;
        border: none;
    }
    .info-label {
        font-weight: 600;
        color: #555;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    .info-value {
        color: #333;
        margin-bottom: 20px;
        font-size: 1rem;
        font-weight: 500;
    }
    .map-container {
        height: 280px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        border: 2px solid #e9ecef;
    }
    .map-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #6c757d;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        font-size: 0.9rem;
    }
    .map-container .leaflet-container {
        height: 100%;
        width: 100%;
    }
    .section-title {
        border-bottom: 3px solid #4a6fdc;
        padding-bottom: 12px;
        margin: 30px 0 20px;
        color: #4a6fdc;
        font-size: 1.2rem;
        font-weight: 700;
    }
    .coordinates {
        font-family: 'Courier New', monospace;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        border: 1px solid #dee2e6;
    }
    .status-timeline {
        position: relative;
        padding-left: 30px;
    }
    .status-timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #4a6fdc, #6c757d);
    }
    .timeline-item {
        position: relative;
        margin-bottom: 25px;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -23px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #4a6fdc;
        border: 3px solid white;
        box-shadow: 0 0 0 2px #4a6fdc;
    }
    .timeline-item.active::before {
        background: #28a745;
        box-shadow: 0 0 0 2px #28a745;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .stat-card .number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .stat-card .label {
        font-size: 1rem;
        opacity: 0.9;
    }
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
        margin-bottom: 15px;
    }
    .quick-action-btn:hover {
        background: linear-gradient(135deg, #4a6fdc 0%, #3a5fc8 100%);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(74, 111, 220, 0.3);
        text-decoration: none;
    }
    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e9ecef;
    }
    .badge-status {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .progress-container {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        margin: 20px 0;
    }
    .progress-bar-custom {
        height: 8px;
        border-radius: 10px;
        background: linear-gradient(90deg, #28a745, #4a6fdc);
        transition: width 1s ease-in-out;
    }

    .nav-link {
        color: #495057;
        font-weight: 600;
        padding: 10px 15px;
        border-radius: 10px;
        transition: background-color 0.3s ease;
    }

    .nav-link:hover, .nav-link:focus {
        background-color: #e9ecef;
        border-radius: 10px;
        transition: background-color 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between bg-white p-4 rounded-3 shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="avatar-lg bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                        <i class="mdi mdi-truck-return fs-2 text-white"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 fw-bold">{{ __('return_request.view_return_request') }}</h4>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-clock-outline me-1"></i>
                            {{ __('return_request.created_at') }}: {{ $return_request->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="btn-group">
                        <a href="{{ route('driver.return_requests.edit', $return_request->id) }}" class="btn btn-primary">
                            <i class="mdi mdi-pencil-outline me-1"></i> {{ __('return_request.edit') }}
                        </a>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                            <i class="mdi mdi-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-printer-outline me-2"></i> {{ __('general.print') }}
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-download-outline me-2"></i> {{ __('general.export') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-warning" href="#">
                                <i class="mdi mdi-alert-outline me-2"></i> {{ __('general.report_issue') }}
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('driver.return_requests.index') }}" class="btn btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> {{ __('return_request.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="number">{{ $return_request->returnItems->count() }}</div>
                <div class="label">{{ __('return_request.total_items') }}</div>
                <i class="mdi mdi-package-variant-closed fs-1 opacity-50 mt-2"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <div class="number">{{ $return_request->returnItems->where('type', 'stock')->count() }}</div>
                <div class="label">{{ __('return_request.stock_items') }}</div>
                <i class="mdi mdi-warehouse fs-1 opacity-50 mt-2"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                <div class="number">{{ $return_request->returnItems->where('type', 'custom')->count() }}</div>
                <div class="label">{{ __('return_request.custom_items') }}</div>
                <i class="mdi mdi-package-variant fs-1 opacity-50 mt-2"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card" style="background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%);">
                <div class="number">{{ $return_request->returnItems->sum('quantity') }}</div>
                <div class="label">{{ __('return_request.total_quantity') }}</div>
                <i class="mdi mdi-counter fs-1 opacity-50 mt-2"></i>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Sidebar - Quick Actions & Status -->
        <div class="col-lg-4">
            <!-- Status Timeline -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-timeline-outline me-2"></i>
                        {{ __('return_request.status_timeline') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="status-timeline">
                        @php
                            $statuses = [
                                'requested' => ['icon' => 'clock-outline', 'color' => 'success'],
                                'assigned_to_driver' => ['icon' => 'account-tie', 'color' => 'info'],
                                'picked_up' => ['icon' => 'package-variant', 'color' => 'warning'],
                                'in_transit' => ['icon' => 'truck-delivery', 'color' => 'warning'],
                                'received' => ['icon' => 'check-circle', 'color' => 'primary'],
                                'partially_received' => ['icon' => 'alert-circle', 'color' => 'info'],
                                'rejected' => ['icon' => 'close-circle', 'color' => 'danger'],
                                'cancelled' => ['icon' => 'cancel', 'color' => 'danger'],
                            ];
                            $currentStatus = $return_request->status;
                        @endphp

                        @foreach($statuses as $status => $info)
                            <div class="timeline-item {{ $status == $currentStatus ? 'active' : '' }}">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-semibold">{{ __('return_request.status_' . $status) }}</h6>
                                        @if($status == 'requested' && $return_request->requested_at)
                                            <small class="text-muted">{{ $return_request->requested_at->format('d M Y, H:i') }}</small>
                                        @elseif($status == 'received' && $return_request->received_at)
                                            <small class="text-muted">{{ $return_request->received_at->format('d M Y, H:i') }}</small>
                                        @endif
                                    </div>
                                    <i class="mdi mdi-{{ $info['icon'] }} text-{{ $info['color'] }} fs-5"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-lightning-bolt-outline me-2"></i>
                        {{ __('general.quick_actions') }}
                    </h5>
                </div>
                <div class="card-body">
                    <a href="tel:{{ $return_request->package->receiver_phone ?? '#' }}" class="quick-action-btn">
                        <i class="mdi mdi-phone-outline me-2 fs-4"></i>
                        <div>{{ __('general.contact_customer') }}</div>
                        <small class="opacity-75">{{ $return_request->package->receiver_phone ?? '-' }}</small>
                    </a>

                    <a href="#" class="quick-action-btn" onclick="showRoute()">
                        <i class="mdi mdi-map-marker-path me-2 fs-4"></i>
                        <div>{{ __('general.view_route') }}</div>
                        <small class="opacity-75">{{ __('general.optimized_path') }}</small>
                    </a>

                    <a href="#" class="quick-action-btn" onclick="shareLocation()">
                        <i class="mdi mdi-share-variant me-2 fs-4"></i>
                        <div>{{ __('general.share_location') }}</div>
                        <small class="opacity-75">{{ __('general.with_customer') }}</small>
                    </a>

                    <a href="{{ route('driver.return_requests.edit', $return_request->id) }}" class="quick-action-btn">
                        <i class="mdi mdi-update me-2 fs-4"></i>
                        <div>{{ __('general.update_status') }}</div>
                        <small class="opacity-75">{{ __('general.change_progress') }}</small>
                    </a>
                </div>
            </div>

            <!-- Progress Chart -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-chart-bar me-2"></i>
                        {{ __('return_request.progress_overview') }}
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="progressChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Return Request Summary -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0 fw-semibold">
                                <i class="mdi mdi-information-outline me-2"></i>
                                {{ __('return_request.return_request_summary') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <span class="info-label">{{ __('return_request.id') }}</span>
                                            <span class="info-value fw-bold text-primary">#{{ $return_request->id }}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">{{ __('return_request.package') }}</span>
                                            <span class="info-value">
                                                @if($return_request->package)
                                                    <span class="badge bg-light text-dark fs-6">{{ $return_request->package->tracking_number }}</span>
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">{{ __('return_request.driver') }}</span>
                                            <span class="info-value">
                                                @if($return_request->driver)
                                                    <i class="mdi mdi-account-tie-outline me-2"></i>
                                                    {{ $return_request->driver->driver_full_name }}
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <span class="info-label">{{ __('return_request.return_type') }}</span>
                                            <span class="info-value">
                                                <span class="badge bg-info badge-status">
                                                    {{ __('return_request.type_' . ($return_request->return_type ?? 'unknown')) }}
                                                </span>
                                            </span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">{{ __('return_request.status') }}</span>
                                            <span class="info-value">{!! $return_request->statusLabel() !!}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">{{ __('return_request.target_address') }}</span>
                                            <span class="info-value">{{ $return_request->target_address ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($return_request->reason)
                            <div class="alert alert-info mt-3">
                                <i class="mdi mdi-information-outline me-2"></i>
                                <strong>{{ __('return_request.reason') }}:</strong> {{ $return_request->reason }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Package Information with Maps -->
            @if($return_request->package)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-package-variant me-2"></i>
                        {{ __('package.package_details') }} - {{ $return_request->package->tracking_number }}
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Maps Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-info text-white py-2">
                                    <i class="mdi mdi-account-outline me-2"></i>
                                    {{ __('package.sender_location') }}
                                </div>
                                <div class="card-body">
                                    <div id="sender-map-{{ $return_request->package->id }}" class="map-container"
                                         data-lat="{{ $return_request->package->sender_latitude }}"
                                         data-lng="{{ $return_request->package->sender_longitude }}">
                                        <div class="map-placeholder">
                                            <i class="mdi mdi-map-marker-outline me-2"></i>
                                            {{ __('package.loading_map') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-success text-white py-2">
                                    <i class="mdi mdi-account-check-outline me-2"></i>
                                    {{ __('package.receiver_location') }}
                                </div>
                                <div class="card-body">
                                    <div id="receiver-map-{{ $return_request->package->id }}" class="map-container"
                                         data-lat="{{ $return_request->package->receiver_latitude }}"
                                         data-lng="{{ $return_request->package->receiver_longitude }}">
                                        <div class="map-placeholder">
                                            <i class="mdi mdi-map-marker-outline me-2"></i>
                                            {{ __('package.loading_map') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Package Details in Tabs -->
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="packageTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="sender-tab" data-bs-toggle="tab" data-bs-target="#sender" type="button">
                                        <i class="mdi mdi-account-outline me-2"></i> {{ __('package.sender_info') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="receiver-tab" data-bs-toggle="tab" data-bs-target="#receiver" type="button">
                                        <i class="mdi mdi-account-check-outline me-2"></i> {{ __('package.receiver_info') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button">
                                        <i class="mdi mdi-information-outline me-2"></i> {{ __('package.specifications') }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="packageTabsContent">
                                <!-- Sender Tab -->
                                <div class="tab-pane fade show active" id="sender" role="tabpanel">
                                    @include('driver.return_requests.partials.sender-info', ['package' => $return_request->package])
                                </div>

                                <!-- Receiver Tab -->
                                <div class="tab-pane fade" id="receiver" role="tabpanel">
                                    @include('driver.return_requests.partials.receiver-info', ['package' => $return_request->package])
                                </div>

                                <!-- Specifications Tab -->
                                <div class="tab-pane fade" id="specs" role="tabpanel">
                                    @include('driver.return_requests.partials.package-specs', ['package' => $return_request->package])
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Return Items Section -->
            @if($return_request->returnItems && $return_request->returnItems->count())
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-package-variant-closed me-2"></i>
                        {{ __('return_request.return_items') }} ({{ $return_request->returnItems->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">#</th>
                                    <th width="80">{{ __('product.image') }}</th>
                                    <th>{{ __('product.product_name') }}</th>
                                    <th width="100">{{ __('product.type') }}</th>
                                    <th width="100">{{ __('product.quantity') }}</th>
                                    <th width="150">{{ __('warehouse.warehouse') }}</th>
                                    <th width="120">{{ __('general.status') }}</th>
                                    <th width="100">{{ __('general.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($return_request->returnItems as $index => $item)
                                <tr>
                                    <td class="fw-semibold">{{ $index + 1 }}</td>
                                    <td>
                                        @if($item->type == 'stock' && $item->stockItem && $item->stockItem->product && $item->stockItem->product->image)
                                            <img src="{{ asset('storage/' . $item->stockItem->product->image) }}"
                                                 alt="{{ $item->custom_name ?? $item->stockItem->product->name }}"
                                                 class="product-image">
                                        @else
                                            <div class="product-image bg-light d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-package-variant text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong class="d-block">{{ $item->custom_name ?? ($item->stockItem->product->name ?? 'N/A') }}</strong>
                                        @if($item->note)
                                            <small class="text-muted">{{ Str::limit($item->note, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $item->type == 'stock' ? 'success' : 'info' }} badge-status">
                                            {{ __('product.' . $item->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary rounded-pill fs-6">
                                            {{ $item->quantity }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($item->type == 'stock' && $item->stockItem && $item->stockItem->rentalShelf && $item->stockItem->rentalShelf->shelf && $item->stockItem->rentalShelf->shelf->warehouse)
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-warehouse me-2 text-warning"></i>
                                                <div>
                                                    <div class="fw-semibold">{{ $item->stockItem->rentalShelf->shelf->warehouse->name }}</div>
                                                    <small class="text-muted">{{ $item->stockItem->rentalShelf->shelf->name }}</small>
                                                </div>
                                            </div>
                                        @else
                                            <span class="badge bg-light text-dark">
                                                {{ __('general.not_applicable') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{!! $return_request->statusLabel() !!}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" data-bs-toggle="tooltip" title="{{ __('general.view_details') }}">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info" data-bs-toggle="tooltip" title="{{ __('general.scan_qr') }}">
                                                <i class="mdi mdi-qrcode-scan"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
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
    // Initialize maps
    function initMaps() {
        const mapContainers = document.querySelectorAll('.map-container');

        mapContainers.forEach(container => {
            const lat = parseFloat(container.getAttribute('data-lat'));
            const lng = parseFloat(container.getAttribute('data-lng'));
            const mapId = container.id;

            if (container.hasAttribute('data-initialized')) return;

            if (!isNaN(lat) && !isNaN(lng)) {
                container.innerHTML = '';
                const map = L.map(mapId).setView([lat, lng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                const marker = L.marker([lat, lng]).addTo(map);

                if (mapId.includes('sender-map')) {
                    marker.bindPopup('{{ __("package.sender_location") }}').openPopup();
                } else if (mapId.includes('receiver-map')) {
                    marker.bindPopup('{{ __("package.receiver_location") }}').openPopup();
                }

                container.setAttribute('data-initialized', 'true');
            } else {
                container.innerHTML = `
                    <div class="map-placeholder">
                        <i class="mdi mdi-exclamation-thick me-2"></i>
                        {{ __("package.no_location_data") }}
                    </div>
                `;
                container.setAttribute('data-initialized', 'true');
            }
        });
    }

    // Initialize progress chart
    function initProgressChart() {
        const ctx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    '{{ __("return_request.completed") }}',
                    '{{ __("return_request.in_progress") }}',
                    '{{ __("return_request.pending") }}'
                ],
                datasets: [{
                    data: [60, 25, 15],
                    backgroundColor: [
                        '#28a745',
                        '#ffc107',
                        '#6c757d'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                },
                cutout: '70%'
            }
        });
    }

    // Initialize tooltips
    function initTooltips() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Quick action functions
    function showRoute() {
        alert('{{ __("general.route_feature_coming_soon") }}');
    }

    function shareLocation() {
        if (navigator.share) {
            navigator.share({
                title: '{{ __("return_request.return_location") }}',
                text: '{{ __("return_request.share_location_message") }}',
                url: window.location.href
            });
        } else {
            alert('{{ __("general.share_not_supported") }}');
        }
    }

    // Initialize everything
    setTimeout(initMaps, 500);
    initProgressChart();
    initTooltips();

    // Handle window resize
    window.addEventListener('resize', function() {
        document.querySelectorAll('.map-container[data-initialized="true"]').forEach(container => {
            const map = L.map(container.id);
            if (map) {
                setTimeout(() => map.invalidateSize(), 100);
            }
        });
    });
});
</script>
@endsection
