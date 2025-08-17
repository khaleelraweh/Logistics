@extends('layouts.admin')

@section('content')

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('shelf.manage_shelves') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('shelf.view_shelves') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('shelf.manage_shelves') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="card-head d-flex justify-content-between">
                            <div class="head">

                                <h4 class="card-title"> <i class="fas fa-eye"></i> {{ __('shelf.shelf_data') }}</h4>
                                <p class="card-title-desc">
                                    {{ __('shelf.shelf_description') }}
                                </p>
                            </div>

                            <div class="button-items">
                                   <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.shelves.create') }}">
                                        {{ __('shelf.add_new_shelf') }}
                                        {{-- <i class="ri-shelf-hunt-line  align-middle ms-2"></i> --}}
                                        <i class="mdi mdi-18px mdi-library-shelves"></i>
                                   </a>
                            </div>

                        </div>


                        <!-- Filters -->
                        <!-- Filters Form -->
                        <!-- Filters Card -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><i class="fas fa-filter me-2"></i>{{ __('general.filters') }}</h5>
                                <form method="GET" action="{{ route('admin.shelves.index') }}" class="row g-3">

                                    <!-- حالة الرف -->
                                    <div class="col-sm-6 col-md-3">
                                        <label for="status" class="form-label">{{ __('shelf.status') }}</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="">{{ __('shelf.all_status') }}</option>
                                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>{{ __('shelf.active') }}</option>
                                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>{{ __('shelf.inactive') }}</option>
                                        </select>
                                    </div>

                                    <!-- المستودع -->
                                    <div class="col-sm-6 col-md-3">
                                        <label for="warehouse_id" class="form-label">{{ __('warehouse.name') }}</label>
                                        <select name="warehouse_id" id="warehouse_id" class="form-select">
                                            <option value="">{{ __('shelf.all_warehouses') }}</option>
                                            @foreach($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}" {{ request('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                                    {{ $warehouse->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- حالة التأجير -->
                                    <div class="col-sm-6 col-md-3">
                                        <label for="rented" class="form-label">{{ __('shelf.rental_status') }}</label>
                                        <select name="rented" id="rented" class="form-select">
                                            <option value="">{{ __('shelf.all_rental_status') }}</option>
                                            <option value="1" {{ request('rented') == '1' ? 'selected' : '' }}>{{ __('shelf.rented') }}</option>
                                            <option value="0" {{ request('rented') == '0' ? 'selected' : '' }}>{{ __('shelf.not_rented') }}</option>
                                        </select>
                                    </div>

                                    <!-- أزرار البحث وإعادة التعيين -->
                                    <div class="col-sm-6 col-md-3 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary me-2 w-100 w-md-auto">
                                            <i class="fas fa-filter me-1"></i>{{ __('general.filter') }}
                                        </button>
                                        <a href="{{ route('admin.shelves.index') }}" class="btn btn-secondary w-100 w-md-auto">
                                            <i class="fas fa-sync-alt me-1"></i>{{ __('general.reset') }}
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Filters Card -->




                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('shelf.code') }}</th>
                                <th>{{ __('warehouse.name') }}</th>
                                <th>{{ __('shelf.size') }}</th>
                                <th>{{ __('shelf.price') }}</th>
                                <th>{{ __('shelf.description') }}</th>
                                <th>{{ __('shelf.status') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th>{{ __('general.the_actions') }}</th>
                            </tr>
                            </thead>


                            <tbody>

                            @forelse ($shelves as $shelf)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($shelf->code ?? '', 8) }}</td>
                                    <td>{!! \Illuminate\Support\Str::limit($shelf->warehouse->name ?? '', 25) !!}</td>
                                    <td>{{ $shelf->size() }}</td>
                                    <td>{{ $shelf->price }}</td>
                                    <td>{!! \Illuminate\Support\Str::limit($shelf->description ?? '', 25) !!}</td>

                                    <td>
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
                                    </td>
                                    <td>{{ $shelf->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ __('general.operations') }} <i class="mdi mdi-dots-vertical ms-2"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    @ability('admin', 'show_shelves')
                                                        <a class="dropdown-item" href="{{ route('admin.shelves.show' , $shelf->id) }}">{{ __('general.show') }}</a>
                                                    @endability

                                                    @ability('admin', 'update_shelves')
                                                        <a class="dropdown-item" href="{{ route('admin.shelves.edit' , $shelf->id) }}">{{ __('general.edit') }}</a>
                                                    @endability

                                                    @ability('admin', 'delete_shelves')
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                                                onclick="confirmDelete('delete-shelf-{{ $shelf->id }}',
                                                                                    '{{ __('panel.confirm_delete_message') }}',
                                                                                    '{{ __('panel.yes_delete') }}',
                                                                                    '{{ __('panel.cancel') }}')"
                                                        >
                                                        {{ __('general.delete') }}
                                                        </a>
                                                        <form action="{{ route('admin.shelves.destroy', $shelf->id) }}"
                                                              method="post" class="d-none"
                                                              id="delete-shelf-{{ $shelf->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endability
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                             <tr>
                                <td colspan="8" class="text-center">{{ __('panel.no_found_item') }}</td>
                            </tr>
                            @endforelse





                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

@endsection


