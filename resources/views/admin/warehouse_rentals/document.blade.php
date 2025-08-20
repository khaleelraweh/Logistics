<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عقد إيجار مستودع - النظام اللوجستي</title>
    <style>

        /* تنسيقات عامة */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "DejaVu Sans", sans-serif !important;
            line-height: 1.8;
            direction: rtl;
            color: #333;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .contract-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        /* الهيدر */
        .contract-header {
            background: linear-gradient(135deg, #2c3e50, #1a2530);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .contract-header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .contract-header::after {
            content: "";
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #e74c3c, #c0392b);
        }

        .logo-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .company-logo {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #2c3e50;
        }

        .company-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .contract-number {
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: bold;
            margin-top: 15px;
            display: inline-block;
        }

        /* محتوى العقد */
        .contract-content {
            padding: 30px;
        }

        .section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px dashed #ddd;
        }

        .section-title {
            background: #f8f9fa;
            padding: 12px 20px;
            border-right: 5px solid #e74c3c;
            margin-bottom: 20px;
            font-weight: 700;
            color: #2c3e50;
            border-radius: 0 5px 5px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .info-value {
            padding: 10px 15px;
            background: #f8f9fa;
            border-radius: 5px;
            border-right: 3px solid #3498db;
        }

        /* الجداول */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        th {
            background: #2c3e50;
            color: white;
            padding: 12px;
            text-align: center;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        /* حالة العقد */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 14px;
        }

        .status-active {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-inactive {
            background: #ffebee;
            color: #c62828;
        }

        .status-expired {
            background: #fff3e0;
            color: #ef6c00;
        }

        /* التوقيعات */
        .signatures {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 50px;
        }

        .signature-box {
            text-align: center;
            padding: 20px;
            border-top: 2px solid #2c3e50;
        }

        .signature-title {
            margin-top: 15px;
            font-weight: 600;
            color: #2c3e50;
        }

        /* الفوتر */
        .contract-footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }

        /* زر الطباعة */
        .print-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: #2c3e50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .print-btn:hover {
            background: #1a2530;
        }

        /* تنسيقات الطباعة المحسنة */
        @media print {
            @page {
                size: A4;
                margin: 10mm 8mm 15mm 8mm;

                /* إزالة الرأس والتذييل الافتراضي بالكامل */
                margin-header: 0;
                margin-footer: 0;

                @top-left { content: ''; }
                @top-center { content: ''; }
                @top-right { content: ''; }
                @bottom-center {
                    content: "الصفحة " counter(page) " من " counter(pages);
                    font-family: "DejaVu Sans", sans-serif;
                    font-size: 10px;
                    color: #666;
                    margin-bottom: 3mm;
                }
            }

            body {
                background: white;
                padding: 0;
                margin: 0;
                font-size: 12px;
                line-height: 1.5;
                width: 100%;
                height: auto;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .contract-container {
                box-shadow: none;
                border-radius: 0;
                margin: 0;
                max-width: 100%;
                width: 100%;
                height: auto;
            }

            .no-print {
                display: none !important;
            }

            .contract-header {
                padding: 15px;
                page-break-after: avoid;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .contract-header h1 {
                font-size: 22px;
            }

            .contract-content {
                padding: 15px 10px;
            }

            .section {
                margin-bottom: 15px;
                padding-bottom: 10px;
                page-break-inside: avoid;
            }

            .info-grid {
                gap: 8px;
                margin-bottom: 12px;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .info-value {
                padding: 6px 8px;
                font-size: 11px;
            }

            table {
                font-size: 10px;
                page-break-inside: avoid;
                width: 100%;
                margin: 10px 0;
            }

            th, td {
                padding: 6px 4px;
            }

            .signatures {
                margin-top: 20px;
                page-break-before: avoid;
                page-break-inside: avoid;
                gap: 15px;
            }

            .signature-box {
                padding: 10px;
            }

            /* تحسين المسافات بين الأقسام في الطباعة */
            .section + .section {
                margin-top: 15px;
            }

            /* منع تقسيم الصفوف بين الصفحات */
            tr {
                page-break-inside: avoid;
            }

            /* تحسين تنسيق القوائم في الطباعة */
            ol {
                padding-right: 12px;
            }

            li {
                margin-bottom: 6px;
                font-size: 11px;
            }

            /* إخفاء العناصر غير المرغوبة في الطباعة */
            .stamp {
                display: none;
            }

            .contract-footer {
                padding: 12px;
                font-size: 11px;
                page-break-before: avoid;
            }

            /* تحسين مظهر العناصر في الطباعة */
            .status-badge {
                font-size: 10px;
                padding: 3px 6px;
            }

            .section-title {
                font-size: 14px;
                padding: 8px 12px;
                margin-bottom: 12px;
            }

            /* ضمان ظهور الألوان في الطباعة */
            .contract-header,
            .contract-header h1,
            .contract-number,
            th,
            .contract-footer {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color: white !important;
            }

            .status-active,
            .status-inactive,
            .status-expired,
            .info-value,
            .section-title {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* تحسين خاص للجداول القصيرة */
            .compact-table {
                font-size: 9px;
            }

            .compact-table th,
            .compact-table td {
                padding: 4px 3px;
            }

            /* منع الهوامش الكبيرة بعد الجداول القصيرة */
            table + .section {
                margin-top: 5px;
            }

            /* تحسين تخطيط التوقيعات للطباعة */
            .signatures {
                margin-top: 30px;
                page-break-inside: avoid;
            }
        }

        /* تحسينات إضافية للجداول القصيرة */
        .table-container {
            overflow-x: auto;
            margin-bottom: 15px;
        }

        /* نمط للجداول ذات الصفوف القليلة */
        .short-table {
            width: auto;
            min-width: 100%;
            margin: 0 auto;
        }

    </style>
</head>
<body>
    <div class="contract-container">
        <div class="contract-header">
            <div class="logo-section">
                <div class="company-logo">
                    <img src="{{asset('admin/assets/images/logo-dark.png')}}" alt="logo-dark">
                </div>
                <div>
                    <h1>عقد إيجار مستودع</h1>
                    <div class="contract-number">رقم العقد: {{ $contract->id }}</div>
                </div>
            </div>
        </div>

        <div class="contract-content">
            <div class="section">
                <h2 class="section-title">أطراف العقد</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">الطرف الأول (المؤجر)</div>
                        <div class="info-value">
                            <strong>شركة النقل اللوجستي</strong><br>
                            السجل التجاري: 1234567890<br>
                            العنوان: المدينة، الحي، الشارع<br>
                            الهاتف: 00966123456789<br>
                            البريد الإلكتروني: info@logistics.com
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">الطرف الثاني (المستأجر)</div>
                        <div class="info-value">
                            <strong>{{ $contract->merchant->name }}</strong><br>
                            الشخص المسؤول: {{ $contract->merchant->contact_person }}<br>
                            الهاتف: {{ $contract->merchant->phone }}<br>
                            البريد الإلكتروني: {{ $contract->merchant->email }}<br>
                            العنوان: {{ $contract->merchant->address }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">مدة العقد وقيمته</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">تاريخ بداية العقد</div>
                        <div class="info-value">{{ $contract->rental_start->format('Y-m-d') }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">تاريخ نهاية العقد</div>
                        <div class="info-value">{{ $contract->rental_end->format('Y-m-d') }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">مدة العقد</div>
                        <div class="info-value">{{ $contract->rental_start->diffInDays($contract->rental_end) }} يوم</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">القيمة الإجمالية للعقد</div>
                        <div class="info-value">{{ number_format($contract->price, 2) }} ريال سعودي</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">حالة العقد</div>
                        <div class="info-value">
                            @if($contract->status == 1)
                                <span class="status-badge status-active">نشط</span>
                            @elseif($contract->status == 0)
                                <span class="status-badge status-inactive">غير نشط</span>
                            @else
                                <span class="status-badge status-expired">منتهي</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">الرفوف المؤجرة</h2>
                <div class="table-container">
                    <table class="short-table">
                        <thead>
                            <tr>
                                <th>رمز الرف</th>
                                <th>المستودع</th>
                                <th>الحجم</th>
                                <th>السعر (ريال/شهر)</th>
                                <th>تاريخ البداية</th>
                                <th>تاريخ النهاية</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contract->shelves as $shelf)
                                <tr>
                                    <td>{{ $shelf->code }}</td>
                                    <td>{{ $shelf->warehouse->name ?? 'غير محدد' }}</td>
                                    <td>{{ $shelf->size }}</td>
                                    <td>{{ number_format($shelf->pivot->custom_price ?? $shelf->price, 2) }}</td>
                                    <td>{{ $shelf->pivot->custom_start ?? $contract->rental_start->format('Y-m-d') }}</td>
                                    <td>{{ $shelf->pivot->custom_end ?? $contract->rental_end->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">البيانات المالية</h2>

                @if($contract->invoice)
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">رقم الفاتورة</div>
                            <div class="info-value">{{ $contract->invoice->invoice_number }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">المبلغ الإجمالي</div>
                            <div class="info-value">{{ number_format($contract->invoice->total_amount, 2) }} ريال</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">المبلغ المدفوع</div>
                            <div class="info-value">{{ number_format($contract->paid_amount, 2) }} ريال</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">المبلغ المتبقي</div>
                            <div class="info-value">{{ number_format($contract->remaining_amount, 2) }} ريال</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">تاريخ الإصدار</div>
                            <div class="info-value">{{ $contract->invoice->issued_at->format('Y-m-d') }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">تاريخ الاستحقاق</div>
                            <div class="info-value">{{ $contract->invoice->due_date->format('Y-m-d') }}</div>
                        </div>
                    </div>

                    <h3 class="section-title" style="margin-top: 20px;">تفاصيل الدفعات</h3>

                    @if($contract->invoice->payments->count())
                        <div class="table-container">
                            <table class="compact-table">
                                <thead>
                                    <tr>
                                        <th>رقم الدفعة</th>
                                        <th>المبلغ (ريال)</th>
                                        <th>طريقة الدفع</th>
                                        <th>تاريخ الدفع</th>
                                        <th>الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contract->invoice->payments as $payment)
                                        <tr>
                                            <td>{{ $payment->id }}</td>
                                            <td>{{ number_format($payment->amount, 2) }}</td>
                                            <td>{{ $payment->method ?? 'غير محدد' }}</td>
                                            <td>{{ $payment->paid_on ? $payment->paid_on->format('Y-m-d') : 'غير مدفوع' }}</td>
                                            <td>
                                                @if($payment->status == 'paid')
                                                    <span class="status-badge status-active">مدفوع</span>
                                                @else
                                                    <span class="status-badge status-inactive">غير مدفوع</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="info-value" style="text-align: center; padding: 15px;">
                            لا توجد دفعات مرتبطة بهذه الفاتورة حتى الآن.
                        </div>
                    @endif
                @else
                    <div class="info-value" style="text-align: center; padding: 15px;">
                        لا توجد فاتورة مرتبطة بهذا العقد.
                    </div>
                @endif
            </div>

            <div class="section">
                <h2 class="section-title">بنود العقد</h2>
                <div style="padding: 12px; background: #f8f9fa; border-radius: 5px;">
                    <ol style="padding-right: 18px;">
                        <li>يمتلك الطرف الثاني الحق في استخدام المساحة المستأجرة لتخزين البضائع والمنتجات وفقاً للشروط المتفق عليها.</li>
                        <li>يلتزم الطرف الثاني بدفع كامل المبالغ المستحقة в المواعيد المحددة وفقاً لشروط الدفع المتفق عليها.</li>
                        <li>يلتزم الطرف الثاني بعدم تخزين مواد خطرة أو محظورة قانوناً داخل المساحة المستأجرة.</li>
                        <li>يحق للطرف الأول فحص المساحة المستأجرة بعد إشعار مسبق للطرف الثاني.</li>
                        <li>في حالة عدم السداد في الموعد المحدد، يحق للطرف الأول تعليق الخدمات أو إنهاء العقد.</li>
                        <li>يحق للطرف الثاني تجديد العقد قبل انتهاء مدته بشهر على الأقل.</li>
                        <li>يتم تجديد العقد تلقائياً لمدة مماثلة إذا لم يتم الإخطار بإنهائه قبل نهايته بشهر على الأقل.</li>
                    </ol>
                </div>
            </div>

            <div class="signatures">
                <div class="signature-box">
                    <div class="signature-title">توقيع الطرف الأول (المؤجر)</div>
                    <p>الاسم: مدير الفرع</p>
                    <p>التاريخ: _______________</p>
                    <div style="height: 60px; margin-top: 15px; border-bottom: 1px solid #ccc;"></div>
                </div>

                <div class="signature-box">
                    <div class="signature-title">توقيع الطرف الثاني (المستأجر)</div>
                    <p>الاسم: {{ $contract->merchant->contact_person }}</p>
                    <p>التاريخ: _______________</p>
                    <div style="height: 60px; margin-top: 15px; border-bottom: 1px solid #ccc;"></div>
                </div>
            </div>
        </div>

        <div class="contract-footer">
            © 2023 نظام إدارة الخدمات اللوجستية. جميع الحقوق محفوظة.
        </div>
    </div>

    <button class="print-btn no-print" onclick="window.print()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        </svg>
        طباعة العقد
    </button>

    <script>
        // تحديث حالة العقد تلقائياً بناءً على التاريخ
        document.addEventListener('DOMContentLoaded', function() {
            const rentalEnd = new Date('{{ $contract->rental_end->format("Y-m-d") }}');
            const today = new Date();

            if (today > rentalEnd) {
                // إذا انتهت مدة العقد، نقوم بتحديث الحالة إلى منتهي
                const statusElement = document.querySelector('.info-value .status-badge');
                if (statusElement) {
                    statusElement.className = 'status-badge status-expired';
                    statusElement.textContent = 'منتهي';
                }
            }
        });
    </script>
</body>
</html>
