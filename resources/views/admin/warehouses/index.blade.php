@extends('layouts.admin')

@section('content')

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('warehouse.manage_warehouses') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('warehouse.view_warehouses') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('warehouse.manage_warehouses') }}</li>
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

                                <h4 class="card-title"> <i class="fas fa-eye"></i> {{ __('warehouse.warehouse_data') }}</h4>
                                <p class="card-title-desc">
                                    {{ __('warehouse.warehouse_description') }}
                                </p>
                            </div>

                            <div class="button-items">
                                   <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.warehouses.create') }}">
                                        {{ __('warehouse.add_new_warehouse') }} <i class=" ri-user-add-line align-middle ms-2"></i>
                                   </a>
                            </div>

                        </div>

                        <!-- Filters Section -->
                        @include('admin.warehouses.filter.filter')
                        <!-- End Filters Section -->


                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('warehouse.name') }}</th>
                                <th>{{ __('warehouse.location') }}</th>
                                <th>{{ __('warehouse.manager') }}</th>
                                <th>{{ __('general.status') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th>{{ __('general.the_actions') }}</th>
                            </tr>
                            </thead>


                            <tbody>

                            @forelse ($warehouses as $warehouse)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($warehouse->name ?? '', 15) }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($warehouse->location ?? '', 25) }} </td>
                                    <td>{{ \Illuminate\Support\Str::limit($warehouse->manager ?? '', 15) }} </td>
                                    <td>
                                        @if ($warehouse->status == 1)
                                            <a href="javascript:void(0);" class="updateWarehouseStatus"
                                                id="warehouse-{{ $warehouse->id }}" warehouse_id="{{ $warehouse->id }}">
                                                <i class="fas fa-toggle-on fa-lg text-success" aria-hidden="true"
                                                    status="Active" style="font-size: 1.6em"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0);" class="updateWarehouseStatus" id="warehouse-{{ $warehouse->id }}"
                                                warehouse_id="{{ $warehouse->id }}">
                                                <i class="fas fa-toggle-off fa-lg text-warning" aria-hidden="true"
                                                    status="Inactive" style="font-size: 1.6em"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $warehouse->created_at->diffForHumans() }}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">

                                                @ability('admin', 'show_warehouses')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.warehouses.show', $warehouse->id) }}">
                                                        <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                    </a>
                                                </li>
                                                @endability

                                                @ability('admin', 'update_warehouses')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.warehouses.edit', $warehouse->id) }}">
                                                        <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                    </a>
                                                </li>
                                                @endability

                                                @ability('admin', 'delete_warehouses')
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                                                    onclick="confirmDelete('delete-warehouse-{{ $warehouse->id }}',
                                                                                '{{ __('panel.confirm_delete_message') }}',
                                                                                '{{ __('panel.yes_delete') }}',
                                                                                '{{ __('panel.cancel') }}')">
                                                        <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                    </a>
                                                    <form action="{{ route('admin.warehouses.destroy', $warehouse->id) }}"
                                                        method="post" class="d-none"
                                                        id="delete-warehouse-{{ $warehouse->id }}">
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
                                <td colspan="5" class="text-center">{{ __('panel.no_found_item') }}</td>
                            </tr>
                            @endforelse





                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

@endsection


