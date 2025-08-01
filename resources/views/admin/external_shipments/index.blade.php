@extends('layouts.admin')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('external_shipment.manage_external_shipments') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('external_shipment.view_external_shipments') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('external_shipment.manage_external_shipments') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- external shipments table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="card-head d-flex justify-content-between">
                        <div class="head">
                            <h4 class="card-title"><i class="fas fa-shipping-fast"></i> {{ __('external_shipment.external_shipment_data') }}</h4>
                            <p class="card-title-desc">
                                {{ __('external_shipment.external_shipment_description') }}
                            </p>
                        </div>

                        <div class="button-items">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin.external_shipments.create') }}">
                                {{ __('external_shipment.add_new_external_shipment') }} <i class="ri-truck-line align-middle ms-2"></i>
                            </a>
                        </div>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('external_shipment.package') }}</th>
                                <th>{{ __('external_shipment.shipping_partner') }}</th>
                                <th>{{ __('external_shipment.external_tracking_number') }}</th>
                                <th>{{ __('external_shipment.status') }}</th>
                                <th>{{ __('external_shipment.delivery_date') }}</th>
                                <th>{{ __('general.created_at') }}</th>
                                <th>{{ __('general.the_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($shipments as $shipment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $shipment->package->tracking_number ?? '-' }}
                                        <br>
                                        <small>{{ $shipment->package->receiver_first_name ?? '' }} {{ $shipment->package->receiver_last_name ?? '' }}</small>
                                    </td>
                                    <td>
                                        {{ $shipment->shippingPartner->name ?? '-' }}
                                    </td>
                                    <td>{{ $shipment->external_tracking_number ?? '-' }}</td>
                                    <td>
                                        @if ($shipment->status == 'delivered')
                                            <span class="badge bg-success">{{ __('external_shipment.status_delivered') }}</span>
                                        @elseif ($shipment->status == 'in_transit')
                                            <span class="badge bg-warning">{{ __('external_shipment.status_in_transit') }}</span>
                                        @elseif ($shipment->status == 'cancelled')
                                            <span class="badge bg-danger">{{ __('external_shipment.status_cancelled') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('external_shipment.status_pending') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $shipment->delivery_date ? $shipment->delivery_date->diffForHumans() : '-' }}</td>
                                    <td>{{ $shipment->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('general.operations') }} <i class="mdi mdi-dots-vertical ms-2"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @ability('admin', 'show_external_shipments')
                                                    <a class="dropdown-item" href="{{ route('admin.external_shipments.show', $shipment->id) }}">{{ __('general.show') }}</a>
                                                @endability

                                                @ability('admin', 'update_external_shipments')
                                                    <a class="dropdown-item" href="{{ route('admin.external_shipments.edit', $shipment->id) }}">{{ __('general.edit') }}</a>
                                                @endability

                                                @ability('admin', 'delete_external_shipments')
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onclick="confirmDelete('delete-shipment-{{ $shipment->id }}',
                                                            '{{ __('panel.confirm_delete_message') }}',
                                                            '{{ __('panel.yes_delete') }}',
                                                            '{{ __('panel.cancel') }}')">
                                                        {{ __('general.delete') }}
                                                    </a>
                                                    <form action="{{ route('admin.external_shipments.destroy', $shipment->id) }}"
                                                          method="post" class="d-none"
                                                          id="delete-shipment-{{ $shipment->id }}">
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
