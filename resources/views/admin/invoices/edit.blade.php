@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">تعديل الفاتورة</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">الفواتير</a></li>
                    <li class="breadcrumb-item active">تعديل الفاتورة</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.invoices.update', $invoice->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="merchant_id" class="form-label">التاجر</label>
                        <select name="merchant_id" id="merchant_id" class="form-select">
                            @foreach($merchants as $merchant)
                                <option value="{{ $merchant->id }}" {{ $invoice->merchant_id == $merchant->id ? 'selected' : '' }}>
                                    {{ $merchant->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('merchant_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="total_amount" class="form-label">المبلغ الإجمالي</label>
                        <input type="number" name="total_amount" id="total_amount" class="form-control"
                               value="{{ old('total_amount', $invoice->total_amount) }}" step="0.01" min="0">
                        @error('total_amount')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="currency" class="form-label">العملة</label>
                        <input type="text" name="currency" id="currency" class="form-control"
                               value="{{ old('currency', $invoice->currency) }}">
                        @error('currency')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">الحالة</label>
                        <select name="status" id="status" class="form-select">
                            <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'selected' : '' }}>غير مدفوعة</option>
                            <option value="partial" {{ $invoice->status == 'partial' ? 'selected' : '' }}>جزئياً</option>
                            <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>مدفوعة</option>
                        </select>
                        @error('status')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="issued_at" class="form-label">تاريخ الإصدار</label>
                        <input type="datetime-local" name="issued_at" id="issued_at" class="form-control"
                               value="{{ old('issued_at', $invoice->issued_at ? $invoice->issued_at->format('Y-m-d\TH:i') : '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">تاريخ الاستحقاق</label>
                        <input type="datetime-local" name="due_date" id="due_date" class="form-control"
                               value="{{ old('due_date', $invoice->due_date ? $invoice->due_date->format('Y-m-d\TH:i') : '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes', $invoice->notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">حفظ التعديلات</button>
                    <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">إلغاء</a>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
