@extends('layouts.driver')

@section('content')
    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('return_request.manage_return_requests') }}</h4>
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('driver.return_requests.index') }}">{{ __('return_request.manage_return_requests') }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="mb-0">{{ $return_requests->count() }}</h4>
                            <span class="fs-6">{{ __('return_request.total_requests') }}</span>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="dripicons-return fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="mb-0">{{ $return_requests->where('status', 'requested')->count() }}</h4>
                            <span class="fs-6">{{ __('return_request.pending') }}</span>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="dripicons-clock fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="mb-0">{{ $return_requests->whereIn('status', ['assigned_to_driver', 'picked_up'])->count() }}</h4>
                            <span class="fs-6">{{ __('return_request.in_progress') }}</span>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="dripicons-direction fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="mb-0">{{ $return_requests->whereIn('status', ['received', 'partially_received'])->count() }}</h4>
                            <span class="fs-6">{{ __('return_request.completed') }}</span>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="dripicons-checkmark fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Statistics Cards -->

    <!-- return_requests table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-head d-flex justify-content-between align-items-center mb-4">
                        <div class="head">
                            <h4 class="card-title"><i class="dripicons-return"></i> {{ __('return_request.return_request_data') }}</h4>
                            <p class="card-title-desc text-muted mb-0">
                                {{ __('return_request.return_request_description') }}
                            </p>
                        </div>
                        <div class="actions">
                            <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filtersSection">
                                <i class="fas fa-filter me-2"></i>{{ __('general.filters') }}
                            </button>
                        </div>
                    </div>

                    <!-- Filters Section -->
                    <div class="collapse mb-4" id="filtersSection">
                        @include('driver.return_requests.filter.filter')
                    </div>
                    <!-- End Filters Section -->

                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover table-bordered dt-responsive nowrap" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('return_request.package_details') }}</th>
                                    <th>{{ __('return_request.customer_info') }}</th>
                                    <th>{{ __('return_request.status') }}</th>
                                    <th>{{ __('return_request.timeline') }}</th>
                                    <th>{{ __('general.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($return_requests as $return_request)
                                    <tr class="align-middle">
                                        <td class="fw-bold">{{ $loop->iteration }}</td>

                                        <!-- Package Details Column -->
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <i class="dripicons-package text-primary fs-4"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">
                                                        <a href="#" class="text-dark" data-bs-toggle="tooltip"
                                                           title="{{ __('return_request.tracking_number') }}: {{ $return_request->package->tracking_number ?? '-' }}">
                                                            {{ $return_request->package->tracking_number ?? '-' }}
                                                        </a>
                                                    </h6>
                                                    <p class="text-muted mb-0 small">
                                                        <i class="fas fa-map-marker-alt me-1"></i>
                                                        {{ $return_request->package->sender_city ?? '-' }} → {{ $return_request->package->receiver_city ?? '-' }}
                                                    </p>
                                                    <p class="text-muted mb-0 small">
                                                        <i class="fas fa-weight-hanging me-1"></i>
                                                        {{ $return_request->package->weight ?? '0' }} kg
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Customer Information Column -->
                                        <td>
                                            <div class="customer-info">
                                                <h6 class="mb-1">
                                                    <i class="fas fa-user me-2 text-primary"></i>
                                                    {{ $return_request->package->receiver_first_name ?? '' }} {{ $return_request->package->receiver_last_name ?? '' }}
                                                </h6>
                                                <p class="text-muted mb-1 small">
                                                    <i class="fas fa-phone me-1"></i>
                                                    {{ $return_request->package->receiver_phone ?? '-' }}
                                                </p>
                                                <p class="text-muted mb-0 small">
                                                    <i class="fas fa-map-marker-alt me-1"></i>
                                                    {{ $return_request->package->receiver_district ?? '-' }}, {{ $return_request->package->receiver_city ?? '-' }}
                                                </p>
                                            </div>
                                        </td>

                                        <!-- Status Column -->
                                        @php
                                            $statusColors = [
                                                'requested' => 'success',
                                                'assigned_to_driver' => 'info',
                                                'picked_up' => 'warning',
                                                'in_transit' => 'warning',
                                                'received' => 'primary',
                                                'partially_received' => 'info',
                                                'rejected' => 'danger',
                                                'cancelled' => 'danger',
                                            ];

                                            $statusIcons = [
                                                'requested' => 'clock',
                                                'assigned_to_driver' => 'user',
                                                'picked_up' => 'shopping-bag',
                                                'in_transit' => 'truck',
                                                'received' => 'check-circle',
                                                'partially_received' => 'exclamation-circle',
                                                'rejected' => 'times-circle',
                                                'cancelled' => 'ban',
                                            ];

                                            $status = $return_request->status;
                                            $color = $statusColors[$status] ?? 'secondary';
                                            $icon = $statusIcons[$status] ?? 'question-circle';
                                        @endphp

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-{{ $color }} rounded-pill d-flex align-items-center">
                                                    <i class="fas fa-{{ $icon }} me-2"></i>
                                                    {{ $return_request->statusLabel() }}
                                                </span>
                                            </div>
                                            @if($return_request->reason)
                                                <small class="text-muted d-block mt-1">
                                                    <i class="fas fa-comment me-1"></i>
                                                    {{ Str::limit($return_request->reason, 30) }}
                                                </small>
                                            @endif
                                        </td>

                                        <!-- Timeline Column -->
                                        <td>
                                            <div class="timeline-info">
                                                <div class="d-flex justify-content-between small text-muted">
                                                    <span>
                                                        <i class="fas fa-calendar-plus me-1"></i>
                                                        {{ $return_request->requested_at ? $return_request->requested_at->format('d/m/Y') : '-' }}
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-clock me-1"></i>
                                                        {{ $return_request->requested_at ? $return_request->requested_at->format('H:i') : '-' }}
                                                    </span>
                                                </div>
                                                @if($return_request->received_at)
                                                    <div class="d-flex justify-content-between small text-success mt-1">
                                                        <span>
                                                            <i class="fas fa-check-circle me-1"></i>
                                                            {{ $return_request->received_at->format('d/m/Y H:i') }}
                                                        </span>
                                                    </div>
                                                @endif
                                                <div class="progress mt-2" style="height: 4px;">
                                                    @php
                                                        $progress = match($status) {
                                                            'requested' => 25,
                                                            'assigned_to_driver' => 50,
                                                            'picked_up', 'in_transit' => 75,
                                                            'received', 'partially_received' => 100,
                                                            default => 0,
                                                        };
                                                    @endphp
                                                    <div class="progress-bar bg-{{ $color }}" role="progressbar"
                                                         style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Actions Column -->
                                        <td>
                                            <div class="btn-group" role="group">
                                                @ability('driver', 'show_return_requests')
                                                <a href="{{ route('driver.return_requests.show', $return_request->id) }}"
                                                   class="btn btn-sm btn-outline-primary"
                                                   data-bs-toggle="tooltip"
                                                   title="{{ __('general.show_details') }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @endability

                                                @ability('driver', 'update_return_requests')
                                                <a href="{{ route('driver.return_requests.edit', $return_request->id) }}"
                                                   class="btn btn-sm btn-outline-warning"
                                                   data-bs-toggle="tooltip"
                                                   title="{{ __('general.edit_status') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endability
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="dripicons-return fs-1 text-muted"></i>
                                                <h5 class="mt-3">{{ __('return_request.no_requests_found') }}</h5>
                                                <p class="text-muted">{{ __('return_request.no_requests_description') }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($return_requests->hasPages())
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    {{ __('general.showing') }} {{ $return_requests->firstItem() }} - {{ $return_requests->lastItem() }}
                                    {{ __('general.of') }} {{ $return_requests->total() }}
                                    {{ __('general.records') }}
                                </div>
                                <div>
                                    {{ $return_requests->links() }}
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // تفعيل التولتيب
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl, { html: true })
        });

        // تفعيل التصفح السلس للجدول
        const table = document.getElementById('datatable');
        if (table) {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [10, 25, 50, 100],
                labels: {
                    placeholder: "{{ __('general.search') }}...",
                    perPage: "{{ __('general.records_per_page') }}",
                    noRows: "{{ __('panel.no_found_item') }}",
                    info: "{{ __('general.showing') }} {start} {{ __('general.to') }} {end} {{ __('general.of') }} {rows} {{ __('general.records') }}"
                }
            });
        }
    });
</script>

<style>
.customer-info h6 {
    font-size: 0.9rem;
    font-weight: 600;
}

.timeline-info {
    min-width: 120px;
}

.progress {
    background-color: #e9ecef;
    border-radius: 10px;
}

.empty-state {
    padding: 2rem 0;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.04);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}

.btn-group .btn {
    border-radius: 0.375rem;
    margin: 0 2px;
}
</style>
@endsection
