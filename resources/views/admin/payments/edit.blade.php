@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">تعديل الدفع</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.invoices.show', $payment->invoice->id) }}">الفاتورة</a></li>
                    <li class="breadcrumb-item active">تعديل الدفع</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="amount" class="form-label">المبلغ</label>
                        <input type="number" name="amount" id="amount" class="form-control"
                               value="{{ old('amount', $payment->amount) }}" step="0.01" min="0">
                        @error('amount')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="currency" class="form-label">العملة</label>
                        <input type="text" name="currency" id="currency" class="form-control"
                               value="{{ old('currency', $payment->currency) }}">
                        @error('currency')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="method" class="form-label">طريقة الدفع</label>
                        <select name="method" id="method" class="form-select">
                            <option value="cash" {{ $payment->method == 'cash' ? 'selected' : '' }}>نقداً</option>
                            <option value="credit_card" {{ $payment->method == 'credit_card' ? 'selected' : '' }}>بطاقة ائتمان</option>
                            <option value="bank_transfer" {{ $payment->method == 'bank_transfer' ? 'selected' : '' }}>تحويل بنكي</option>
                            <option value="wallet" {{ $payment->method == 'wallet' ? 'selected' : '' }}>المحفظة</option>
                            <option value="cod" {{ $payment->method == 'cod' ? 'selected' : '' }}>الدفع عند الاستلام</option>
                        </select>
                        @error('method')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="paid_on" class="form-label">تاريخ الدفع</label>
                        <input type="datetime-local" name="paid_on" id="paid_on" class="form-control"
                               value="{{ old('paid_on', $payment->paid_on ? $payment->paid_on->format('Y-m-d\TH:i') : '') }}">
                        @error('paid_on')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="reference_note" class="form-label">ملاحظات</label>
                        <textarea name="reference_note" id="reference_note" class="form-control" rows="3">{{ old('reference_note', $payment->reference_note) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="payment_reference" class="form-label">رقم المرجع</label>
                        <input type="text" name="payment_reference" id="payment_reference" class="form-control"
                               value="{{ old('payment_reference', $payment->payment_reference) }}">
                    </div>

                    <button type="submit" class="btn btn-success">حفظ التعديلات</button>
                    <a href="{{ route('admin.invoices.show', $payment->invoice->id) }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
