@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">تفاصيل الفاتورة #{{ $invoice->invoice_number }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">الفواتير</a></li>
                        <li class="breadcrumb-item active">تفاصيل الفاتورة</li>
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
                    <h5 class="card-title mb-0">معلومات الفاتورة</h5>
                    <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status == 'partial' ? 'warning' : 'danger') }}">
                        {{ __('invoice.'. $invoice->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted">التاجر</h6>
                                <p class="font-size-16">{{ $invoice->merchant->name }}</p>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted">تاريخ الإصدار</h6>
                                <p class="font-size-16">{{ $invoice->issued_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted">ملاحظات</h6>
                                <p class="font-size-16">{{ $invoice->notes ?: 'لا توجد ملاحظات' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted">تاريخ الاستحقاق</h6>
                                <p class="font-size-16 {{ $invoice->due_date->isPast() && !$invoice->isPaid() ? 'text-danger' : '' }}">
                                    {{ $invoice->due_date->format('d/m/Y H:i') }}
                                    @if($invoice->due_date->isPast() && !$invoice->isPaid())
                                        <i class="fas fa-exclamation-triangle ms-2"></i>
                                    @endif
                                </p>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted">العملة</h6>
                                <p class="font-size-16">{{ $invoice->currency }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Amount Summary -->
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card bg-light p-3 text-center">
                                <h6 class="text-muted">المبلغ الإجمالي</h6>
                                <h4 class="text-primary">{{ number_format($invoice->total_amount, 2) }} {{ $invoice->currency }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light p-3 text-center">
                                <h6 class="text-muted">المبلغ المدفوع</h6>
                                <h4 class="text-success">{{ number_format($invoice->paid_amount, 2) }} {{ $invoice->currency }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light p-3 text-center">
                                <h6 class="text-muted">المبلغ المتبقي</h6>
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
                    <h5 class="card-title mb-0">سجل المدفوعات</h5>
                    <span class="badge bg-white text-dark">{{ $invoice->payments->count() }} مدفوعات</span>
                </div>
                <div class="card-body">
                    @if($invoice->payments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="15%">المبلغ</th>
                                        <th width="15%">طريقة الدفع</th>
                                        <th width="15%">تاريخ الدفع</th>
                                        <th width="35%">ملاحظات</th>
                                        <th width="20%">إجراءات</th>
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
                                                    <a href="{{ route('admin.payments.edit', $payment->id) }}"
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="تعديل">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('هل أنت متأكد من حذف هذا الدفع؟')"
                                                                title="حذف">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center py-4">
                            <i class="fas fa-info-circle fa-2x mb-3"></i>
                            <h5>لا توجد مدفوعات مسجلة لهذه الفاتورة</h5>
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
                    <h5 class="card-title mb-0">إضافة دفعة جديدة</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.invoices.pay', $invoice->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="amount" class="form-label">المبلغ <span class="text-danger">*</span></label>
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
                                <small class="text-muted">الحد الأقصى: {{ number_format($invoice->remaining_amount, 2) }}</small>
                                @error('amount')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="method" class="form-label">طريقة الدفع <span class="text-danger">*</span></label>
                                <select name="method" id="method" class="form-select" required>
                                    <option value="">اختر طريقة الدفع</option>
                                    @foreach(['cash' => 'نقداً', 'credit_card' => 'بطاقة ائتمان', 'bank_transfer' => 'تحويل بنكي', 'wallet' => 'محفظة', 'cod' => 'الدفع عند الاستلام'] as $value => $label)
                                        <option value="{{ $value }}" {{ old('method') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('method')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="paid_on" class="form-label">تاريخ الدفع</label>
                                <input type="datetime-local"
                                       name="paid_on"
                                       id="paid_on"
                                       class="form-control"
                                       value="{{ old('paid_on', now()->format('Y-m-d\TH:i')) }}">
                            </div>

                            <div class="col-12 mb-3">
                                <label for="reference_note" class="form-label">ملاحظات</label>
                                <textarea name="reference_note"
                                          id="reference_note"
                                          class="form-control"
                                          rows="2"
                                          placeholder="أي معلومات إضافية عن الدفع">{{ old('reference_note') }}</textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-money-bill-wave me-2"></i> تسجيل الدفع
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

@section('styles')
<style>
    .invoice-card {
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }
    .invoice-card .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    .table th {
        background-color: #f8f9fa !important;
    }
</style>
@endsection

@section('scripts')
<script>
    // Client-side validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Set max amount validation
    document.getElementById('amount').addEventListener('change', function() {
        const maxAmount = parseFloat("{{ $invoice->remaining_amount }}");
        const enteredAmount = parseFloat(this.value);

        if (enteredAmount > maxAmount) {
            alert('المبلغ المدخل يتجاوز المبلغ المتبقي!');
            this.value = maxAmount.toFixed(2);
        }
    });
</script>
@endsection
