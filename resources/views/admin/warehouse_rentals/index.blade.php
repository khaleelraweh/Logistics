@extends('layouts.admin')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('rental.manage_rentals') }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('rental.rentals') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                    <div class="head">

                        <h4 class="card-title"> <i class="mdi mdi-warehouse me-2"></i> {{ __('rental.rental_data') }}</h4>
                        <p class="card-title-desc">
                            {{ __('rental.rental_description') }}
                        </p>
                    </div>

                    <div class="button-items">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.warehouse_rentals.create') }}">
                                <i class="mdi mdi-warehouse me-2"></i> {{ __('rental.add_new_rental') }}
                            </a>
                    </div>

                </div>

            <div class="card-body">

                <!-- Filters Section -->
                @include('admin.warehouse_rentals.filter.filter')
                <!-- End Filters Section -->

                <!-- Rentals Table -->
                <div class="table-responsive">
                    {{-- <table id="rentals-datatable" class="table table-hover table-bordered nowrap w-100"> --}}
                    <table id="datatable" class="table table-hover table-bordered nowrap w-100">
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
                                    <a href="javascript:void(0);"
                                        class="updateWarehouseRentalStatus d-flex align-items-center"
                                        id="warehouse-rental-{{ $rental->id }}"
                                        warehouse_rental_id="{{ $rental->id }}"
                                        data-active-text="{{ __('panel.status_active') }}"
                                        data-inactive-text="{{ __('panel.status_inactive') }}">

                                        @if ($rental->status == 1)
                                            <i class="fas fa-toggle-on fa-lg text-success" aria-hidden="true" status="Active" style="font-size:1.6em"></i>
                                            <span class="ms-1 text-success fw-bold">{{ __('panel.status_active') }}</span>

                                        @else
                                            <i class="fas fa-toggle-off fa-lg text-warning" aria-hidden="true" status="Inactive" style="font-size:1.6em"></i>
                                            <span class="ms-1 text-warning fw-bold">{{ __('panel.status_inactive') }}</span>
                                        @endif
                                    </a>
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
                                                <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                        onclick="confirmDelete('delete-warehouse-rental-{{ $rental->id }}',
                                                                                '{{ __('panel.confirm_delete_message') }}',
                                                                                '{{ __('panel.yes_delete') }}',
                                                                                '{{ __('panel.cancel') }}')"

                                                        >
                                                    <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                </a>
                                                <form id="delete-warehouse-rental-{{ $rental->id }}"
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



@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#datatable').DataTable({
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

    });
</script>
@endpush
