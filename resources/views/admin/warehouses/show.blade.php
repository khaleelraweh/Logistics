@extends('layouts.admin')

@section('content')

    <!-- Page Header -->
    <div class="row ">
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
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0 rounded-lg">
                <!-- Card Header with Gradient Background -->
                <div class="card-header bg-gradient-primary text-black py-3 position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title mb-0 text-black">{{ $warehouse->name }}</h4>
                            <h6 class="card-subtitle mt-2 text-black-50">{{ $warehouse->code }}</h6>
                        </div>
                        <span class="badge bg-{{ $warehouse->status ? 'light' : 'secondary' }} text-{{ $warehouse->status ? 'dark' : 'white' }} fs-6">
                            {{ $warehouse->status ? __('general.active') : __('general.inactive') }}
                        </span>
                    </div>
                    <div class="position-absolute top-0 end-0 mt-3 me-3">
                        <i class="fas fa-warehouse fa-3x opacity-25"></i>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Warehouse Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="card border-0 h-100 bg-light-info">
                                <div class="card-body text-center">
                                    <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                                    <h5 class="text-muted mb-2">{{ __('warehouse.location') }}</h5>
                                    <p class="fs-5 fw-semibold">{{ $warehouse->location }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card border-0 h-100 bg-light-success">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-tie fa-2x text-success mb-3"></i>
                                    <h5 class="text-muted mb-2">{{ __('warehouse.manager') }}</h5>
                                    <p class="fs-5 fw-semibold">{{ $warehouse->manager }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card border-0 h-100 bg-light-warning">
                                <div class="card-body text-center">
                                    <i class="fas fa-phone-alt fa-2x text-warning mb-3"></i>
                                    <h5 class="text-muted mb-2">{{ __('general.contact') }}</h5>
                                    <p class="mb-1">{{ $warehouse->phone ?? __('general.not_specified') }}</p>
                                    <p class="mb-0">{{ $warehouse->email ?? __('general.not_specified') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Warehouse Details Tabs -->
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs mb-4" id="warehouseTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="shelves-tab" data-bs-toggle="tab" data-bs-target="#shelves" type="button" role="tab">
                                        <i class="fas fa-boxes me-2"></i> {{ __('shelf.shelves') }}
                                        <span class="badge bg-primary ms-2">{{ $warehouse->shelves->count() }}</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="rentals-tab" data-bs-toggle="tab" data-bs-target="#rentals" type="button" role="tab">
                                        <i class="fas fa-file-contract me-2"></i> {{ __('warehouse.rentals') }}
                                        <span class="badge bg-primary ms-2">{{ $rentals->count() }}</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">
                                        <i class="fas fa-info-circle me-2"></i> {{ __('general.details') }}
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="warehouseTabsContent">
                                <!-- Shelves Tab -->
                                <div class="tab-pane fade show active" id="shelves" role="tabpanel">
                                    @if($warehouse->shelves->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th width="30%">{{ __('shelf.code') }}</th>
                                                        <th width="30%">{{ __('general.status') }}</th>
                                                        <th width="40%" class="text-end">{{ __('general.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($warehouse->shelves as $shelf)
                                                        <tr>
                                                            <td>{{ $shelf->code }}</td>
                                                            <td>
                                                                <span class="badge bg-{{ $shelf->status ? 'success' : 'danger' }}">
                                                                    {{ $shelf->status ? __('general.active') : __('general.inactive') }}
                                                                </span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="{{ route('admin.shelves.show', $shelf->id) }}" class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            {{ __('shelf.no_shelves_found') }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Rentals Tab -->
                                <div class="tab-pane fade" id="rentals" role="tabpanel">
                                    @if($rentals->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th width="30%">{{ __('general.merchant') }}</th>
                                                        <th width="25%">{{ __('general.period') }}</th>
                                                        <th width="20%">{{ __('general.status') }}</th>
                                                        <th width="25%" class="text-end">{{ __('general.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($rentals as $rental)
                                                        <tr>
                                                            <td>{{ $rental->merchant->name ?? __('general.deleted') }}</td>
                                                            <td>
                                                                <span class="d-block">{{ $rental->rental_start->format('Y-m-d') }}</span>
                                                                <span class="d-block">{{ $rental->rental_end->format('Y-m-d') }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-{{ $rental->status ? 'success' : 'danger' }}">
                                                                    {{ $rental->status ? __('general.active') : __('general.expired') }}
                                                                </span>
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="#" class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            {{ __('warehouse.no_rentals_found') }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Details Tab -->
                                <div class="tab-pane fade" id="details" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card border-0 bg-light">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-4"><i class="fas fa-history me-2"></i> {{ __('general.history') }}</h5>
                                                    <ul class="list-unstyled timeline">
                                                        <li class="mb-3">
                                                            <p class="text-muted mb-1">
                                                                <i class="far fa-calendar-plus me-2"></i>
                                                                {{ __('general.created_at') }}
                                                            </p>
                                                            <p class="fw-semibold">{{ $warehouse->created_at->format('Y-m-d H:i') }}</p>
                                                        </li>
                                                        <li class="mb-3">
                                                            <p class="text-muted mb-1">
                                                                <i class="fas fa-user-plus me-2"></i>
                                                                {{ __('general.created_by') }}
                                                            </p>
                                                            <p class="fw-semibold">{{ $warehouse->created_by ?? __('general.system') }}</p>
                                                        </li>
                                                        <li class="mb-3">
                                                            <p class="text-muted mb-1">
                                                                <i class="fas fa-user-edit me-2"></i>
                                                                {{ __('general.last_updated_by') }}
                                                            </p>
                                                            <p class="fw-semibold">{{ $warehouse->updated_by ?? __('general.system') }}</p>
                                                        </li>
                                                        @if($warehouse->published_on)
                                                        <li>
                                                            <p class="text-muted mb-1">
                                                                <i class="fas fa-calendar-check me-2"></i>
                                                                {{ __('general.published_on') }}
                                                            </p>
                                                            <p class="fw-semibold">{{ $warehouse->published_on->format('Y-m-d H:i') }}</p>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border-0 bg-light">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-4"><i class="fas fa-chart-pie me-2"></i> {{ __('general.statistics') }}</h5>
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <div class="p-3 bg-primary-light rounded text-center">
                                                                <h3 class="text-primary mb-1">{{ $warehouse->shelves->count() }}</h3>
                                                                <p class="text-muted mb-0">{{ __('shelf.shelves') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <div class="p-3 bg-success-light rounded text-center">
                                                                <h3 class="text-success mb-1">{{ $rentals->count() }}</h3>
                                                                <p class="text-muted mb-0">{{ __('warehouse.rentals') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="p-3 bg-info-light rounded text-center">
                                                                <h3 class="text-info mb-1">{{ $warehouse->shelves->where('status', true)->count() }}</h3>
                                                                <p class="text-muted mb-0">{{ __('general.active_shelves') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="p-3 bg-warning-light rounded text-center">
                                                                <h3 class="text-warning mb-1">{{ $rentals->where('status', true)->count() }}</h3>
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
                </div>

                <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.warehouses.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> {{ __('general.back') }}
                    </a>
                    <div>
                        @ability('admin', 'update_warehouses')
                            <a href="{{ route('admin.warehouses.edit', $warehouse->id) }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit me-1"></i> {{ __('general.update') }}
                            </a>
                        @endability
                        @ability('admin', 'delete_warehouses')
                            <a class="btn btn-danger" href="javascript:void(0)" onclick="confirmDelete('delete-warehouse-{{ $warehouse->id }}',
                                                                                    '{{ __('panel.confirm_delete_message') }}',
                                                                                    '{{ __('panel.yes_delete') }}',
                                                                                    '{{ __('panel.cancel') }}')">
                                <i class="fas fa-trash me-1"></i> {{ __('general.delete') }}
                            </a>

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
@endsection

@push('styles')
<style>
    .card {
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }

    .card:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .bg-primary-light {
        background-color: rgba(102, 126, 234, 0.1);
    }

    .bg-success-light {
        background-color: rgba(40, 167, 69, 0.1);
    }

    .bg-info-light {
        background-color: rgba(23, 162, 184, 0.1);
    }

    .bg-warning-light {
        background-color: rgba(255, 193, 7, 0.1);
    }

    .timeline {
        position: relative;
        padding-left: 20px;
    }

    .timeline li {
        position: relative;
        padding-left: 20px;
    }

    .timeline li:before {
        content: "";
        position: absolute;
        left: 0;
        top: 5px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #667eea;
    }

    .nav-tabs .nav-link {
        border: none;
        padding: 12px 20px;
        color: #495057;
        font-weight: 500;
    }

    .nav-tabs .nav-link.active {
        color: #667eea;
        background-color: transparent;
        border-bottom: 3px solid #667eea;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush
