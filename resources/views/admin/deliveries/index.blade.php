@extends('layouts.admin')

@section('content')

<!-- Page Header -->
        <div class="row ">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">{{ __('delivery.manage_deliveries') }}</h4>

                    <div class="page-title-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.deliveries.index') }}">{{ __('delivery.manage_deliveries') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->


    <!-- deliveries table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="card-head d-flex justify-content-between">
                        <div class="head">
                            <h4 class="card-title"><i class="fas fa-shipping-fast"></i> {{ __('delivery.delivery_data') }}</h4>
                            <p class="card-title-desc">
                                {{ __('delivery.delivery_description') }}
                            </p>
                        </div>

                        <div class="button-items">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.deliveries.create') }}">
                               <i class="ri-truck-line align-middle me-2"></i> {{ __('delivery.add_new_delivery') }}
                            </a>
                        </div>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('delivery.package') }}</th>
                                <th>{{ __('delivery.driver') }}</th>
                                <th>{{ __('delivery.status') }}</th>
                                <th>{{ __('delivery.assigned_at') }}</th>
                                <th>{{ __('delivery.delivered_at') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th>{{ __('general.the_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deliveries as $delivery)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $delivery->package->tracking_number ?? '-' }}
                                        <br>
                                        <small>{{ $delivery->package->receiver_first_name ?? '' }} {{ $delivery->package->receiver_last_name ?? '' }}</small>
                                    </td>
                                    <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $delivery->driver->driver_full_name ?? '' }} , {{ $delivery->driver->phone ?? '' }}">
                                        @if($delivery->driver)
                                            <a href="{{ route('admin.drivers.show', $delivery->driver->id) }}">
                                                {{ Str::words($delivery->driver->driver_full_name, 2, '') }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>



                                 <td>
                                    @php
                                        $color = match($delivery->status) {
                                            'delivered'         => 'success',
                                            'on_route'          => 'warning',
                                            'assigned_to_driver'=> 'info',
                                            'pending'           => 'secondary',
                                            'in_transit'        => 'primary',
                                            'cancelled'         => 'dark',
                                            'returned'          => 'danger',
                                            default             => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $color }}">
                                        {{ __('delivery.status_' . $delivery->status) }}
                                    </span>
                                </td>

                                    <td>{{ $delivery->assigned_at ? $delivery->assigned_at->diffForHumans() : '-' }}</td>
                                    <td>{{ $delivery->delivered_at ? $delivery->delivered_at->diffForHumans() : '-' }}</td>
                                    <td>{{ $delivery->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('general.operations') }} <i class="mdi mdi-dots-vertical ms-2"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @ability('admin', 'show_deliveries')
                                                    <a class="dropdown-item" href="{{ route('admin.deliveries.show', $delivery->id) }}">{{ __('general.show') }}</a>
                                                @endability

                                                @ability('admin', 'update_deliveries')
                                                    <a class="dropdown-item" href="{{ route('admin.deliveries.edit', $delivery->id) }}">{{ __('general.edit') }}</a>
                                                @endability

                                                @ability('admin', 'delete_deliveries')
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onclick="confirmDelete('delete-delivery-{{ $delivery->id }}',
                                                            '{{ __('panel.confirm_delete_message') }}',
                                                            '{{ __('panel.yes_delete') }}',
                                                            '{{ __('panel.cancel') }}')">
                                                        {{ __('general.delete') }}
                                                    </a>
                                                    <form action="{{ route('admin.deliveries.destroy', $delivery->id) }}"
                                                          method="post" class="d-none"
                                                          id="delete-delivery-{{ $delivery->id }}">
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
