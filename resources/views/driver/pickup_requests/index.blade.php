@extends('layouts.driver')

@section('style')
<!-- مكتبة Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin=""/>

<style>
    :root {
        /* نظام ألوان موحد للحالات */
        --status-pending: #ffc107;
        --status-accepted: #17a2b8;
        --status-completed: #28a745;
        --status-cancelled: #dc3545;

        /* ألوان متدرجة للإحصائيات */
        --stat-total: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --stat-pending: linear-gradient(135deg, #ffc107 0%, #ff9f00 100%);
        --stat-accepted: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        --stat-completed: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        --stat-cancelled: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
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
    .stat-card.accepted { background: var(--stat-accepted); }
    .stat-card.completed { background: var(--stat-completed); }
    .stat-card.cancelled { background: var(--stat-cancelled); }

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
    .quick-action-btn.accepted::before { background: var(--status-accepted); }
    .quick-action-btn.today::before { background: var(--status-accepted); }
    .quick-action-btn.nearest::before { background: #6f42c1; }

    .quick-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-decoration: none;
    }

    .quick-action-btn.pending:hover {
        background: linear-gradient(135deg, var(--status-pending) 0%, #e0a800 100%);
        color: white;
        border-color: var(--status-pending);
    }

    .quick-action-btn.accepted:hover {
        background: linear-gradient(135deg, var(--status-accepted) 0%, #138496 100%);
        color: white;
        border-color: var(--status-accepted);
    }

    .quick-action-btn.today:hover {
        background: linear-gradient(135deg, var(--status-accepted) 0%, #138496 100%);
        color: white;
        border-color: var(--status-accepted);
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
    }

    .badge-pending {
        background: var(--status-pending);
        color: #212529;
        border-color: #e0a800;
    }

    .badge-accepted {
        background: var(--status-accepted);
        color: white;
        border-color: #138496;
    }

    .badge-completed {
        background: var(--status-completed);
        color: white;
        border-color: #1e7e34;
    }

    .badge-cancelled {
        background: var(--status-cancelled);
        color: white;
        border-color: #c82333;
    }

    /* أزرار الإجراءات متناسقة */
    .btn-status-pending {
        background: var(--status-pending);
        border-color: var(--status-pending);
        color: #212529;
    }

    .btn-status-accepted {
        background: var(--status-accepted);
        border-color: var(--status-accepted);
        color: white;
    }

    .btn-status-completed {
        background: var(--status-completed);
        border-color: var(--status-completed);
        color: white;
    }

    .btn-status-cancelled {
        background: var(--status-cancelled);
        border-color: var(--status-cancelled);
        color: white;
    }

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

    .merchant-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e9ecef;
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

    /* إضافة جديدة للإحصائيات */
    .stat-badge {
        font-size: 0.75rem;
        padding: 4px 8px;
    }

    /* أيقونات متناسقة */
    .status-icon {
        font-size: 1.1em;
        margin-right: 6px;
    }
</style>
@endsection

@section('content')

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card total">
                <div class="number">{{ $totalRequests }}</div>
                <div class="label">{{ __('pickup_request.total_requests') }}</div>
                <i class="mdi mdi-package-variant fs-2 opacity-50 mt-2"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card pending">
                <div class="number">{{ $pendingRequests }}</div>
                <div class="label">{{ __('pickup_request.pending_requests') }}</div>
                <i class="mdi mdi-clock-outline fs-2 opacity-50 mt-2"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card accepted">
                <div class="number">{{ $acceptedRequests }}</div>
                <div class="label">{{ __('pickup_request.accepted_requests') }}</div>
                <i class="mdi mdi-truck-check fs-2 opacity-50 mt-2"></i>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card completed">
                <div class="number">{{ $completedRequests }}</div>
                <div class="label">{{ __('pickup_request.completed_requests') }}</div>
                <i class="mdi mdi-check-circle fs-2 opacity-50 mt-2"></i>
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
                    <a href="{{ route('driver.pickup_requests.index', ['status' => 'pending']) }}"
                       class="quick-action-btn pending">
                        <i class="mdi mdi-clock-outline me-2"></i>
                        <div>{{ __('pickup_request.view_pending') }}</div>
                        <small class="opacity-75">{{ $pendingRequests }} {{ __('general.requests') }}</small>
                    </a>

                    <a href="{{ route('driver.pickup_requests.index', ['status' => 'accepted']) }}"
                       class="quick-action-btn accepted">
                        <i class="mdi mdi-truck-check me-2"></i>
                        <div>{{ __('pickup_request.view_accepted') }}</div>
                        <small class="opacity-75">{{ $acceptedRequests }} {{ __('general.requests') }}</small>
                    </a>

                    <a href="{{ route('driver.pickup_requests.index', ['status' => 'today']) }}"
                       class="quick-action-btn today">
                        <i class="mdi mdi-calendar-today me-2"></i>
                        <div>{{ __('pickup_request.today_requests') }}</div>
                        <small class="opacity-75">{{ $todayRequests }} {{ __('pickup_request.scheduled_today') }}</small>
                    </a>

                    <a href="#" class="quick-action-btn nearest" onclick="showNearestRequests()">
                        <i class="mdi mdi-map-marker-distance me-2"></i>
                        <div>{{ __('pickup_request.nearest_requests') }}</div>
                        <small class="opacity-75">{{ __('pickup_request.by_distance') }}</small>
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
                            'pending' => $pendingRequests,
                            'accepted' => $acceptedRequests,
                            'completed' => $completedRequests,
                            'cancelled' => $cancelledRequests
                        ];

                        $statusIcons = [
                            'pending' => 'clock-outline',
                            'accepted' => 'truck-check',
                            'completed' => 'check-circle',
                            'cancelled' => 'cancel'
                        ];
                    @endphp

                    @foreach(['pending', 'accepted', 'completed', 'cancelled'] as $status)
                    <a href="{{ route('driver.pickup_requests.index', ['status' => $status]) }}"
                       class="d-flex justify-content-between align-items-center p-2 rounded mb-2
                              {{ request('status') == $status ? 'bg-primary text-white' : 'bg-light' }}">
                        <span>
                            <i class="mdi mdi-{{ $statusIcons[$status] }} status-icon text-{{ $status == 'pending' ? 'warning' : ($status == 'accepted' ? 'info' : ($status == 'completed' ? 'success' : 'danger')) }}"></i>
                            {{ __('pickup_request.status_' . $status) }}
                        </span>
                        <span class="badge bg-secondary rounded-pill stat-badge">{{ $statusCounts[$status] }}</span>
                    </a>
                    @endforeach

                    <!-- إضافة إجمالي المصفى -->
                    @if(request()->hasAny(['keyword', 'status', 'driver_id', 'merchant_id', 'date_type']))
                    <div class="mt-3 pt-3 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ __('general.filtered_results') }}:</small>
                            <span class="badge bg-primary stat-badge">{{ $pickupRequests->total() }}</span>
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
                                <i class="mdi mdi-truck me-2 text-primary"></i>
                                {{ __('pickup_request.manage_pickup_requests') }}
                            </h4>
                            <p class="card-title-desc text-muted mb-0">
                                {{ __('pickup_request.pickup_requests_description') }}

                                <!-- إضافة مؤشر البحث -->
                                @if(request()->hasAny(['keyword', 'status', 'driver_id', 'merchant_id', 'date_type']))
                                <span class="badge bg-info ms-2">
                                    <i class="mdi mdi-filter me-1"></i>
                                    {{ __('general.filter_applied') }} ({{ $pickupRequests->total() }})
                                </span>
                                @endif
                            </p>
                        </div>

                        <div class="button-items">
                            <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filtersSection">
                                <i class="mdi mdi-filter-outline me-1"></i>
                                {{ __('general.filters') }}
                                @if(request()->hasAny(['keyword', 'status', 'driver_id', 'merchant_id', 'date_type']))
                                <span class="badge bg-white text-primary ms-1">{{ $pickupRequests->total() }}</span>
                                @endif
                            </button>
                        </div>
                    </div>

                    <!-- Filters Section -->
                    <div class="collapse mb-4" id="filtersSection">
                        @include('driver.pickup_requests.filter.filter')
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="60">#</th>
                                    <th width="80">{{ __('general.merchant') }}</th>
                                    <th>{{ __('pickup_request.pickup_address') }}</th>
                                    <th width="120">{{ __('pickup_request.scheduled_at') }}</th>
                                    <th width="120">{{ __('pickup_request.status') }}</th>
                                    <th width="100">{{ __('general.actions') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($pickupRequests as $request)
                                    <tr>
                                        <td class="fw-bold text-primary">#{{ $request->id }}</td>

                                        <!-- Merchant Information -->
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($request->merchant->image)
                                                <img src="{{ asset('storage/' . $request->merchant->image) }}"
                                                     alt="{{ $request->merchant->name }}"
                                                     class="merchant-avatar me-3">
                                                @else
                                                <div class="merchant-avatar bg-primary text-white d-flex align-items-center justify-content-center me-3">
                                                    <i class="mdi mdi-store"></i>
                                                </div>
                                                @endif
                                                <div>
                                                    <strong class="d-block">{{ Str::limit($request->merchant->name, 15) }}</strong>
                                                    <small class="text-muted">{{ $request->merchant->contact_person ?? '' }}</small>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Location Information -->
                                        <td>
                                            <div class="location-info">
                                                <strong class="d-block">
                                                    <i class="mdi mdi-map-marker-outline me-1 text-danger"></i>
                                                    {{ $request->city }}, {{ $request->district }}
                                                </strong>
                                                <small class="text-muted">
                                                    {{ $request->region }}, {{ $request->country }}
                                                </small>

                                                @if($request->hasValidCoordinates())
                                                <div class="map-mini"
                                                     id="mini-map-{{ $request->id }}"
                                                     data-lat="{{ $request->latitude }}"
                                                     data-lng="{{ $request->longitude }}">
                                                </div>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Schedule Information -->
                                        <td>
                                            <div class="schedule-info text-center">
                                                @if($request->scheduled_at)
                                                <strong class="d-block text-primary">
                                                    {{ $request->scheduled_at->format('d M') }}
                                                </strong>
                                                <small class="text-muted">
                                                    {{ $request->scheduled_at->format('H:i') }}
                                                </small>
                                                <div class="mt-1">
                                                    @if($request->scheduled_at->isToday())
                                                    <span class="badge bg-success badge-sm">{{ __('general.today') }}</span>
                                                    @elseif($request->scheduled_at->isTomorrow())
                                                    <span class="badge bg-info badge-sm">{{ __('general.tomorrow') }}</span>
                                                    @endif
                                                </div>
                                                @else
                                                <span class="text-muted">-</span>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Status Information -->
                                        <td>
                                            <div class="status-info">
                                                @php
                                                    $statusClasses = [
                                                        'pending' => 'badge-pending',
                                                        'accepted' => 'badge-accepted',
                                                        'completed' => 'badge-completed',
                                                        'cancelled' => 'badge-cancelled'
                                                    ];

                                                    $statusIcons = [
                                                        'pending' => 'clock-outline',
                                                        'accepted' => 'truck-check',
                                                        'completed' => 'check-circle',
                                                        'cancelled' => 'cancel'
                                                    ];
                                                @endphp

                                                <span class="status-badge {{ $statusClasses[$request->status] }} d-flex align-items-center">
                                                    <i class="mdi mdi-{{ $statusIcons[$request->status] }} me-1"></i>
                                                    {{ __('pickup_request.status_' . $request->status) }}
                                                </span>

                                                @if($request->status == 'completed' && $request->completed_at)
                                                <small class="text-muted d-block mt-1">
                                                    {{ $request->completed_at->diffForHumans() }}
                                                </small>
                                                @elseif($request->status == 'accepted' && $request->accepted_at)
                                                <small class="text-muted d-block mt-1">
                                                    {{ $request->accepted_at->diffForHumans() }}
                                                </small>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- Actions -->
                                        <td>
                                            <div class="action-dropdown">
                                                <div class="btn-group">
                                                    <a href="{{ route('driver.pickup_requests.show', $request->id) }}"
                                                       class="btn btn-sm btn-outline-primary"
                                                       data-bs-toggle="tooltip"
                                                       title="{{ __('general.view_details') }}">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>

                                                    @if($request->availableStatusesForDriver())
                                                        <button type="button"
                                                                class="btn btn-sm btn-outline-warning dropdown-toggle dropdown-toggle-split"
                                                                data-bs-toggle="dropdown"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ __('general.update_status') }}">
                                                            <i class="mdi mdi-update"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            @foreach($request->availableStatusesForDriver() as $status)
                                                            <li>
                                                                <form action="{{ route('driver.pickup_requests.update_status', $request->id) }}"
                                                                    method="POST" class="d-inline status-update-form">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="status" value="{{ $status }}">
                                                                    <button type="submit" class="dropdown-item status-update-btn"
                                                                            data-status="{{ $status }}"
                                                                            data-request-id="{{ $request->id }}">
                                                                        <i class="mdi mdi-{{ $statusIcons[$status] }} me-2"
                                                                           style="color: var(--status-{{ $status }})"></i>
                                                                        {{ __('pickup_request.mark_as') }} {{ __('pickup_request.status_' . $status) }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>

                                                <div class="btn-group">
                                                    @if($request->hasValidCoordinates())
                                                        <a href="#"
                                                        class="btn btn-sm btn-outline-success mt-1"
                                                        onclick="showRouteToPickup({{ $request->latitude }}, {{ $request->longitude }}, '{{ $request->merchant->name }}')"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ __('general.view_route') }}">
                                                            <i class="mdi mdi-map-marker-path"></i>
                                                        </a>
                                                    @endif

                                                    @ability('driver', 'update_pickup_requests')
                                                     <a href="{{ route('driver.pickup_requests.edit', $request->id) }}"
                                                                class="btn btn-sm btn-outline-warning dropdown-toggle dropdown-toggle-split mt-1"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ __('general.update_status') }}">
                                                            <i class="mdi mdi-square-edit-outline"></i>
                                                    </a>
                                                    @endability
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="mdi mdi-truck-remove-outline fs-1 text-muted"></i>
                                                <h5 class="mt-3">{{ __('pickup_request.no_requests_found') }}</h5>
                                                <p class="text-muted">{{ __('pickup_request.no_requests_description') }}</p>
                                                <a href="{{ route('driver.pickup_requests.index') }}" class="btn btn-primary">
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
                    @if($pickupRequests->hasPages())
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    {{ __('general.showing') }} {{ $pickupRequests->firstItem() }} - {{ $pickupRequests->lastItem() }}
                                    {{ __('general.of') }} {{ $pickupRequests->total() }}
                                    {{ __('general.records') }}

                                    @if(request()->hasAny(['keyword', 'status', 'driver_id', 'merchant_id', 'date_type']))
                                    <span class="badge bg-info ms-2">
                                        <i class="mdi mdi-filter me-1"></i>
                                        {{ __('general.filtered') }}
                                    </span>
                                    @endif
                                </div>
                                <div>
                                    {{ $pickupRequests->links() }}
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
        // Initialize mini maps
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
                        .bindPopup('{{ __("pickup_request.pickup_location") }}');
                }
            });
        }

        // Show route to pickup location
        window.showRouteToPickup = function(lat, lng, merchantName) {
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

        // Show nearest requests
        window.showNearestRequests = function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Redirect to nearest requests page or filter
                    window.location.href = '{{ route("driver.pickup_requests.index") }}?sort=distance&lat=' +
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
                const requestId = this.getAttribute('data-request-id');
                const statusText = this.textContent.trim();

                if (!confirm(`هل أنت متأكد من تغيير حالة الطلب #${requestId} إلى "${statusText}"؟`)) {
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
