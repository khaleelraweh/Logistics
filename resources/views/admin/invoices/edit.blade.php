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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem rgba(58, 59, 69, 0.2);
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
        }

        .currency-symbol {
            position: absolute;
            left: 15px;
            top: 38px;
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
            padding: 0.5rem 0.85rem;
            border-radius: 0 0.375rem 0.375rem 0;
            border: 1px solid #ced4da;
            font-weight: 600;
            color: var(--dark-color);
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

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            border-radius: 0.6rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(78, 115, 223, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #17a673 100%);
            border: none;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            border-radius: 0.6rem;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(28, 200, 138, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #858796 0%, #60616f 100%);
            border: none;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            border-radius: 0.6rem;
            transition: all 0.3s ease;
        }

        .form-control, .form-select {
            border-radius: 0.6rem;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d3e2;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
            transform: translateY(-2px);
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .page-header {
            padding: 1.5rem;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 0.15rem 1rem rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .section-title {
                font-size: 1.1rem;
            }

            .form-section {
                padding: 1rem;
            }
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

        .amount-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem rgba(58, 59, 69, 0.15);
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

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .logo-subtitle {
            color: #858796;
            font-size: 1rem;
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
                        تعديل الفاتورة
                    </h2>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb" class="justify-content-md-end d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}" class="text-decoration-none">الفواتير</a></li>
                            <li class="breadcrumb-item active">تعديل الفاتورة</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- بطاقات الملخص -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="amount-card">
                    <div class="amount-title">المبلغ الإجمالي</div>
                    <div class="amount-value" id="total-amount-display">$1,000.00</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="amount-card">
                    <div class="amount-title">المبلغ المدفوع</div>
                    <div class="amount-value amount-paid" id="paid-amount-display">$500.00</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="amount-card">
                    <div class="amount-title">المبلغ المتبقي</div>
                    <div class="amount-value amount-due" id="due-amount-display">$500.00</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="invoice-status">
                    <div>
                        <div class="amount-title">حالة الفاتورة</div>
                        <div class="status-indicator status-partial" id="status-display">مدفوعة جزئياً</div>
                        <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <h5 class="m-0 text-white"><i class="bi bi-pencil-square me-2"></i>معلومات الفاتورة</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.invoices.update', $invoice->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- معلومات التاجر -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="bi bi-person-badge"></i>
                                    معلومات التاجر
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="merchant_id" class="form-label">اسم التاجر <span class="text-danger">*</span></label>
                                        <select name="merchant_id" id="merchant_id" class="form-select">
                                            <option value="">اختر التاجر</option>
                                            @foreach($merchants as $merchant)
                                                <option value="{{ $merchant->id }}" {{ $invoice->merchant_id == $merchant->id ? 'selected' : '' }}>
                                                    {{ $merchant->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('merchant_id')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="invoice_number" class="form-label">رقم الفاتورة</label>
                                        <input type="text" class="form-control" id="invoice_number" value="{{ $invoice->invoice_number }}" disabled>
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
                                    <div class="col-md-12 mb-3">
                                        <label for="total_amount" class="form-label">المبلغ الإجمالي <span class="text-danger">*</span></label>
                                        <div class="currency-input">

                                            <input type="number" name="total_amount" id="total_amount" class="form-control "
                                                   value="{{ old('total_amount', $invoice->total_amount) }}" step="0.01" min="0" required>
                                        </div>
                                        @error('total_amount')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="currency" class="form-label">العملة <span class="text-danger">*</span></label>
                                        <select name="currency" id="currency" class="form-select">
                                            <option value="USD" {{ $invoice->currency == 'USD' ? 'selected' : '' }}>دولار أمريكي (USD)</option>
                                            <option value="EUR" {{ $invoice->currency == 'EUR' ? 'selected' : '' }}>يورو (EUR)</option>
                                            <option value="SAR" {{ $invoice->currency == 'SAR' ? 'selected' : '' }}>ريال سعودي (SAR)</option>
                                        </select>
                                        @error('currency')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">حالة الفاتورة <span class="text-danger">*</span></label>
                                        <select name="status" id="status1" class="form-select">
                                            <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'selected' : '' }}>غير مدفوعة</option>
                                            <option value="partial" {{ $invoice->status == 'partial' ? 'selected' : '' }}>مدفوعة جزئياً</option>
                                            <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>مدفوعة</option>
                                        </select>
                                        @error('status')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
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
                                        <label for="issued_at" class="form-label">تاريخ الإصدار</label>
                                        <input type="datetime-local" name="issued_at" id="issued_at" class="form-control"
                                               value="{{ old('issued_at', $invoice->issued_at ? $invoice->issued_at->format('Y-m-d\TH:i') : '') }}">
                                        @error('issued_at')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="due_date" class="form-label">تاريخ الاستحقاق</label>
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
                                    ملاحظات إضافية
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
                                    <i class="bi bi-arrow-left me-1"></i> رجوع
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-light me-2">
                                        <i class="bi bi-x-circle me-1"></i> إلغاء
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check2-circle me-1"></i> حفظ التعديلات
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
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
            // تحديث المبالغ والعروض تلقائياً
            function updateAmounts() {
                let total = parseFloat($('#total_amount').val()) || 0;
                let paid = parseFloat($('#paid_amount').val()) || 0;
                let remaining = total - paid;

                $('#remaining_amount').val(remaining.toFixed(2));

                // تحديث بطاقات العرض
                $('#total-amount-display').text('$' + total.toFixed(2));
                $('#paid-amount-display').text('$' + paid.toFixed(2));
                $('#due-amount-display').text('$' + remaining.toFixed(2));

                // تحديث حالة الفاتورة تلقائياً
                let status = 'unpaid';
                let statusText = 'غير مدفوعة';
                let statusClass = 'status-unpaid';
                let progressWidth = 0;

                if (paid <= 0) {
                    status = 'unpaid';
                    statusText = 'غير مدفوعة';
                    statusClass = 'status-unpaid';
                    progressWidth = 0;
                } else if (paid >= total) {
                    status = 'paid';
                    statusText = 'مدفوعة';
                    statusClass = 'status-paid';
                    progressWidth = 100;
                } else {
                    status = 'partial';
                    statusText = 'مدفوعة جزئياً';
                    statusClass = 'status-partial';
                    progressWidth = (paid / total) * 100;
                }

                $('#status').val(status);
                $('#status-display').text(statusText)
                    .removeClass('status-unpaid status-partial status-paid')
                    .addClass(statusClass);

                $('.progress-bar').css('width', progressWidth + '%');
            }

            // حساب المبلغ المتبقي تلقائياً
            $('#total_amount, #paid_amount').on('input', updateAmounts);

            // تغيير رمز العملة عند تغيير نوع العملة
            $('#currency').change(function() {
                let currency = $(this).val();
                let symbol = '$';

                if (currency === 'EUR') symbol = '€';
                if (currency === 'SAR') symbol = 'ر.س';

                $('.currency-symbol').text(symbol);

                // تحديث عرض العملة في بطاقات الملخص
                const total = parseFloat($('#total_amount').val()) || 0;
                const paid = parseFloat($('#paid_amount').val()) || 0;
                const remaining = total - paid;

                $('#total-amount-display').text(symbol + total.toFixed(2));
                $('#paid-amount-display').text(symbol + paid.toFixed(2));
                $('#due-amount-display').text(symbol + remaining.toFixed(2));
            });

            // التهيئة الأولية
            updateAmounts();
        });
    </script>
@endsection


