<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عقد إيجار مستودع - النظام اللوجستي</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/contract-style.css') }}">
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
