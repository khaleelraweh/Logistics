@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-9 mx-auto">
        <div class="card shadow border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-white py-3">
                <h4 class="mb-0">{{ __('stock-item.item_details') }} #{{ $stockItem->id }}</h4>
                <div class="small mt-1">
                    <span class="badge bg-{{ $stockItem->status ? 'success' : 'danger' }}">
                        {{ $stockItem->status ? __('general.active') : __('general.inactive') }}
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-muted">{{ __('merchant.name') }}</h6>
                    <p class="fw-semibold">{{ $stockItem->merchant->name ?? '-' }}</p>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted">{{ __('product.name') }}</h6>
                    <p class="fw-semibold">{{ $stockItem->product->name ?? '-' }}</p>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted">{{ __('stock-item.quantity') }}</h6>
                    <p class="fw-semibold">{{ $stockItem->quantity }}</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted">{{ __('general.published_on') }}</h6>
                    <p class="fw-semibold">{{ $stockItem->published_on?->format('Y-m-d') ?? '-' }}</p>
                </div>

                @if($stockItem->rentalShelf)
                    <hr>
                    <h5 class="mb-3"><i class="fas fa-warehouse me-2"></i> {{ __('rental.shelf_info') }}</h5>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="p-2 bg-light rounded">
                                <h6 class="text-muted mb-1">{{ __('shelf.code') }}</h6>
                                <p class="fw-semibold">{{ $stockItem->rentalShelf->shelf->code ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="p-2 bg-light rounded">
                                <h6 class="text-muted mb-1">{{ __('warehouse.name') }}</h6>
                                <p class="fw-semibold">{{ $stockItem->rentalShelf->shelf->warehouse->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="p-2 bg-light rounded">
                                <h6 class="text-muted mb-1">{{ __('rental.custom_start') }}</h6>
                                <p class="fw-semibold">
                                    {{ $stockItem->rentalShelf?->custom_start
                                        ? \Carbon\Carbon::parse($stockItem->rentalShelf->custom_start)->format('Y-m-d')
                                        : '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="p-2 bg-light rounded">
                                <h6 class="text-muted mb-1">{{ __('rental.custom_end') }}</h6>
                                <p class="fw-semibold">
                                    {{ $stockItem->rentalShelf?->custom_end
                                        ? \Carbon\Carbon::parse($stockItem->rentalShelf->custom_end)->format('Y-m-d')
                                        : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="card-footer bg-light d-flex justify-content-between">
                <a href="{{ route('admin.stock_items.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> {{ __('general.back') }}
                </a>
                <div>
                    @ability('admin', 'update_stock_items')
                        <a href="{{ route('admin.stock_items.edit', $stockItem->id) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-1"></i> {{ __('general.update') }}
                        </a>
                    @endability
                    @ability('admin', 'delete_stock_items')
                        <a href="javascript:void(0)" class="btn btn-danger"
                           onclick="confirmDelete('delete-stockItem-{{ $stockItem->id }}',
                                                 '{{ __('panel.confirm_delete_message') }}',
                                                 '{{ __('panel.yes_delete') }}',
                                                 '{{ __('panel.cancel') }}')">
                            <i class="fas fa-trash me-1"></i> {{ __('general.delete') }}
                        </a>
                        <form action="{{ route('admin.stock_items.destroy', $stockItem->id) }}"
                              method="post" class="d-none" id="delete-stockItem-{{ $stockItem->id }}">
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
