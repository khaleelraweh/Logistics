@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">{{ __('rental.manage_rentals') }}</h1>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                <li class="breadcrumb-item active">{{ __('rental.rentals') }}</li>
            </ul>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.warehouse_rentals.create') }}" class="btn btn-primary">
                <i class="mdi mdi-clipboard-text-outline me-2"></i>{{ __('rental.add_new_rental') }}
            </a>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">
                    <i class="mdi mdi-warehouse me-2"></i>{{ __('rental.rental_data') }}
                </h5>
                <p class="card-title-desc text-muted mb-0">
                    {{ __('rental.rental_description') }}
                </p>
            </div>

            <div class="card-body">

                <!-- Filters Section -->
                @include('admin.warehouse_rentals.filter.filter')
                <!-- End Filters Section -->

                <!-- Rentals Table -->
                <div class="table-responsive">
                    <table id="rentals-datatable" class="table table-hover table-bordered nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>{{ __('rental.merchant') }}</th>
                                <th>{{ __('rental.rental_period') }}</th>
                                <th>{{ __('rental.shelves_count') }}</th>
                                <th>{{ __('rental.price') }}</th>
                                <th>{{ __('rental.status') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th width="12%">{{ __('general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($warehouse_rentals as $rental)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-sm bg-light rounded p-1">
                                                  @php
                                                    if ($rental->merchant->logo != null ) {
                                                        $merchant_logo = asset('assets/merchants/' . $rental->merchant->logo);

                                                        if (
                                                            !file_exists(
                                                                public_path('assets/merchants/' . $rental->merchant->logo),
                                                            )
                                                        ) {
                                                            $merchant_logo = asset('images/not_found/logo-placeholder.png');
                                                        }
                                                    } else {
                                                        $merchant_logo = asset('images/not_found/logo-placeholder.png');
                                                    }
                                                @endphp

                                                <img src="{{ $merchant_logo }}"
                                                     alt="{{ $rental->merchant->name }}"
                                                     class="img-fluid d-block rounded">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $rental->merchant->name ?? '-' }}</h6>
                                            <p class="text-muted mb-0">{{ $rental->merchant->email ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ $rental->rental_start->format('Y-m-d') }}</span>
                                        <span class="text-muted small">{{ __('general.to') }}</span>
                                        <span class="fw-bold">{{ $rental->rental_end->format('Y-m-d') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">{{ $rental->shelves->count() }}</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">{{ number_format($rental->price, 2) }} {{ __('general.sar') }}</span>
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input update-status" type="checkbox"
                                               data-id="{{ $rental->id }}"
                                               {{ $rental->status ? 'checked' : '' }}>
                                        <label class="form-check-label ms-2">
                                            {{ $rental->status ? __('panel.status_active') : __('panel.status_inactive') }}
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted" data-bs-toggle="tooltip"
                                          title="{{ $rental->created_at->format('Y-m-d H:i') }}">
                                        {{ $rental->created_at->diffForHumans() }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @ability('admin', 'show_warehouse_rentals')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.warehouse_rentals.show', $rental->id) }}">
                                                    <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                </a>
                                            </li>
                                            @endability

                                            @ability('admin', 'update_warehouse_rentals')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.warehouse_rentals.edit', $rental->id) }}">
                                                    <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                </a>
                                            </li>
                                            @endability

                                            @ability('admin', 'delete_warehouse_rentals')
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#"
                                                   onclick="confirmDelete('delete-form-{{ $rental->id }}',
                                                          '{{ __('panel.confirm_delete_message') }}')">
                                                    <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                </a>
                                                <form id="delete-form-{{ $rental->id }}"
                                                      action="{{ route('admin.warehouse_rentals.destroy', $rental->id) }}"
                                                      method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </li>
                                            @endability
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <img src="{{ asset('assets/images/empty.svg') }}" alt="Empty" style="width: 120px;">
                                    <p class="text-muted mt-3">{{ __('panel.no_found_item') }}</p>
                                    <a href="{{ route('admin.warehouse_rentals.create') }}" class="btn btn-primary mt-2">
                                        <i class="mdi mdi-plus-circle-outline me-1"></i>
                                        {{ __('rental.add_new_rental') }}
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($warehouse_rentals->hasPages())
            <div class="card-footer bg-white border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        {{ __('general.showing') }}
                        <span class="fw-bold">{{ $warehouse_rentals->firstItem() }}</span>
                        {{ __('general.to') }}
                        <span class="fw-bold">{{ $warehouse_rentals->lastItem() }}</span>
                        {{ __('general.of') }}
                        <span class="fw-bold">{{ $warehouse_rentals->total() }}</span>
                        {{ __('general.entries') }}
                    </div>
                    {{ $warehouse_rentals->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .filter-section {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
    }
    .filter-section .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    #rentals-datatable tbody tr {
        transition: all 0.2s ease;
    }
    #rentals-datatable tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .form-switch .form-check-input {
        width: 2.5em;
        height: 1.5em;
        cursor: pointer;
    }
    .dropdown-menu {
        min-width: 10rem;
    }
    .avatar-sm {
        width: 36px;
        height: 36px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#rentals-datatable').DataTable({
            language: {
                url: '{{ asset("assets/js/datatables-ar.json") }}'
            },
            dom: '<"top"f>rt<"bottom"lip><"clear">',
            pageLength: 25,
            responsive: true,
            order: [[0, 'asc']],
            columnDefs: [
                { orderable: false, targets: [7] },
                { className: 'text-center', targets: [3, 5, 7] }
            ]
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Initialize date range picker
        $('.flatpickr-range').flatpickr({
            mode: "range",
            dateFormat: "Y-m-d",
        });

        // Initialize select2
        $('.select2').select2({
            placeholder: "{{ __('general.select_option') }}",
            width: '100%'
        });

        // Update status toggle
        $('.update-status').change(function() {
            var rentalId = $(this).data('id');
            var status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.warehouse_rentals.update_warehouse_rentals_status') }}",
                type: "POST",
                data: {
                    id: rentalId,
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    });
                },
                error: function(xhr) {
                    Toast.fire({
                        icon: 'error',
                        title: "{{ __('panel.error_occurred') }}"
                    });
                }
            });
        });
    });

    function confirmDelete(formId, message) {
        Swal.fire({
            title: "{{ __('panel.confirm_delete_title') }}",
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ __('panel.yes_delete') }}",
            cancelButtonText: "{{ __('panel.cancel') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
@endpush
