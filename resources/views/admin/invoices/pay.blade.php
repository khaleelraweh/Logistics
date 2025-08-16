@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">إضافة دفعة جديدة</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">الفواتير</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.invoices.show', $invoice->id) }}">فاتورة #{{ $invoice->invoice_number }}</a></li>
                    <li class="breadcrumb-item active">إضافة دفعة</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>تفاصيل الفاتورة</h5>
                <p>إجمالي المبلغ: <strong>{{ number_format($invoice->total_amount, 2) }}</strong></p>
                <p>المدفوع حتى الآن: <strong>{{ number_format($invoice->payments->sum('amount'), 2) }}</strong></p>
                <p>المتبقي:
                    <strong class="text-danger">
                        {{ number_format($invoice->total_amount - $invoice->payments->sum('amount'), 2) }}
                    </strong>
                </p>

                <hr>

                <form action="{{ route('admin.invoices.pay', $invoice->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="amount" class="form-label">المبلغ</label>
                        <input type="number" name="amount" id="amount" class="form-control"
                               value="{{ old('amount') }}" step="0.01" min="1"
                               max="{{ $invoice->total_amount - $invoice->payments->sum('amount') }}">
                        @error('amount')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="method" class="form-label">طريقة الدفع</label>
                        <select name="method" id="method" class="form-select">
                            <option value="">اختر طريقة الدفع</option>
                            <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>نقداً</option>
                            <option value="credit_card" {{ old('method') == 'credit_card' ? 'selected' : '' }}>بطاقة ائتمان</option>
                            <option value="bank_transfer" {{ old('method') == 'bank_transfer' ? 'selected' : '' }}>تحويل بنكي</option>
                            <option value="wallet" {{ old('method') == 'wallet' ? 'selected' : '' }}>المحفظة</option>
                            <option value="cod" {{ old('method') == 'cod' ? 'selected' : '' }}>الدفع عند الاستلام</option>
                        </select>
                        @error('method')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>



                    <div class="mb-3">
                        <label for="reference_note" class="form-label">ملاحظات</label>
                        <textarea name="reference_note" id="reference_note" class="form-control" rows="3">{{ old('reference_note') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="payment_reference" class="form-label">رقم المرجع</label>
                        <input type="text" name="payment_reference" id="payment_reference" class="form-control"
                               value="{{ old('payment_reference') }}">
                    </div>

                    <button type="submit" class="btn btn-success">إضافة الدفعة</button>
                    <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
