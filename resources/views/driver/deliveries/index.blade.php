@extends('layouts.driver')

@section('content')

<!-- Page Header -->
<div class="row ">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('delivery.manage_deliveries') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('driver.deliveries.index') }}">{{ __('delivery.manage_deliveries') }}</a></li>
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

                        {{-- <div class="button-items">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('driver.deliveries.create') }}">
                               <i class="ri-truck-line align-middle me-2"></i> {{ __('delivery.add_new_delivery') }}
                            </a>
                        </div> --}}
                    </div>

                    <!-- Filters Section -->
                        @include('driver.deliveries.filter.filter')
                    <!-- End Filters Section -->

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
                                <th>{{ __('general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deliveries as $delivery)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        @if($delivery->package)
                                            {{-- <a href="{{ route('driver.packages.show', $delivery->package->id) }}"> --}}
                                            <a href="#">
                                                {{ $delivery->package->tracking_number ?? '-' }}
                                                <br>
                                                <small>{{ $delivery->package->receiver_first_name ?? '' }} {{ $delivery->package->receiver_last_name ?? '' }}</small>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $delivery->driver->driver_full_name ?? '' }} , {{ $delivery->driver->phone ?? '' }}">
                                        @if($delivery->driver)
                                            {{-- <a href="{{ route('driver.drivers.show', $delivery->driver->id) }}"> --}}
                                            <a href="#">
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
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog"></i> {{ __('general.operations') }}
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                @ability('driver', 'show_deliveries')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('driver.deliveries.show', $delivery->id) }}">
                                                        <i class="fas fa-eye me-2"></i>{{ __('general.show') }}
                                                    </a>
                                                </li>
                                                @endability

                                                @ability('driver', 'update_deliveries')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('driver.deliveries.edit', $delivery->id) }}">
                                                        <i class="fas fa-edit me-2"></i>{{ __('general.edit') }}
                                                    </a>
                                                </li>
                                                @endability

                                                @ability('driver', 'delete_deliveries')
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                    onclick="confirmDelete('delete-delivery-{{ $delivery->id }}',
                                                                            '{{ __('panel.confirm_delete_message') }}',
                                                                            '{{ __('panel.yes_delete') }}',
                                                                            '{{ __('panel.cancel') }}')">
                                                        <i class="fas fa-trash-alt me-2"></i>{{ __('general.delete') }}
                                                    </a>
                                                    <form id="delete-delivery-{{ $delivery->id }}"
                                                        action="{{ route('driver.deliveries.destroy', $delivery->id) }}"
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
