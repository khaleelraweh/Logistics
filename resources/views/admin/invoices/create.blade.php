@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">إضافة فاتورة جديدة</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">الفواتير</a></li>
                    <li class="breadcrumb-item active">إنشاء فاتورة</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.invoices.store') }}" method="POST">
                    @csrf

                    {{-- التاجر --}}
                    <div class="mb-3">
                        <label for="merchant_id" class="form-label">التاجر</label>
                        <select name="merchant_id" id="merchant_id" class="form-select">
                            <option value="">اختر التاجر</option>
                            @foreach($merchants as $merchant)
                                <option value="{{ $merchant->id }}" {{ old('merchant_id') == $merchant->id ? 'selected' : '' }}>
                                    {{ $merchant->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('merchant_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- نوع الفاتورة --}}
                    <div class="mb-3">
                        <label for="payable_type" class="form-label">نوع الفاتورة</label>
                        <select name="payable_type" id="payable_type" class="form-select">
                            <option value="">اختر النوع</option>
                            <option value="WarehouseRental" {{ old('payable_type') == 'WarehouseRental' ? 'selected' : '' }}>عقد إيجار</option>
                            <option value="Package" {{ old('payable_type') == 'Package' ? 'selected' : '' }}>طرد</option>
                        </select>
                        @error('payable_type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- العنصر المرتبط --}}
                    <div class="mb-3">
                        <label for="payable_id" class="form-label">العنصر المرتبط</label>
                        <select name="payable_id" id="payable_id" class="form-select">
                            <option value="">اختر العنصر</option>
                        </select>
                        @error('payable_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- المبلغ --}}
                    <div class="mb-3">
                        <label for="total_amount" class="form-label">المبلغ الإجمالي</label>
                        <input type="number" name="total_amount" id="total_amount" class="form-control" step="0.01" min="0" value="{{ old('total_amount') }}">
                        @error('total_amount')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- العملة --}}
                    <div class="mb-3">
                        <label for="currency" class="form-label">العملة</label>
                        <input type="text" name="currency" id="currency" class="form-control" value="{{ old('currency', 'SAR') }}">
                        @error('currency')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- تواريخ الفاتورة --}}
                    <div class="mb-3">
                        <label for="issued_at" class="form-label">تاريخ الإصدار</label>
                        <input type="datetime-local" name="issued_at" id="issued_at" class="form-control" value="{{ old('issued_at', now()->format('Y-m-d\TH:i')) }}">
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">تاريخ الاستحقاق</label>
                        <input type="datetime-local" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', now()->addDays(15)->format('Y-m-d\TH:i')) }}">
                    </div>

                    {{-- الملاحظات --}}
                    <div class="mb-3">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">إنشاء الفاتورة</button>
                    <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">إلغاء</a>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const payableData = {
        WarehouseRental: @json($warehouseRentals ?? []),
        Package: @json($packages ?? [])
    };

    const payableTypeSelect = document.getElementById('payable_type');
    const payableIdSelect = document.getElementById('payable_id');

    // عند تغيير النوع، يتم تعبئة العناصر المرتبطة
    payableTypeSelect.addEventListener('change', function() {
        const type = this.value;
        payableIdSelect.innerHTML = '<option value="">اختر العنصر</option>';

        if(payableData[type]){
            payableData[type].forEach(item => {
                let displayName = item.name ?? item.title ?? 'Item ' + item.id;
                let notes = item.notes ?? '';
                let selected = oldPayableId == item.id ? 'selected' : '';
                payableIdSelect.innerHTML += `<option value="${item.id}" ${selected}>${displayName}${notes ? ' - ' + notes : ''}</option>`;
            });
        }
    });

    // إعادة اختيار العنصر عند الفشل في التحقق من الصحة
    const oldPayableType = "{{ old('payable_type') }}";
    const oldPayableId = "{{ old('payable_id') }}";
    if(oldPayableType){
        payableTypeSelect.value = oldPayableType;
        payableTypeSelect.dispatchEvent(new Event('change'));
    }
</script>
@endsection
