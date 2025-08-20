@extends('layouts.admin')

@section('content')


    <div class="container-fluid">
        <!-- Breadcrumb with Gradient Background -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between p-3 bg-white shadow-sm rounded-3 border-start border-primary border-4">
                    <div>
                        <h4 class="text-dark mb-0">
                            <i class="fas fa-file-contract text-primary me-2"></i>
                            {{ __('rental.show_rental') }} #{{ $warehouseRental->id }}
                        </h4>
                    </div>
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 bg-transparent p-0">
                                <li class="breadcrumb-item">
                                    <a class="text-muted" href="{{ route('admin.index') }}">
                                        <i class="fas fa-home me-1 text-primary"></i>
                                        {{ __('general.main') }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-muted" href="{{ route('admin.warehouse_rentals.index') }}">
                                        {{ __('rental.manage_rentals') }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active text-dark" aria-current="page">
                                    {{ __('rental.show_rental') }} #{{ $warehouseRental->id }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Rental Card -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <h5 class="card-title mb-0 d-flex align-items-center">
                            <i class="fas fa-file-contract me-2"></i>
                            {{ __('rental.rental_details') }} #{{ $warehouseRental->id }}
                        </h5>
                        <div class="small mt-1">
                            {!! $warehouseRental->status_label !!}
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Contract Details -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card bg-light border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="text-muted mb-2">{{ __('merchant.name') }}</h6>
                                        <p class="fw-semibold mb-0 fs-5">
                                            <i class="fas fa-user-tie me-2 text-primary"></i>
                                            {{ $warehouseRental->merchant->name ?? __('general.not_specified') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card bg-light border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="text-muted mb-2">{{ __('general.total_price') }}</h6>
                                        <p class="fw-semibold mb-0 fs-5 text-success">
                                            <i class="fas fa-money-bill-wave me-2"></i>
                                            {{ $warehouseRental->price }} {{ __('general.sar') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rental Dates -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card bg-light border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-2">{{ __('rental.rental_start') }}</h6>
                                        <p class="fw-semibold mb-0">
                                            <i class="far fa-calendar-alt me-2 text-primary"></i>
                                            {{ $warehouseRental->rental_start?->format('Y-m-d') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="text-muted mb-2">{{ __('rental.rental_end') }}</h6>
                                        <p class="fw-semibold mb-0">
                                            <i class="far fa-calendar-alt me-2 text-primary"></i>
                                            {{ $warehouseRental->rental_end?->format('Y-m-d') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rented Shelves Section -->
                        @if($warehouseRental->shelves->isNotEmpty())
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <h5 class="mb-0 me-2">
                                        <i class="fas fa-warehouse text-info me-2"></i>
                                        {{ __('rental.rented_shelves') }}
                                    </h5>
                                    <span class="badge bg-primary rounded-pill">{{ $warehouseRental->shelves->count() }}</span>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover table-borderless">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{ __('warehouse.name') }}</th>
                                                <th>{{ __('shelf.code') }}</th>
                                                <th class="text-center">{{ __('general.size') }}</th>
                                                <th class="text-end">{{ __('general.price') }}</th>
                                                <th class="text-center">{{ __('rental.custom_start') }}</th>
                                                <th class="text-center">{{ __('rental.custom_end') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($warehouseRental->shelves as $shelf)
                                                <tr>
                                                    <td>
                                                        <i class="fas fa-warehouse me-2 text-primary"></i>
                                                        {{ $shelf->warehouse->name ?? '-' }}
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-secondary">{{ $shelf->code }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-{{ $shelf->size === 'small' ? 'info' : ($shelf->size === 'medium' ? 'warning' : 'danger') }}">
                                                            {{ $shelf->size() }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end fw-bold text-success">
                                                        {{ $shelf->pivot->custom_price }} {{ __('general.sar') }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ \Carbon\Carbon::parse($shelf->pivot->custom_start)->format('Y-m-d') }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ \Carbon\Carbon::parse($shelf->pivot->custom_end)->format('Y-m-d') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <!-- Invoice Section -->
                        @if($warehouseRental->invoice)
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <h5 class="mb-0 me-2">
                                        <i class="fas fa-file-invoice-dollar text-success me-2"></i>
                                        {{ __('invoice.invoice_details') }}
                                    </h5>
                                    <span class="badge bg-{{ $warehouseRental->invoice->status === 'paid' ? 'success' : ($warehouseRental->invoice->status === 'partial' ? 'warning' : 'danger') }}">
                                        {{ __('invoice.status.' . $warehouseRental->invoice->status) }}
                                    </span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="text-muted">{{ __('invoice.invoice_number') }}:</span>
                                                    <strong class="text-dark">#{{ $warehouseRental->invoice->invoice_number }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="text-muted">{{ __('general.total_amount') }}:</span>
                                                    <strong class="text-dark">{{ $warehouseRental->invoice->total_amount }} {{ __('general.sar') }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="text-muted">{{ __('invoice.amount_paid') }}:</span>
                                                    <strong class="text-success">{{ $warehouseRental->invoice->payments->sum('amount') }} {{ __('general.sar') }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="text-muted">{{ __('invoice.issued_at') }}:</span>
                                                    <strong class="text-dark">{{ $warehouseRental->invoice->issued_at?->format('Y-m-d') }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="text-muted">{{ __('invoice.due_date') }}:</span>
                                                    <strong class="text-dark">{{ $warehouseRental->invoice->due_date?->format('Y-m-d') }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="text-muted">{{ __('invoice.remaining_amount') }}:</span>
                                                    <strong class="text-danger">{{ $warehouseRental->invoice->total_amount - $warehouseRental->invoice->payments->sum('amount') }} {{ __('general.sar') }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payments Table -->
                                @if($warehouseRental->invoice->payments->isNotEmpty())
                                    <div class="mt-4">
                                        <h6 class="mb-3">
                                            <i class="fas fa-credit-card me-2 text-primary"></i>
                                            {{ __('invoice.payments') }}
                                        </h6>

                                        <div class="table-responsive">
                                            <table class="table table-hover table-borderless">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>{{ __('payment.date') }}</th>
                                                        <th>{{ __('payment.amount') }}</th>
                                                        <th>{{ __('payment.method') }}</th>
                                                        <th>{{ __('payment.status') }}</th>
                                                        <th class="text-end">{{ __('general.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($warehouseRental->invoice->payments as $payment)
                                                        <tr>
                                                            <td>
                                                                <i class="far fa-calendar me-2 text-primary"></i>
                                                                {{ $payment->paid_on?->format('Y-m-d') }}
                                                            </td>
                                                            <td class="fw-bold text-success">
                                                                {{ $payment->amount }} {{ __('general.sar') }}
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-info">
                                                                    {{ __('payment.' . $payment->method) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-{{ $payment->status === 'completed' ? 'success' : 'warning' }}">
                                                                    {{ __('payment.' . $payment->status) }}
                                                                </span>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="btn-group" role="group">
                                                                    {{-- <a href="{{ route('admin.payments.edit', $payment->id) }}"
                                                                        class="btn btn-sm btn-outline-primary rounded-pill me-1">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a> --}}

                                                                    <button type="button"
                                                                            class="btn btn-sm btn-outline-primary rounded-pill me-1"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#editPaymentModal{{ $payment->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                    <form action="{{ route('admin.payments.destroy', $payment->id) }}"
                                                                        method="POST" class="d-inline"
                                                                        onsubmit="return confirm('{{ __('panel.confirm_delete_message') }}');">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-sm btn-outline-danger rounded-pill">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    @foreach($warehouseRental->invoice->payments as $payment)
                                                        <div class="modal fade" id="editPaymentModal{{ $payment->id }}" tabindex="-1" aria-labelledby="editPaymentModalLabel{{ $payment->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content border-0 shadow">
                                                                    <div class="modal-header bg-primary text-white">
                                                                        <h5 class="modal-title" id="editPaymentModalLabel{{ $payment->id }}">
                                                                            <i class="fas fa-edit me-2"></i>
                                                                            {{ __('payment.edit_payment') }} #{{ $payment->id }}
                                                                        </h5>
                                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="row g-3">
                                                                                <div class="col-md-6">
                                                                                    <label for="amount{{ $payment->id }}" class="form-label">{{ __('payment.amount') }}</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text">{{ config('settings.currency_symbol') }}</span>
                                                                                        <input type="number" name="amount" id="amount{{ $payment->id }}" class="form-control"
                                                                                            step="0.01" min="1"
                                                                                            value="{{ $payment->amount }}" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="method{{ $payment->id }}" class="form-label">{{ __('payment.method') }}</label>
                                                                                    <select name="method" id="method{{ $payment->id }}" class="form-select" required>
                                                                                        <option value="cash" {{ $payment->method == 'cash' ? 'selected' : '' }}>{{ __('payment.cash') }}</option>
                                                                                        <option value="credit_card" {{ $payment->method == 'credit_card' ? 'selected' : '' }}>{{ __('payment.credit_card') }}</option>
                                                                                        <option value="bank_transfer" {{ $payment->method == 'bank_transfer' ? 'selected' : '' }}>{{ __('payment.bank_transfer') }}</option>
                                                                                        <option value="wallet" {{ $payment->method == 'wallet' ? 'selected' : '' }}>{{ __('payment.wallet') }}</option>
                                                                                        <option value="cod" {{ $payment->method == 'cod' ? 'selected' : '' }}>{{ __('payment.cod') }}</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <label for="reference_note{{ $payment->id }}" class="form-label">{{ __('payment.reference_note') }}</label>
                                                                                    <textarea name="reference_note" id="reference_note{{ $payment->id }}" class="form-control" rows="3">{{ $payment->reference_note }}</textarea>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="payment_reference{{ $payment->id }}" class="form-label">{{ __('payment.payment_reference') }}</label>
                                                                                    <input type="text" name="payment_reference" id="payment_reference{{ $payment->id }}" class="form-control" value="{{ $payment->payment_reference }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer border-top-0">
                                                                                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                                                                                    <i class="fas fa-times me-1"></i> {{ __('payment.cancel') }}
                                                                                </button>
                                                                                <button type="submit" class="btn btn-primary rounded-pill">
                                                                                    <i class="fas fa-save me-1"></i> {{ __('payment.update_payment') }}
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                @php
                                    $invoice = $warehouseRental->invoice;
                                    $paid = $invoice ? $invoice->payments->sum('amount') : 0;
                                    $remaining = $invoice ? max(0, $invoice->total_amount - $paid) : $rental->price;
                                @endphp

                                 <!-- Action Buttons -->
                                <div class="d-flex flex-wrap gap-2">
                                    @if($invoice)
                                        <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-outline-primary  rounded-pill">
                                            <i class="fas fa-file-invoice me-1"></i>
                                            {{ __('invoice.show_invoice') }}
                                        </a>
                                    @endif

                                    <a href="{{ route('admin.warehouse_rentals.edit', $warehouseRental->id) }}" class="btn btn-outline-secondary  rounded-pill">
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



                                    <div class="d-flex gap-2">
                                        <!-- زر عرض الوثيقة -->
                                        <a href="{{ route('admin.warehouse_rentals.contracts.view', $warehouseRental->id) }}" target="_blank" class="btn btn-info">
                                            <i class="fa fa-eye"></i>  {{ __('rental.show_contract') }}
                                        </a>

                                        <!-- زر تنزيل الوثيقة -->
                                        {{-- <a href="{{ route('admin.warehouse_rentals.contracts.download', $warehouseRental->id) }}" class="btn btn-success">
                                            <i class="fa fa-download"></i> تنزيل العقد
                                        </a> --}}
                                    </div>

                                </div>


                            </div>
                        @endif
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.warehouse_rentals.index') }}" class="btn btn-outline-secondary rounded-pill">
                            <i class="fas fa-arrow-left me-1"></i> {{ __('general.back') }}
                        </a>

                        <div class="d-flex gap-2">
                            @ability('admin', 'update_warehouse_rentals')
                                <a href="{{ route('admin.warehouse_rentals.edit', $warehouseRental->id) }}"
                                   class="btn btn-primary rounded-pill">
                                    <i class="fas fa-edit me-1"></i> {{ __('general.update') }}
                                </a>
                            @endability

                            @ability('admin', 'delete_warehouse_rentals')
                                <a href="javascript:void(0)" class="btn btn-danger rounded-pill"
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
    </div>


    @if($invoice)
        <div class="modal fade" id="paymentModal{{ $invoice->id }}" tabindex="-1" aria-labelledby="paymentModalLabel{{ $invoice->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="paymentModalLabel{{ $invoice->id }}">
                            <i class="fas fa-money-bill-wave me-2"></i>
                            {{ __('payment.add_payment') }} - {{ __('invoice.invoice_number') }}: #{{ $invoice->invoice_number }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{ __('payment.cancel') }}"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('admin.invoices.pay', $invoice->id) }}" method="POST"> --}}
                        <form action="{{ route('admin.payments.store', $invoice->id) }}" method="POST">
                            @csrf

                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                            <input type="hidden" name="merchant_id" value="{{ $invoice->merchant_id }}">


                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="amount{{ $invoice->id }}" class="form-label">{{ __('payment.amount') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text">{{ config('settings.currency_symbol') }}</span>
                                        <input type="number" name="amount" id="amount{{ $invoice->id }}" class="form-control"
                                            step="0.01" min="1"
                                            max="{{ $invoice->total_amount - $invoice->payments->sum('amount') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="method{{ $invoice->id }}" class="form-label">{{ __('payment.method') }}</label>
                                    <select name="method" id="method{{ $invoice->id }}" class="form-select" required>
                                        <option value="">{{ __('payment.choose_method') }}</option>
                                        <option value="cash">{{ __('payment.cash') }}</option>
                                        <option value="credit_card">{{ __('payment.credit_card') }}</option>
                                        <option value="bank_transfer">{{ __('payment.bank_transfer') }}</option>
                                        <option value="wallet">{{ __('payment.wallet') }}</option>
                                        <option value="cod">{{ __('payment.cod') }}</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="reference_note{{ $invoice->id }}" class="form-label">{{ __('payment.reference_note') }}</label>
                                    <textarea name="reference_note" id="reference_note{{ $invoice->id }}" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="payment_reference{{ $invoice->id }}" class="form-label">{{ __('payment.payment_reference') }}</label>
                                    <input type="text" name="payment_reference" id="payment_reference{{ $invoice->id }}" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer border-top-0">
                                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-1"></i> {{ __('payment.cancel') }}
                                </button>
                                <button type="submit" class="btn btn-success rounded-pill">
                                    <i class="fas fa-save me-1"></i> {{ __('payment.save_payment') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'نجاح',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 5000
            })
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'خطأ',
                text: "{{ session('error') }}",
                showConfirmButton: true
            })
        </script>
    @endif

@endsection
