@extends('layouts.admin')

@section('content')

<!-- Page Header -->
<div class="row ">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('shelf.manage_shelves') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.shelves.index') }}">{{ __('shelf.shelves') }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <div class="head">
                    <h4 class="card-title"> <i class="fas fa-pallet me-2"></i> {{ __('shelf.shelf_data') }}</h4>
                    <p class="card-title-desc">
                        {{ __('shelf.shelf_description') }}
                    </p>
                </div>

                @ability('admin', 'create_shelves')
                    <div class="button-items">
                        <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.shelves.create') }}">
                            <i class="mdi mdi-warehouse me-2"></i> {{ __('shelf.add_new_shelf') }}
                        </a>
                    </div>
                @endability

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
                                {{-- <td>
                                    @if ($shelf->status == 1)
                                        <a href="javascript:void(0);" class="updateShelveStatus "
                                            id="shelf-{{ $shelf->id }}" shelf_id="{{ $shelf->id }}">
                                            <i class="fas fa-toggle-on fa-lg text-success" aria-hidden="true"
                                                status="Active" style="font-size: 1.6em"></i>
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="updateShelveStatus" id="shelf-{{ $shelf->id }}"
                                            shelf_id="{{ $shelf->id }}">
                                            <i class="fas fa-toggle-off fa-lg text-warning" aria-hidden="true"
                                                status="Inactive" style="font-size: 1.6em"></i>
                                        </a>
                                    @endif
                                </td> --}}

                                <td>
                                    <a href="javascript:void(0);"
                                        class="updateShelveStatus d-flex align-items-center "
                                        id="shelf-{{ $shelf->id }}"
                                        shelf_id="{{ $shelf->id }}"
                                        data-active-text="{{ __('panel.status_active') }}"
                                        data-inactive-text="{{ __('panel.status_inactive') }}">

                                        @if ($shelf->status == 1)
                                            <i class="fas fa-toggle-on fa-lg text-success" aria-hidden="true" status="Active" style="font-size:1.6em"></i>
                                            <span class="ms-1 text-success fw-bold">{{ __('panel.status_active') }}</span>

                                        @else
                                            <i class="fas fa-toggle-off fa-lg text-warning" aria-hidden="true" status="Inactive" style="font-size:1.6em"></i>
                                            <span class="ms-1 text-warning fw-bold">{{ __('panel.status_inactive') }}</span>
                                        @endif
                                    </a>
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

