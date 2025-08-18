@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">{{ __('shelf.manage_shelves') }}</h1>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                <li class="breadcrumb-item active">{{ __('shelf.shelves') }}</li>
            </ul>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.shelves.create') }}" class="btn btn-primary">
                <i class="mdi mdi-library-shelves me-2"></i>{{ __('shelf.add_new_shelf') }}
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
                    <i class="fas fa-pallet me-2"></i>{{ __('shelf.shelf_data') }}
                </h5>
                <p class="card-title-desc text-muted mb-0">
                    {{ __('shelf.shelf_description') }}
                </p>
            </div>

            <div class="card-body">

                <!-- Filters Section -->
                @include('admin.shelves.filter.filter')
                <!-- End Filters Section -->

                <!-- Shelves Table -->
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-bordered nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>{{ __('shelf.code') }}</th>
                                <th>{{ __('warehouse.name') }}</th>
                                <th>{{ __('shelf.size') }}</th>
                                <th>{{ __('shelf.price') }}</th>
                                <th>{{ __('shelf.status') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th width="12%">{{ __('general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($shelves as $shelf)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $shelf->code }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.warehouses.show', $shelf->warehouse->id ?? '') }}" class="text-primary">
                                        {{ $shelf->warehouse->name ?? __('general.unknown') }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $shelf->size === 'small' ? 'info' : ($shelf->size === 'medium' ? 'warning' : 'danger') }}">
                                        {{ $shelf->size() }}
                                    </span>
                                </td>
                                <td>{{ $shelf->price }} {{ config('settings.currency_symbol') }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input change-status"
                                               data-id="{{ $shelf->id }}"
                                               id="status-{{ $shelf->id }}"
                                               {{ $shelf->status ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status-{{ $shelf->id }}">
                                            {{ $shelf->status ? __('general.active') : __('general.inactive') }}
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $shelf->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @ability('admin', 'show_shelves')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.shelves.show', $shelf->id) }}">
                                                    <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                </a>
                                            </li>
                                            @endability

                                            @ability('admin', 'update_shelves')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.shelves.edit', $shelf->id) }}">
                                                    <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                </a>
                                            </li>
                                            @endability

                                            @ability('admin', 'delete_shelves')
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#"
                                                   onclick="confirmDelete('delete-form-{{ $shelf->id }}',
                                                          '{{ __('panel.confirm_delete_message') }}')">
                                                    <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                </a>
                                                <form id="delete-form-{{ $shelf->id }}"
                                                      action="{{ route('admin.shelves.destroy', $shelf->id) }}"
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
                                    <i class="fas fa-box-open fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">{{ __('panel.no_found_item') }}</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            width: '100%',
            placeholder: "{{ __('shelf.select_warehouse') }}"
        });

        // Change status toggle
        $('.change-status').change(function() {
            const shelfId = $(this).data('id');
            const status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.shelves.update_shelves_status') }}",
                method: 'POST',
                data: {
                    id: shelfId,
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection

@section('styles')
<style>
    .filter-section .card {
        border-radius: 0.5rem;
    }
    .table th {
        white-space: nowrap;
    }
    .form-switch .form-check-input {
        width: 2.5em;
        height: 1.5em;
    }
    .dropdown-menu {
        min-width: 10rem;
    }
</style>
@endsection
