@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card shadow border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-white py-3">
                <h4 class="mb-0">{{ __('rental.rental_details') }} #{{ $warehouseRental->id }}</h4>
                <div class="small mt-1">
                    {!! $warehouseRental->status_label !!}
                </div>
            </div>

            <div class="card-body">
                <div class="mb-4">
                    <h6 class="text-muted">{{ __('merchant.name') }}</h6>
                    <p class="fw-semibold">{{ $warehouseRental->merchant->name ?? __('general.not_specified') }}</p>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">
                            <h6 class="text-muted mb-1">{{ __('rental.rental_start') }}</h6>
                            <p class="fw-semibold">{{ $warehouseRental->rental_start?->format('Y-m-d') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">
                            <h6 class="text-muted mb-1">{{ __('rental.rental_end') }}</h6>
                            <p class="fw-semibold">{{ $warehouseRental->rental_end?->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted">{{ __('general.total_price') }}</h6>
                    <p class="fw-semibold">{{ $warehouseRental->price }} {{ __('general.currency') }}</p>
                </div>

                @if($warehouseRental->shelves->isNotEmpty())
                    <hr>
                    <h5 class="mb-3"><i class="fas fa-warehouse me-2"></i> {{ __('rental.rented_shelves') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('warehouse.name') }}</th>
                                    <th>{{ __('shelf.code') }}</th>
                                    <th>{{ __('general.size') }}</th>
                                    <th>{{ __('general.price') }}</th>
                                    <th>{{ __('rental.custom_start') }}</th>
                                    <th>{{ __('rental.custom_end') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($warehouseRental->shelves as $shelf)
                                    <tr>
                                        <td>{{ $shelf->warehouse->name ?? '-' }}</td>
                                        <td>{{ $shelf->code }}</td>
                                        <td>{{ $shelf->size() }}</td>
                                        <td>{{ $shelf->pivot->custom_price }} {{ __('general.currency') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($shelf->pivot->custom_start)->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($shelf->pivot->custom_end)->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="card-footer bg-light d-flex justify-content-between">
                <a href="{{ route('admin.warehouse_rentals.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> {{ __('general.back') }}
                </a>
                <div>
                    @ability('admin', 'update_warehouse_rentals')
                        <a href="{{ route('admin.warehouse_rentals.edit', $warehouseRental->id) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-1"></i> {{ __('general.update') }}
                        </a>
                    @endability
                    @ability('admin', 'delete_warehouse_rentals')
                        <a href="javascript:void(0)" class="btn btn-danger"
                           onclick="confirmDelete('delete-rental-{{ $warehouseRental->id }}',
                                                 '{{ __('panel.confirm_delete_message') }}',
                                                 '{{ __('panel.yes_delete') }}',
                                                 '{{ __('panel.cancel') }}')">
                            <i class="fas fa-trash me-1"></i> {{ __('general.delete') }}
                        </a>
                        <form action="{{ route('admin.warehouse_rentals.destroy', $warehouseRental->id) }}"
                              method="post" class="d-none" id="delete-rental-{{ $warehouseRental->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endability
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
