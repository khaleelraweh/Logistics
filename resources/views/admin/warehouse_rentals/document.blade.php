<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>عقد إيجار #{{ $contract->id }}</title>
    <style>
        body { font-family: "DejaVu Sans", sans-serif; line-height: 1.8; direction: rtl; }
        h1, h2, h3 { text-align: center; margin: 15px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        .section-title { background: #f0f0f0; padding: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>عقد إيجار مستودع</h1>
    {{-- <p><strong>الطرف الأول (التاجر):</strong> {{ $contract->merchant->name['ar'] ?? $contract->merchant->name['en'] }}</p> --}}
    <p><strong>الطرف الأول (التاجر):</strong> {{ $contract->merchant->name }}</p>
    <p><strong>رقم العقد:</strong> {{ $contract->id }}</p>
    <p><strong>تاريخ البداية:</strong> {{ $contract->rental_start->format('Y-m-d') }}</p>
    <p><strong>تاريخ النهاية:</strong> {{ $contract->rental_end->format('Y-m-d') }}</p>
    <p><strong>الحالة:</strong> {!! $contract->status_label !!}</p>

     <p><strong>الطرف الثاني (الشركة اللوجستية ممثلة ب):</strong> مدير الفرع</p>

    <hr>

    <h2 class="section-title">تفاصيل الرفوف المؤجرة</h2>
    <table>
        <thead>
            <tr>
                <th>رمز الرف</th>
                <th>المستودع</th>
                <th>الحجم</th>
                <th>السعر</th>
                <th>الفترة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contract->shelves as $shelf)
                <tr>
                    <td>{{ $shelf->code }}</td>
                    <td>{{ $shelf->warehouse->name ?? '' }}</td>
                    <td>{{ $shelf->size }}</td>
                    <td>{{ $shelf->pivot->custom_price ?? $shelf->price }}</td>
                    <td>
                        {{ $shelf->pivot->custom_start ?? $contract->rental_start }} -
                        {{ $shelf->pivot->custom_end ?? $contract->rental_end }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="section-title">الفاتورة والدفع</h2>
    @if($contract->invoice)
        <table>
            <thead>
                <tr>
                    <th>رقم الفاتورة</th>
                    <th>المبلغ الكلي</th>
                    <th>المدفوع</th>
                    <th>المتبقي</th>
                    <th>تاريخ الإصدار</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $contract->invoice->invoice_number }}</td>
                    <td>{{ $contract->invoice->total_amount }}</td>
                    <td>{{ $contract->paid_amount }}</td>
                    <td>{{ $contract->remaining_amount }}</td>
                    <td>{{ $contract->invoice->issued_at }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <p>لا توجد فاتورة مرتبطة بهذا العقد.</p>
    @endif

        <h2 class="section-title">تفاصيل الدفعات</h2>
    @if($contract->invoice && $contract->invoice->payments->count())
        <table>
            <thead>
                <tr>
                    <th>رقم الدفعة</th>
                    <th>المبلغ</th>
                    <th>طريقة الدفع</th>
                    <th>التاريخ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contract->invoice->payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->method ?? 'غير محدد' }}</td>
                        <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>لا توجد دفعات مرتبطة بهذه الفاتورة.</p>
    @endif

</body>
</html>
