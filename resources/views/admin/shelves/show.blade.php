@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('general.shelf_details') }} #{{ $shelf->id }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.shelves.index') }}">{{ __('general.shelves') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('general.shelf') }} #{{ $shelf->id }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Shelf & Rental Info -->
    <div class="row">
        <!-- Shelf Info -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('general.shelf_information') }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>{{ __('general.id') }}:</strong> {{ $shelf->id }}</p>
                    <p><strong>{{ __('general.size') }}:</strong> {{ $shelf->size() }}</p>
                    <p><strong>{{ __('general.price') }}:</strong> {{ $shelf->price }} {{ __('shelf.initial_price_per_day') }}</p>
                    <p><strong>{{ __('general.warehouse') }}:</strong>
                        <a href="{{ route('admin.warehouses.show', $shelf->warehouse->id) }}">
                            {{ $shelf->warehouse->name }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Rental Info -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('general.rental_information') }}</h5>
                </div>
                <div class="card-body">
                    @if($shelf->rentals->isNotEmpty())
                        @php
                            $rental = $shelf->rentals->last(); // آخر عقد مرتبط بالرف

                            // حساب عدد الأيام والفترة
                            $start = \Carbon\Carbon::parse($rental->pivot->custom_start ?? $rental->start_date);
                            $end = \Carbon\Carbon::parse($rental->pivot->custom_end ?? $rental->end_date);
                            $days = $end->diffInDays($start) + 1;

                        @endphp

                         @php
                            // الفاتورة المرتبطة (إن وجدت)
                            $invoice = $rental->invoice;
                            $paid = $invoice ? $invoice->payments->sum('amount') : 0;
                            $remaining = $invoice ? max(0, $invoice->total_amount - $paid) : $rental->price;
                        @endphp

                        <p><strong>{{ __('general.contract_number') }}:</strong>
                            <a href="{{ route('admin.warehouse_rentals.show', $rental->id) }}">
                                {{ $rental->id }}
                            </a>
                        </p>
                        <p><strong>{{ __('general.merchant') }}:</strong> {{ $rental->merchant->name ?? __('general.unknown') }}</p>
                        <p><strong>{{ __('general.start_date') }}:</strong> {{ $start->format('Y-m-d') }}</p>
                        <p><strong>{{ __('general.end_date') }}:</strong> {{ $end->format('Y-m-d') }}</p>

                           <div class="mb-3">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <p><strong>{{ __('invoice.total_amount') }}:</strong> {{ number_format($invoice->total_amount ?? $rental->price, 2) }}</p>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="text-success"><strong>{{ __('invoice.amount_paid') }}:</strong> {{ number_format($paid, 2) }}</p>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <p class="text-danger"><strong>{{ __('invoice.remaining_amount') }}:</strong> {{ number_format($remaining, 2) }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                    @else
                        <p class="text-muted">{{ __('general.not_rented') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Items -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('general.stock_items') }}</h5>
                </div>
                <div class="card-body">
                    @if($shelf->stockItems->isNotEmpty())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('general.item_name') }}</th>
                                    <th>{{ __('general.quantity') }}</th>
                                    <th>{{ __('general.added_on') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shelf->stockItems as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">{{ __('general.no_items') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
