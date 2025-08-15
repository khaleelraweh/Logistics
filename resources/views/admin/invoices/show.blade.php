@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">عرض الفاتورة</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">الفواتير</a></li>
                    <li class="breadcrumb-item active">عرض الفاتورة</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                بيانات الفاتورة
            </div>
            <div class="card-body">
                <p><strong>رقم الفاتورة:</strong> {{ $invoice->invoice_number }}</p>
                <p><strong>التاجر:</strong> {{ $invoice->merchant->name }}</p>
                <p><strong>المبلغ الإجمالي:</strong> {{ $invoice->total_amount }} {{ $invoice->currency }}</p>
                <p><strong>الحالة:</strong> {{ ucfirst($invoice->status) }}</p>
                <p><strong>تاريخ الإصدار:</strong> {{ $invoice->issued_at->format('Y-m-d H:i') }}</p>
                <p><strong>تاريخ الاستحقاق:</strong> {{ $invoice->due_date->format('Y-m-d H:i') }}</p>
                <p><strong>الملاحظات:</strong> {{ $invoice->notes }}</p>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>المبلغ الإجمالي:</strong> {{ number_format($invoice->total_amount, 2) }} {{ $invoice->currency }}
                </div>
                <div class="col-md-4">
                    <strong>المبلغ المدفوع:</strong> {{ number_format($invoice->paid_amount, 2) }} {{ $invoice->currency }}
                </div>
                <div class="col-md-4">
                    <strong>المبلغ المتبقي:</strong> {{ number_format($invoice->remaining_amount, 2) }} {{ $invoice->currency }}
                </div>
            </div>
        </div>

        {{-- قائمة المدفوعات --}}
        <div class="card mb-3">
            <div class="card-header">
                المدفوعات
            </div>
            <div class="card-body">
                @if($invoice->payments->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>المبلغ</th>
                                <th>طريقة الدفع</th>
                                <th>تاريخ الدفع</th>
                                <th>ملاحظات</th>
                                <th>إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->payments as $payment)
                                <tr>
                                    <td>{{ $payment->amount }} {{ $payment->currency }}</td>
                                    <td>{{ ucfirst($payment->method) }}</td>
                                    <td>{{ $payment->paid_on?->format('Y-m-d H:i') ?? '-' }}</td>
                                    <td>{{ $payment->reference_note ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-sm btn-primary">تعديل</a>

                                        <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا الدفع؟')">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>لا توجد مدفوعات حتى الآن.</p>
                @endif
            </div>
        </div>

        {{-- إضافة دفع جديد --}}
        <div class="card">
            <div class="card-header">
                إضافة دفع جديد
            </div>
            <div class="card-body">
                <form action="{{ route('admin.invoices.pay', $invoice->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="amount" class="form-label">المبلغ</label>
                        <input type="number" name="amount" id="amount" class="form-control" step="0.01" max="{{ $invoice->total_amount - $invoice->payments->sum('amount') }}" required>
                        @error('amount')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="method" class="form-label">طريقة الدفع</label>
                        <select name="method" id="method" class="form-select" required>
                            <option value="">اختر الطريقة</option>
                            <option value="cash">نقداً</option>
                            <option value="credit_card">بطاقة ائتمان</option>
                            <option value="bank_transfer">تحويل بنكي</option>
                            <option value="wallet">محفظة</option>
                            <option value="cod">الدفع عند الاستلام</option>
                        </select>
                        @error('method')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="reference_note" class="form-label">ملاحظات</label>
                        <textarea name="reference_note" id="reference_note" class="form-control" rows="2">{{ old('reference_note') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">تسجيل الدفع</button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
