@extends('layouts.admin')
@section('style')
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #6f42c1;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
            --border-radius: 0.75rem;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #4a4a4a;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: none;
            border-radius: var(--border-radius);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-bottom: none;
            padding: 1.2rem 1.5rem;
            font-weight: 700;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
        }

        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            background-color: white;
            box-shadow: 0 0.15rem 1rem rgba(58, 59, 69, 0.1);
            border-left: 4px solid var(--primary-color);
        }

        .section-title {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            padding-bottom: 0.75rem;
            border-bottom: 2px dashed #e3e6f0;
        }

        .section-title i {
            margin-left: 0.75rem;
            font-size: 1.4rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .currency-input {
            position: relative;
            direction: ltr;
        }

        .currency-symbol {
            position: absolute;
            left: 1px;
            top: 1px;
            bottom: 1px;
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
            padding: 0.5rem 0.85rem;
            border-radius: 0.6rem 0 0 0.6rem;
            border: 1px solid #ced4da;
            font-weight: 600;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            z-index: 5;
        }

        .currency-input input {
            padding-left: 50px !important;
            direction: rtl;
        }

        .currency-input input:disabled {
            background-color: #f8f9fa;
            color: #6c757d;
        }

        .form-control, .form-select {
            border-radius: 0.6rem;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d3e2;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #17a673 100%);
            border: none;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            border-radius: 0.6rem;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #858796 0%, #60616f 100%);
            border: none;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            border-radius: 0.6rem;
        }

        .status-indicator {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            border-radius: 2rem;
            font-weight: 600;
            margin-top: 0.5rem;
            text-align: center;
            width: 100%;
        }

        .status-unpaid {
            background-color: rgba(231, 74, 59, 0.15);
            color: #e74a3b;
            border: 1px solid rgba(231, 74, 59, 0.3);
        }

        .status-partial {
            background-color: rgba(246, 194, 62, 0.15);
            color: #f6c23e;
            border: 1px solid rgba(246, 194, 62, 0.3);
        }

        .status-paid {
            background-color: rgba(28, 200, 138, 0.15);
            color: #1cc88a;
            border: 1px solid rgba(28, 200, 138, 0.3);
        }

        .amount-card {
            text-align: center;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            background: white;
            box-shadow: 0 0.15rem 1rem rgba(58, 59, 69, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .amount-title {
            font-size: 0.9rem;
            color: #858796;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .amount-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .amount-due {
            color: var(--danger-color);
        }

        .amount-paid {
            color: var(--success-color);
        }

        .progress {
            height: 10px;
            border-radius: 5px;
            margin-top: 1rem;
            background-color: #eaecf4;
        }

        .progress-bar {
            border-radius: 5px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .invoice-status {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            border-radius: var(--border-radius);
            background: white;
            box-shadow: 0 0.15rem 1rem rgba(58, 59, 69, 0.1);
            height: 100%;
        }

        .page-header {
            padding: 1.5rem;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 0.15rem 1rem rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }

        .payment-history {
            max-height: 300px;
            overflow-y: auto;
        }

        .payment-item {
            border-left: 3px solid var(--primary-color);
            padding: 0.75rem;
            margin-bottom: 0.75rem;
            background-color: #f8f9fc;
            border-radius: 0 0.5rem 0.5rem 0;
        }

        .payment-date {
            font-size: 0.85rem;
            color: #858796;
        }

        .readonly-field {
            background-color: #f8f9fa !important;
            color: #6c757d !important;
            cursor: not-allowed !important;
        }

        .merchant-info {
            background-color: #f8f9fc;
            border-radius: 0.6rem;
            padding: 1rem;
            border: 1px solid #e3e6f0;
        }

        .merchant-name {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .merchant-details {
            font-size: 0.9rem;
            color: #858796;
            margin-top: 0.5rem;
        }

        .status-info {
            background-color: #f8f9fc;
            border-radius: 0.6rem;
            padding: 1rem;
            border: 1px solid #e3e6f0;
            text-align: center;
        }

        .status-message {
            font-weight: 600;
            margin-top: 0.5rem;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .form-section {
                padding: 1rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <!-- رأس الصفحة -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-2 mb-md-0">
                        <i class="bi bi-receipt text-primary me-2"></i>
                         {{ __('invoice.edit_invoice') }} #{{ $invoice->id }}
                    </h2>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb" class="justify-content-md-end d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}" class="text-decoration-none">{{ __('invoice.manage_invoices') }}</a></li>
                            <li class="breadcrumb-item active"> {{ __('invoice.edit_invoice') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- بطاقات الملخص -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="amount-card">
                    <div class="amount-title"> {{ __('invoice.total_amount') }}</div>
                    <div class="amount-value" id="total-amount-display">{{ number_format($invoice->total_amount, 2) }} <small>{{ $invoice->currency }}</small></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="amount-card">
                    <div class="amount-title"> {{ __('invoice.paid_amount') }} </div>
                    <div class="amount-value amount-paid" id="paid-amount-display">{{ number_format($invoice->paid_amount, 2) }} <small>{{ $invoice->currency }}</small></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="amount-card">
                    <div class="amount-title">{{ __('invoice.remaining_amount') }}</div>
                    <div class="amount-value amount-due" id="due-amount-display">{{ number_format($invoice->total_amount - $invoice->paid_amount, 2) }} <small>{{ $invoice->currency }}</small></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="invoice-status">
                    <div>
                        <div class="amount-title">{{ __('invoice.invoice_status') }}</div>
                        <div class="status-indicator status-{{ $invoice->status }}" id="status-display">
                            @if($invoice->status == 'unpaid')
                                 {{ __('invoice.status_unpaid') }}
                            @elseif($invoice->status == 'partial')
                                 {{ __('invoice.status_partial') }}
                            @else
                                {{ __('invoice.paid') }}
                            @endif
                        </div>
                        <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar"
                                 style="width: {{ $invoice->total_amount > 0 ? ($invoice->paid_amount / $invoice->total_amount) * 100 : 0 }}%"
                                 aria-valuenow="{{ $invoice->total_amount > 0 ? ($invoice->paid_amount / $invoice->total_amount) * 100 : 0 }}"
                                 aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- محتوى النموذج -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0 text-white"><i class="bi bi-pencil-square me-2"></i>{{ __('invoice.invoice_info') }}</h5>
                    </div>
                    <div class="card-body">
                        <!-- نموذج الفاتورة الرئيسي -->
                        <form id="invoice-form" action="{{ route('admin.invoices.update', $invoice->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- معلومات التاجر -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-person-badge"></i>
                                     {{ __('merchant.merchant_info') }}
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"> {{ __('merchant.name') }}</label>
                                        <div class="merchant-info">
                                            <div class="merchant-name">{{ $invoice->merchant->name }}</div>
                                            <div class="merchant-details">
                                                {{ $invoice->merchant->email }}<br>
                                                {{ $invoice->merchant->phone }}
                                            </div>
                                        </div>
                                        <small class="text-muted">لا يمكن تعديل التاجر بعد إنشاء الفاتورة</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="invoice_number" class="form-label">{{ __('invoice.invoice_number') }}</label>
                                        <input type="text" class="form-control readonly-field" id="invoice_number" value="{{ $invoice->invoice_number }}" disabled>
                                        <small class="text-muted">رقم الفاتورة لا يمكن تعديله</small>
                                    </div>
                                </div>
                            </div>

                            <!-- المبالغ والعملة -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-currency-exchange"></i>
                                    المبالغ والعملة
                                </h5>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="total_amount" class="form-label">المبلغ الإجمالي <span class="text-danger">*</span></label>
                                        <div class="currency-input">
                                            <span class="currency-symbol">{{ $invoice->currency == 'USD' ? '$' : ($invoice->currency == 'EUR' ? '€' : 'ر.س') }}</span>
                                            <input type="number" name="total_amount" id="total_amount" class="form-control"
                                                   value="{{ old('total_amount', $invoice->total_amount) }}" step="0.01" min="0" required>
                                        </div>
                                        @error('total_amount')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label"> {{ __('invoice.paid_amount') }}</label>
                                        <div class="currency-input">
                                            <span class="currency-symbol">{{ $invoice->currency == 'USD' ? '$' : ($invoice->currency == 'EUR' ? '€' : 'ر.س') }}</span>
                                            <input type="text" class="form-control readonly-field" value="{{ number_format($invoice->paid_amount, 2) }}" disabled>
                                        </div>
                                        <small class="text-muted">يتم حسابه تلقائياً من المدفوعات</small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">{{ __('invoice.remaining_amount') }}</label>
                                        <div class="currency-input">
                                            <span class="currency-symbol">{{ $invoice->currency == 'USD' ? '$' : ($invoice->currency == 'EUR' ? '€' : 'ر.س') }}</span>
                                            <input type="text" class="form-control readonly-field" value="{{ number_format($invoice->total_amount - $invoice->paid_amount, 2) }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="currency" class="form-label">{{ __('invoice.currency') }} <span class="text-danger">*</span></label>
                                        <select name="currency" id="currency" class="form-select">
                                            <option value="USD" {{ $invoice->currency == 'USD' ? 'selected' : '' }}>{{ __('invoice.currency_usd') }}</option>
                                            <option value="EUR" {{ $invoice->currency == 'EUR' ? 'selected' : '' }}>{{ __('invoice.currency_eur') }}</option>
                                            <option value="SAR" {{ $invoice->currency == 'SAR' ? 'selected' : '' }}>{{ __('invoice.currency_sar') }}</option>
                                        </select>
                                        @error('currency')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">{{ __('invoice.invoice_status') }}</label>
                                        <div class="status-info">
                                            <div class="status-indicator status-{{ $invoice->status }}" id="status-display">
                                                @if($invoice->status == 'unpaid')
                                                     {{ __('invoice.status_unpaid') }}
                                                @elseif($invoice->status == 'partial')
                                                     {{ __('invoice.status_partial') }}
                                                @else
                                                    {{ __('invoice.status_paid') }}
                                                @endif
                                            </div>
                                            <div class="status-message text-muted">
                                                @if($invoice->status == 'unpaid')
                                                    لم يتم دفع أي مبلغ من الفاتورة
                                                @elseif($invoice->status == 'partial')
                                                    تم دفع {{ number_format(($invoice->paid_amount / $invoice->total_amount) * 100, 2) }}% من الفاتورة
                                                @else
                                                    تم دفع الفاتورة بالكامل
                                                @endif
                                            </div>
                                        </div>
                                        <small class="text-muted">يتم تحديث الحالة تلقائياً بناءً على المدفوعات</small>
                                    </div>
                                </div>
                            </div>

                            <!-- التواريخ -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-calendar-event"></i>
                                    التواريخ
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="issued_at" class="form-label">{{ __('invoice.issued_at') }}</label>
                                        <input type="datetime-local" name="issued_at" id="issued_at" class="form-control"
                                               value="{{ old('issued_at', $invoice->issued_at ? $invoice->issued_at->format('Y-m-d\TH:i') : '') }}">
                                        @error('issued_at')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="due_date" class="form-label">{{ __('invoice.due_date') }}</label>
                                        <input type="datetime-local" name="due_date" id="due_date" class="form-control"
                                               value="{{ old('due_date', $invoice->due_date ? $invoice->due_date->format('Y-m-d\TH:i') : '') }}">
                                        @error('due_date')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- ملاحظات -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-chat-left-text"></i>
                                     {{ __('invoice.notes') }}
                                </h5>
                                <div class="mb-3">
                                    <textarea name="notes" id="notes" class="form-control" rows="4">{{ old('notes', $invoice->notes) }}</textarea>
                                    @error('notes')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- الأزرار -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> {{ __('general.back') }}
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-light me-2">
                                        <i class="bi bi-x-circle me-1"></i> {{ __('general.cancel') }}
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check2-circle me-1"></i>  {{ __('invoice.update_inovice') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- قسم المدفوعات (منفصل عن نموذج الفاتورة) -->
                        <div class="form-section mt-5">
                            <h5 class="section-title">
                                <i class="bi bi-clock-history"></i>
                                 {{ __('payment.manage_payments') }}
                            </h5>

                            <!-- زر إضافة دفعة جديدة -->
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                                    <i class="bi bi-plus-circle me-1"></i>   {{ __('payment.add_new_payment') }}
                                </button>
                            </div>

                            <!-- سجل المدفوعات -->
                            <div class="payment-history">
                                @if($invoice->payments && $invoice->payments->count() > 0)
                                    @foreach($invoice->payments as $payment)
                                        <div class="payment-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ number_format($payment->amount, 2) }} {{ $invoice->currency }}</strong>
                                                @if($payment->paid_on)
                                                    <div class="payment-date">{{ $payment->paid_on->format('Y-m-d H:i') }}</div>
                                                @endif
                                            </div>
                                            <div class="d-flex gap-2">
                                                <span class="badge bg-success" style="display: flex; align-items: center;">
                                                    @if($payment->method == 'cash') {{ __('payment.cash') }}
                                                    @elseif($payment->method == 'credit_card')  {{ __('payment.credit_card') }}
                                                    @elseif($payment->method == 'bank_transfer')  {{ __('payment.bank_transfer') }}
                                                    @elseif($payment->method == 'wallet') {{ __('payment.wallet') }}
                                                    @elseif($payment->method == 'cod')   {{ __('payment.cod') }}
                                                    @endif
                                                </span>
                                                <!-- زر تعديل -->
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editPaymentModal{{ $payment->id }}">
                                                    <i class="fas fa-pen-square "></i>
                                                </button>
                                                <!-- زر حذف -->
                                                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الدفعة؟');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>

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
                                                                <label class="form-label">{{ __('payemnt.paid_on_date') }}</label>
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
                                @else
                                    <div class="text-center py-3 text-muted">
                                        <i class="bi bi-receipt-cutoff display-4"></i>
                                        <p>لا توجد مدفوعات مسجلة لهذه الفاتورة</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal إضافة دفعة جديدة -->
        <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.payments.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPaymentModalLabel">إضافة دفعة جديدة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">المبلغ</label>
                                <input type="number" name="amount" class="form-control" step="0.01" min="0.01" max="{{ $invoice->total_amount - $invoice->paid_amount }}" required>
                                <small class="text-muted">أقصى مبلغ يمكن دفعه: {{ number_format($invoice->total_amount - $invoice->paid_amount, 2) }}</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">طريقة الدفع</label>
                                <select name="method" class="form-select" required>
                                    <option value="cash">نقداً</option>
                                    <option value="credit_card">بطاقة ائتمان</option>
                                    <option value="bank_transfer">تحويل بنكي</option>
                                    <option value="wallet">محفظة</option>
                                    <option value="cod">الدفع عند الاستلام</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">الملاحظات</label>
                                <input type="text" name="reference_note" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">مرجع الدفع</label>
                                <input type="text" name="payment_reference" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">تاريخ الدفع</label>
                                <input type="datetime-local" name="paid_on" class="form-control" value="{{ now()->format('Y-m-d\TH:i') }}">
                            </div>
                            <input type="hidden" name="merchant_id" value="{{ $invoice->merchant_id }}">
                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-success">إضافة الدفعة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Bootstrap & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // تغيير رمز العملة عند تغيير نوع العملة
            $('#currency').change(function() {
                let currency = $(this).val();
                let symbol = '$';

                if (currency === 'EUR') symbol = '€';
                if (currency === 'SAR') symbol = 'ر.س';

                $('.currency-symbol').text(symbol);
            });

            // تحديث حالة الفاتورة عند تغيير المبلغ الإجمالي
            $('#total_amount').on('input', function() {
                updateInvoiceStatus();
            });

            // وظيفة تحديث حالة الفاتورة
            function updateInvoiceStatus() {
                let total = parseFloat($('#total_amount').val()) || 0;
                let paid = parseFloat('{{ $invoice->paid_amount }}') || 0;
                let remaining = total - paid;

                // تحديث المبالغ المعروضة
                $('#paid-amount-display').text(paid.toFixed(2) + ' {{ $invoice->currency }}');
                $('#due-amount-display').text(remaining.toFixed(2) + ' {{ $invoice->currency }}');

                // تحديث حالة الفاتورة
                let status = 'unpaid';
                let statusText = 'غير مدفوعة';
                let statusMessage = 'لم يتم دفع أي مبلغ من الفاتورة';

                if (paid <= 0) {
                    status = 'unpaid';
                    statusText = 'غير مدفوعة';
                    statusMessage = 'لم يتم دفع أي مبلغ من الفاتورة';
                } else if (paid >= total) {
                    status = 'paid';
                    statusText = 'مدفوعة';
                    statusMessage = 'تم دفع الفاتورة بالكامل';
                } else {
                    status = 'partial';
                    statusText = 'مدفوعة جزئياً';
                    let percentage = (paid / total) * 100;
                    statusMessage = 'تم دفع ' + percentage.toFixed(2) + '% من الفاتورة';
                }

                // تحديث العرض
                $('#status-display').text(statusText)
                    .removeClass('status-unpaid status-partial status-paid')
                    .addClass('status-' + status);

                $('.status-message').text(statusMessage);

                // تحديث شريط التقدم
                let progressWidth = total > 0 ? (paid / total) * 100 : 0;
                $('.progress-bar').css('width', progressWidth + '%');
            }
        });
    </script>
@endsection



