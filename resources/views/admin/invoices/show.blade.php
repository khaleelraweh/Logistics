@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('invoice.invoice_details') }} #{{ $invoice->invoice_number }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">{{ __('invoice.invoices') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('invoice.invoice_details') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Summary Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card invoice-card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ __('invoice.info') }}</h5>
                    <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status == 'partial' ? 'warning' : 'danger') }}">
                        {{ __('invoice.status_'. $invoice->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted">{{ __('invoice.merchant') }}</h6>
                                <p class="font-size-16">{{ $invoice->merchant->name }}</p>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted">{{ __('invoice.issued_at') }}</h6>
                                <p class="font-size-16">{{ $invoice->issued_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted">{{ __('invoice.notes') }}</h6>
                                <p class="font-size-16">{{ $invoice->notes ?: __('invoice.no_notes') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted">{{ __('invoice.due_date') }}</h6>
                                <p class="font-size-16 {{ $invoice->due_date->isPast() && !$invoice->isPaid() ? 'text-danger' : '' }}">
                                    {{ $invoice->due_date->format('d/m/Y H:i') }}
                                    @if($invoice->due_date->isPast() && !$invoice->isPaid())
                                        <i class="fas fa-exclamation-triangle ms-2"></i>
                                    @endif
                                </p>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted">{{ __('invoice.currency') }}</h6>
                                <p class="font-size-16">{{ $invoice->currency }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Amount Summary -->
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card bg-light p-3 text-center">
                                <h6 class="text-muted">{{ __('invoice.total_amount') }}</h6>
                                <h4 class="text-primary">{{ number_format($invoice->total_amount, 2) }} {{ $invoice->currency }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light p-3 text-center">
                                <h6 class="text-muted">{{ __('invoice.paid_amount') }}</h6>
                                <h4 class="text-success">{{ number_format($invoice->paid_amount, 2) }} {{ $invoice->currency }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light p-3 text-center">
                                <h6 class="text-muted">{{ __('invoice.remaining_amount') }}</h6>
                                <h4 class="text-danger">{{ number_format($invoice->remaining_amount, 2) }} {{ $invoice->currency }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Section -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white">
                    <h5 class="card-title mb-0">{{ __('invoice.payment_history') }}</h5>
                    <span class="badge bg-white text-dark">{{ $invoice->payments->count() }} {{ __('invoice.payments') }}</span>
                </div>
                <div class="card-body">
                    @if($invoice->payments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="15%">{{ __('invoice.amount') }}</th>
                                        <th width="15%">{{ __('invoice.method') }}</th>
                                        <th width="15%">{{ __('invoice.paid_on') }}</th>
                                        <th width="35%">{{ __('invoice.notes') }}</th>
                                        <th width="20%">{{ __('invoice.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice->payments as $payment)
                                        <tr>
                                            <td class="fw-bold">{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ __('invoice.methods.'.$payment->method) }}
                                                </span>
                                            </td>
                                            <td>{{ $payment->paid_on?->format('d/m/Y H:i') ?? '-' }}</td>
                                            <td>{{ $payment->reference_note ?: '-' }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                <!-- زر تعديل -->
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editPaymentModal{{ $payment->id }}">
                                                    <i class="fas fa-pen-square "></i>
                                                </button>
                                                <!-- زر حذف -->
                                                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الدفعة؟');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash "></i></button>
                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal تعديل الدفعة -->
                                        <div class="modal fade" id="editPaymentModal{{ $payment->id }}" tabindex="-1" aria-labelledby="editPaymentModalLabel{{ $payment->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editPaymentModalLabel{{ $payment->id }}">{{ __('payment.edit_payment') }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('payment.amount') }}</label>
                                                                <input type="number" name="amount" class="form-control" value="{{ $payment->amount }}" step="0.01" min="0.01" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('payment.method') }} </label>
                                                                <select name="method" class="form-select" required>
                                                                    <option value="cash" {{ $payment->method == 'cash' ? 'selected' : '' }}>{{ __('payment.cash') }}</option>
                                                                    <option value="credit_card" {{ $payment->method == 'credit_card' ? 'selected' : '' }}>{{ __('payment.credit_card') }}</option>
                                                                    <option value="bank_transfer" {{ $payment->method == 'bank_transfer' ? 'selected' : '' }}>{{ __('payment.bank_transfer') }}</option>
                                                                    <option value="wallet" {{ $payment->method == 'wallet' ? 'selected' : '' }}>{{ __('payment.wallet') }}</option>
                                                                    <option value="cod" {{ $payment->method == 'cod' ? 'selected' : '' }}>{{ __('payment.cod') }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('payment.reference_note') }}</label>
                                                                <input type="text" name="reference_note" class="form-control" value="{{ $payment->reference_note }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label"> {{ __('payment.payment_reference') }}</label>
                                                                <input type="text" name="payment_reference" class="form-control" value="{{ $payment->payment_reference }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('payment.paid_on_date') }}</label>
                                                                <input type="datetime-local" name="paid_on" class="form-control" value="{{ $payment->paid_on ? $payment->paid_on->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i') }}">
                                                            </div>
                                                            <input type="hidden" name="merchant_id" value="{{ $invoice->merchant_id }}">
                                                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('general.cancel') }}</button>
                                                            <button type="submit" class="btn btn-success"> {{ __('payment.updated_save') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center py-4">
                            <i class="fas fa-info-circle fa-2x mb-3"></i>
                            <h5>{{ __('invoice.no_payments') }}</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Add Payment Form -->
    @if($invoice->remaining_amount > 0)
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">{{ __('invoice.add_payment') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.invoices.pay', $invoice->id) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="amount" class="form-label">{{ __('invoice.amount') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number"
                                            name="amount"
                                            id="amount"
                                            class="form-control"
                                            step="0.01"
                                            min="0.01"
                                            max="{{ $invoice->remaining_amount }}"
                                            value="{{ old('amount', min(1000, $invoice->remaining_amount)) }}"
                                            required>
                                        <span class="input-group-text">{{ $invoice->currency }}</span>
                                    </div>
                                    <small class="text-muted">{{ __('invoice.max_limit') }}: {{ number_format($invoice->remaining_amount, 2) }}</small>
                                    @error('amount')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="method" class="form-label">{{ __('invoice.method') }} <span class="text-danger">*</span></label>
                                    <select name="method" id="method" class="form-select" required>
                                        <option value="">{{ __('invoice.choose_method') }}</option>
                                        @foreach(['cash' => __('invoice.methods.cash'), 'credit_card' => __('invoice.methods.credit_card'), 'bank_transfer' => __('invoice.methods.bank_transfer'), 'wallet' => __('invoice.methods.wallet'), 'cod' => __('invoice.methods.cod')] as $value => $label)
                                            <option value="{{ $value }}" {{ old('method') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('method')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="paid_on" class="form-label">{{ __('invoice.paid_on') }}</label>
                                    <input type="datetime-local"
                                        name="paid_on"
                                        id="paid_on"
                                        class="form-control"
                                        value="{{ old('paid_on', now()->format('Y-m-d\TH:i')) }}">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="reference_note" class="form-label">{{ __('invoice.notes') }}</label>
                                    <textarea name="reference_note"
                                            id="reference_note"
                                            class="form-control"
                                            rows="2"
                                            placeholder="{{ __('invoice.payment_placeholder') }}">{{ old('reference_note') }}</textarea>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-success px-4">
                                        <i class="fas fa-money-bill-wave me-2"></i> {{ __('invoice.record_payment') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
