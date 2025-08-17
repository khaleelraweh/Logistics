@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb with Gradient Background -->
    <div class="row mb-4">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between p-3 bg-white shadow-sm rounded-3 border-start border-primary border-4">
            <div>
                <h4 class="text-dark mb-0">
                    <i class="fas fa-pallet text-primary me-2"></i>
                    {{ __('shelf.shelf_details') }} #{{ $shelf->id }}
                </h4>
            </div>
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a class="text-muted" href="{{ route('admin.shelves.index') }}">
                                <i class="fas fa-chevron-left me-1 text-primary"></i>
                                {{ __('shelf.shelves') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">
                            {{ __('shelf.shelf') }} #{{ $shelf->id }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

    <!-- Shelf & Rental Info Cards -->
    <div class="row g-4">
        <!-- Shelf Info Card -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="fas fa-pallet me-2"></i>
                        {{ __('shelf.shelf_information') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th class="w-25">{{ __('shelf.id') }}:</th>
                                    <td>
                                        <span class="badge bg-secondary">{{ $shelf->id }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('shelf.size') }}:</th>
                                    <td>
                                        <span class="badge bg-{{ $shelf->size === 'small' ? 'info' : ($shelf->size === 'medium' ? 'warning' : 'danger') }}">
                                            {{ $shelf->size() }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('shelf.price') }}:</th>
                                    <td>
                                        <span class="fw-bold text-success">{{ $shelf->price }}</span>
                                        <small class="text-muted">{{ __('shelf.initial_price_per_day') }}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('shelf.warehouse') }}:</th>
                                    <td>
                                        <a href="{{ route('admin.warehouses.show', $shelf->warehouse->id) }}" class="text-decoration-none">
                                            <i class="fas fa-warehouse me-1 text-primary"></i>
                                            {{ $shelf->warehouse->name }}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rental Info Card -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-{{ $shelf->rentals->isNotEmpty() ? 'success' : 'secondary' }} text-white py-3">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="fas fa-file-contract me-2"></i>
                        {{ __('shelf.rental_information') }}
                    </h5>
                </div>
                <div class="card-body">
                    @php $invoice = null; @endphp

                    @if($shelf->rentals->isNotEmpty())
                        @php
                            $rental = $shelf->rentals->last();
                            $start = \Carbon\Carbon::parse($rental->pivot->custom_start ?? $rental->start_date);
                            $end = \Carbon\Carbon::parse($rental->pivot->custom_end ?? $rental->end_date);
                            $days = $end->diffInDays($start) + 1;
                            $invoice = $rental->invoice;
                            $paid = $invoice ? $invoice->payments->sum('amount') : 0;
                            $remaining = $invoice ? max(0, $invoice->total_amount - $paid) : $rental->price;
                        @endphp

                        <div class="table-responsive">
                            <table class="table table-borderless mb-3">
                                <tbody>
                                    <tr>
                                        <th class="w-25">{{ __('shelf.contract_number') }}:</th>
                                        <td>
                                            <a href="{{ route('admin.warehouse_rentals.show', $rental->id) }}" class="text-decoration-none">
                                                <i class="fas fa-file-alt me-1 text-primary"></i>
                                                {{ $rental->id }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('shelf.merchant') }}:</th>
                                        <td>
                                            <i class="fas fa-user-tie me-1 text-primary"></i>
                                            {{ $rental->merchant->name ?? __('shelf.unknown') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('shelf.start_date') }}:</th>
                                        <td>
                                            <i class="far fa-calendar-alt me-1 text-primary"></i>
                                            {{ $start->format('Y-m-d') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('shelf.end_date') }}:</th>
                                        <td>
                                            <i class="far fa-calendar-alt me-1 text-primary"></i>
                                            {{ $end->format('Y-m-d') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Payment Summary Cards -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="card bg-light shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <h6 class="card-subtitle mb-2 text-muted">{{ __('invoice.total_amount') }}</h6>
                                        <h5 class="card-title text-dark">{{ number_format($invoice->total_amount ?? $rental->price, 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-success-light shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <h6 class="card-subtitle mb-2 text-success">{{ __('invoice.amount_paid') }}</h6>
                                        <h5 class="card-title text-success">{{ number_format($paid, 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-danger-light shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <h6 class="card-subtitle mb-2 text-danger">{{ __('invoice.remaining_amount') }}</h6>
                                        <h5 class="card-title text-danger">{{ number_format($remaining, 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex flex-wrap gap-2">
                            @if($invoice)
                                <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                    <i class="fas fa-file-invoice me-1"></i>
                                    {{ __('invoice.show_invoice') }}
                                </a>
                            @endif

                            <a href="{{ route('admin.warehouse_rentals.edit', $rental->id) }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                                <i class="fas fa-edit me-1"></i>
                                {{ __('rental.edit_contract') }}
                            </a>

                            @if($invoice)
                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill"
                                        data-bs-toggle="modal" data-bs-target="#paymentModal{{ $invoice->id }}">
                                    <i class="fas fa-money-bill-wave me-1"></i>
                                    {{ __('payment.add_payment') }}
                                </button>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">{{ __('shelf.not_rented') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Items Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="fas fa-boxes me-2"></i>
                        {{ __('shelf.stock_items') }}
                    </h5>
                </div>
                <div class="card-body">
                    @if($shelf->stockItems->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('shelf.item_name') }}</th>
                                        <th class="text-center">{{ __('shelf.quantity') }}</th>
                                        <th class="text-end">{{ __('shelf.added_on') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shelf->stockItems as $item)
                                        <tr>
                                            <td>
                                                <i class="fas fa-box me-2 text-primary"></i>
                                                {{ $item->name }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary rounded-pill">{{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-end">
                                                {{ $item->created_at->format('Y-m-d') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">{{ __('shelf.no_items') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
@if($invoice)
<div class="modal fade" id="paymentModal{{ $invoice->id }}" tabindex="-1" aria-labelledby="paymentModalLabel{{ $invoice->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="paymentModalLabel{{ $invoice->id }}">
                    <i class="fas fa-money-bill-wave me-2"></i>
                    {{ __('payment.add_payment') }} - {{ __('invoice.invoice_number') }}: #{{ $invoice->invoice_number }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.invoices.pay', $invoice->id) }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="amount{{ $invoice->id }}" class="form-label">المبلغ</label>
                            <div class="input-group">
                                <span class="input-group-text">{{ config('settings.currency_symbol') }}</span>
                                <input type="number" name="amount" id="amount{{ $invoice->id }}" class="form-control"
                                       step="0.01" min="1"
                                       max="{{ $invoice->total_amount - $invoice->payments->sum('amount') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="method{{ $invoice->id }}" class="form-label">طريقة الدفع</label>
                            <select name="method" id="method{{ $invoice->id }}" class="form-select" required>
                                <option value="">اختر طريقة الدفع</option>
                                <option value="cash">نقداً</option>
                                <option value="credit_card">بطاقة ائتمان</option>
                                <option value="bank_transfer">تحويل بنكي</option>
                                <option value="wallet">المحفظة</option>
                                <option value="cod">الدفع عند الاستلام</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="reference_note{{ $invoice->id }}" class="form-label">ملاحظات</label>
                            <textarea name="reference_note" id="reference_note{{ $invoice->id }}" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="payment_reference{{ $invoice->id }}" class="form-label">رقم المرجع</label>
                            <input type="text" name="payment_reference" id="payment_reference{{ $invoice->id }}" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> إلغاء
                        </button>
                        <button type="submit" class="btn btn-success rounded-pill">
                            <i class="fas fa-save me-1"></i> حفظ الدفع
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
