@extends('layouts.admin')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('rental.manage_rentals') }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('rental.view_rentals') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('rental.manage_rentals') }}</li>
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
                        <h4 class="card-title"><i class="fas fa-warehouse"></i> {{ __('rental.rental_data') }}</h4>
                        <p class="card-title-desc">{{ __('rental.rental_description') }}</p>
                    </div>
                    <div class="button-items">
                        <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.warehouse_rentals.create') }}">
                            {{ __('rental.add_new_rental') }}
                            <i class="mdi mdi-clipboard-text-outline"></i>
                        </a>
                    </div>
                </div>

                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('rental.merchant') }}</th>
                            <th>{{ __('rental.rental_start') }}</th>
                            <th>{{ __('rental.rental_end') }}</th>
                            <th>{{ __('rental.shelves_count') }}</th>
                            <th>{{ __('rental.price') }}</th>
                            <th>{{ __('rental.status') }}</th>
                            <th>{{ __('general.created_at') }}</th>
                            <th>{{ __('general.the_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($warehouse_rentals as $rental)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rental->merchant->name ?? '-' }}</td>
                                <td>{{ $rental->rental_start }}</td>
                                <td>{{ $rental->rental_end }}</td>
                                <td>{{ $rental->shelves->count() }}</td>
                                <td>{{ $rental->price }}</td>
                                <td>
                                    {!! $rental->statusLabel !!}
                                </td>
                                <td>{{ $rental->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                            {{ __('general.operations') }}
                                        </button>
                                        <div class="dropdown-menu">
                                            @ability('admin', 'show_warehouse_rentals')
                                                <a class="dropdown-item" href="{{ route('admin.warehouse_rentals.show', $rental->id) }}">{{ __('general.show') }}</a>
                                            @endability

                                            @ability('admin', 'update_warehouse_rentals')
                                                <a class="dropdown-item" href="{{ route('admin.warehouse_rentals.edit', $rental->id) }}">{{ __('general.edit') }}</a>
                                            @endability

                                            @ability('admin', 'delete_warehouse_rentals')
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                   onclick="confirmDelete('delete-rental-{{ $rental->id }}',
                                                       '{{ __('panel.confirm_delete_message') }}',
                                                       '{{ __('panel.yes_delete') }}',
                                                       '{{ __('panel.cancel') }}')">
                                                    {{ __('general.delete') }}
                                                </a>
                                                <form id="delete-rental-{{ $rental->id }}" method="POST" action="{{ route('admin.warehouse_rentals.destroy', $rental->id) }}" class="d-none">
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
    </div>
</div>

@endsection
