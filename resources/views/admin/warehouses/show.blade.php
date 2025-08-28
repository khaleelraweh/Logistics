@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('warehouse.view_warehouse') }}</h4>
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.warehouses.index') }}">{{ __('warehouse.warehouses') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('warehouse.view_warehouse') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <!-- Header Card -->
            <div class="card-header bg-primary text-white py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="avatar-lg me-3">
                            <i class="fas fa-warehouse fa-3x text-white"></i>
                        </div>
                        <div>
                            <h3 class="card-title mb-1 text-white">{{ $warehouse->name }}</h3>
                            <p class="card-subtitle mb-0 text-white-50">
                                <span class="badge bg-light text-dark me-2">{{ $warehouse->code }}</span>
                                <span class="badge bg-{{ $warehouse->status ? 'success' : 'secondary' }}">
                                    {{ $warehouse->status ? __('general.active') : __('general.inactive') }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="action-buttons">
                        @ability('admin', 'update_warehouses')
                        <a href="{{ route('admin.warehouses.edit', $warehouse->id) }}" class="btn btn-light me-2">
                            <i class="fas fa-edit me-1"></i> {{ __('general.update') }}
                        </a>
                        @endability
                        <a href="{{ route('admin.warehouses.index') }}" class="btn btn-outline-light">
                            <i class="fas fa-arrow-left me-1"></i> {{ __('general.back') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Quick Stats Row -->
                <div class="row mb-5">
                    <div class="col-md-3 col-6">
                        <div class="stats-card">
                            <div class="stats-icon bg-primary">
                                <i class="fas fa-boxes"></i>
                            </div>
                            <div class="stats-info">
                                <h4>{{ $warehouse->shelves->count() }}</h4>
                                <p>{{ __('shelf.shelves') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stats-card">
                            <div class="stats-icon bg-success">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <div class="stats-info">
                                <h4>{{ $rentals->count() }}</h4>
                                <p>{{ __('warehouse.rentals') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stats-card">
                            <div class="stats-icon bg-info">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stats-info">
                                <h4>{{ $warehouse->shelves->where('status', true)->count() }}</h4>
                                <p>{{ __('general.active_shelves') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stats-card">
                            <div class="stats-icon bg-warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stats-info">
                                <h4>{{ $rentals->where('status', true)->count() }}</h4>
                                <p>{{ __('general.active_rentals') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Tabs -->
                <div class="row">
                    <div class="col-lg-4">
                        <!-- Warehouse Info Card -->
                        <div class="card info-card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-info-circle me-2 text-primary"></i>
                                    {{ __('warehouse.warehouse_info') }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="info-item">
                                    <div class="info-icon text-primary">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>{{ __('warehouse.manager') }}</h6>
                                        <p>{{ $warehouse->manager }}</p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon text-success">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>{{ __('general.phone') }}</h6>
                                        <p>{{ $warehouse->phone ?? __('general.not_specified') }}</p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon text-info">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>{{ __('general.email') }}</h6>
                                        <p>{{ $warehouse->email ?? __('general.not_specified') }}</p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon text-warning">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>{{ __('general.location') }}</h6>
                                        @if($warehouse->latitude && $warehouse->longitude)
                                            <div id="miniMap" class="mt-2"></div>
                                            <small class="text-muted mt-1 d-block">
                                                {{ $warehouse->latitude }}, {{ $warehouse->longitude }}
                                            </small>
                                        @else
                                            <p class="text-muted mb-0">{{ $warehouse->location ?? __('general.no_location_data') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Timeline -->
                        <div class="card timeline-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-history me-2 text-secondary"></i>
                                    {{ __('general.history') }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-point"></div>
                                        <div class="timeline-content">
                                            <h6>{{ __('general.created_at') }}</h6>
                                            <p>{{ $warehouse->created_at->format('Y-m-d H:i') }}</p>
                                            <span class="text-muted">{{ __('general.by') }}: {{ $warehouse->created_by ?? __('general.system') }}</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-point"></div>
                                        <div class="timeline-content">
                                            <h6>{{ __('general.last_updated') }}</h6>
                                            <p>{{ $warehouse->updated_at->format('Y-m-d H:i') }}</p>
                                            <span class="text-muted">{{ __('general.by') }}: {{ $warehouse->updated_by ?? __('general.system') }}</span>
                                        </div>
                                    </div>
                                    @if($warehouse->published_on)
                                    <div class="timeline-item">
                                        <div class="timeline-point"></div>
                                        <div class="timeline-content">
                                            <h6>{{ __('general.published_on') }}</h6>
                                            <p>{{ $warehouse->published_on->format('Y-m-d H:i') }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <!-- Tabs Navigation -->
                        <div class="card">
                            <div class="card-header border-0">
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#shelves-tab">
                                            <i class="fas fa-boxes me-2"></i>
                                            {{ __('shelf.shelves') }}
                                            <span class="badge bg-primary ms-2">{{ $warehouse->shelves->count() }}</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#rentals-tab">
                                            <i class="fas fa-file-contract me-2"></i>
                                            {{ __('warehouse.rentals') }}
                                            <span class="badge bg-success ms-2">{{ $rentals->count() }}</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#details-tab">
                                            <i class="fas fa-chart-bar me-2"></i>
                                            {{ __('general.statistics') }}
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- Shelves Tab -->
                                    <div class="tab-pane fade show active" id="shelves-tab">
                                        @if($warehouse->shelves->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('shelf.code') }}</th>
                                                        <th>{{ __('general.status') }}</th>
                                                        <th>{{ __('general.capacity') }}</th>
                                                        <th class="text-end">{{ __('general.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($warehouse->shelves as $shelf)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-box text-primary me-2"></i>
                                                                <strong>{{ $shelf->code }}</strong>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-{{ $shelf->status ? 'success' : 'secondary' }}">
                                                                {{ $shelf->status ? __('general.active') : __('general.inactive') }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="progress" style="height: 8px;">
                                                                <div class="progress-bar bg-{{ $shelf->status ? 'success' : 'secondary' }}"
                                                                     style="width: {{ rand(30, 90) }}%"></div>
                                                            </div>
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="{{ route('admin.shelves.show', $shelf->id) }}"
                                                               class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                                {{ __('general.view') }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <div class="text-center py-5">
                                            <i class="fas fa-boxes fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">{{ __('shelf.no_shelves_found') }}</h5>
                                            <p class="text-muted">{{ __('shelf.add_shelves_to_warehouse') }}</p>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Rentals Tab -->
                                    <div class="tab-pane fade" id="rentals-tab">
                                        @if($rentals->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('general.merchant') }}</th>
                                                        <th>{{ __('general.period') }}</th>
                                                        <th>{{ __('general.status') }}</th>
                                                        <th class="text-end">{{ __('general.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($rentals as $rental)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-user-tie text-info me-2"></i>
                                                                <strong>{{ $rental->merchant->name ?? __('general.deleted') }}</strong>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <small class="text-muted d-block">{{ $rental->rental_start->format('Y-m-d') }}</small>
                                                            <small class="text-muted d-block">{{ $rental->rental_end->format('Y-m-d') }}</small>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-{{ $rental->status ? 'success' : 'danger' }}">
                                                                {{ $rental->status ? __('general.active') : __('general.expired') }}
                                                            </span>
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                                {{ __('general.view') }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <div class="text-center py-5">
                                            <i class="fas fa-file-contract fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">{{ __('warehouse.no_rentals_found') }}</h5>
                                            <p class="text-muted">{{ __('warehouse.no_active_rentals') }}</p>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Statistics Tab -->
                                    <div class="tab-pane fade" id="details-tab">
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="card bg-light">
                                                    <div class="card-body text-center">
                                                        <i class="fas fa-boxes fa-2x text-primary mb-3"></i>
                                                        <h3 class="text-primary">{{ $warehouse->shelves->count() }}</h3>
                                                        <p class="text-muted mb-0">{{ __('shelf.total_shelves') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="card bg-light">
                                                    <div class="card-body text-center">
                                                        <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                                                        <h3 class="text-success">{{ $warehouse->shelves->where('status', true)->count() }}</h3>
                                                        <p class="text-muted mb-0">{{ __('general.active_shelves') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="card bg-light">
                                                    <div class="card-body text-center">
                                                        <i class="fas fa-file-contract fa-2x text-info mb-3"></i>
                                                        <h3 class="text-info">{{ $rentals->count() }}</h3>
                                                        <p class="text-muted mb-0">{{ __('warehouse.total_rentals') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="card bg-light">
                                                    <div class="card-body text-center">
                                                        <i class="fas fa-clock fa-2x text-warning mb-3"></i>
                                                        <h3 class="text-warning">{{ $rentals->where('status', true)->count() }}</h3>
                                                        <p class="text-muted mb-0">{{ __('general.active_rentals') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <small>{{ __('general.last_updated') }}: {{ $warehouse->updated_at->diffForHumans() }}</small>
                    </div>
                    <div>
                        @ability('admin', 'delete_warehouses')
                        <button class="btn btn-danger" onclick="confirmDelete('delete-warehouse-{{ $warehouse->id }}',
                            '{{ __('panel.confirm_delete_message') }}',
                            '{{ __('panel.yes_delete') }}',
                            '{{ __('panel.cancel') }}')">
                            <i class="fas fa-trash me-1"></i> {{ __('general.delete') }}
                        </button>
                        <form action="{{ route('admin.warehouses.destroy', $warehouse->id) }}"
                              method="post" class="d-none"
                              id="delete-warehouse-{{ $warehouse->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        @endability
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
:root {
    --primary-color: #667eea;
    --secondary-color: #764ba2;
    --success-color: #28a745;
    --info-color: #17a2b8;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
}

.card {
    border: none;
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border-radius: 12px;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.12);
}

.card-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
}

.stats-card {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: white;
    font-size: 1.5rem;
}

.stats-info h4 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    color: #2d3748;
}

.stats-info p {
    color: #718096;
    margin-bottom: 0;
    font-weight: 500;
}

.info-card .info-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    padding: 1rem;
    border-radius: 8px;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.info-card .info-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.info-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    background: rgba(102, 126, 234, 0.1);
}

.info-content h6 {
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.info-content p {
    color: #718096;
    margin-bottom: 0;
}

.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline-item {
    position: relative;
    padding-bottom: 2rem;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-point {
    position: absolute;
    left: -2rem;
    top: 0.5rem;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: var(--primary-color);
    border: 3px solid white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
}

.timeline-content h6 {
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.timeline-content p {
    color: #4a5568;
    margin-bottom: 0.25rem;
}

.nav-pills .nav-link {
    border-radius: 8px;
    padding: 1rem 1.5rem;
    color: #718096;
    font-weight: 500;
    transition: all 0.3s ease;
}

.nav-pills .nav-link.active {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

#miniMap {
    height: 200px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.progress {
    border-radius: 20px;
    background: #e2e8f0;
}

.progress-bar {
    border-radius: 20px;
}

.badge {
    font-weight: 500;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
}

@media (max-width: 768px) {
    .stats-card {
        flex-direction: column;
        text-align: center;
    }

    .stats-icon {
        margin-right: 0;
        margin-bottom: 1rem;
    }

    .action-buttons {
        flex-direction: column;
        gap: 0.5rem;
    }

    .action-buttons .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection

@section('script')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
$(document).ready(function() {
    @if($warehouse->latitude && $warehouse->longitude)
    // Initialize mini map
    var miniMap = L.map('miniMap').setView([{{ $warehouse->latitude }}, {{ $warehouse->longitude }}], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(miniMap);

    // Add custom icon
    var warehouseIcon = L.icon({
        iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34]
    });

    L.marker([{{ $warehouse->latitude }}, {{ $warehouse->longitude }}], {icon: warehouseIcon})
        .addTo(miniMap)
        .bindPopup('<strong>{{ $warehouse->name }}</strong><br>{{ $warehouse->code }}')
        .openPopup();
    @endif

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top - 100
        }, 500);
    });
});
</script>
@endsection
