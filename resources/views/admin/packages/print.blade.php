<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>سجل الطرد - {{ $package->tracking_number ?? 'غير محدد' }}</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .document {
            max-width: 800px;
            margin: 0 auto 40px auto;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #2c3e50;
            margin: 0;
            font-size: 24px;
        }
        .header .commercial-number {
            font-weight: bold;
            font-size: 16px;
            margin: 5px 0;
        }
        .section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .section h3 {
            margin-top: 0;
            color: #2c3e50;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .info-item {
            margin-bottom: 8px;
        }
        .info-label {
            font-weight: bold;
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .notes {
            background-color: #fff8e1;
            padding: 10px;
            border-left: 4px solid #ffc107;
        }
        .tracking-number {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background-color: #e3f2fd;
            border-radius: 5px;
            margin: 15px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
        .page-break {
            page-break-after: always;
        }
        .product-image {
            max-width: 150px;
            max-height: 150px;
            margin: 10px auto;
            display: block;
        }
        .barcode {
            text-align: center;
            margin: 15px 0;
            font-family: 'Libre Barcode 128', cursive;
            font-size: 30px;
        }
    </style>
</head>
<body>

    {{-- صفحة معلومات الطرد الرئيسية --}}
    <div class="document">
        <div class="header">
            <h1>LogesTechsKSA</h1>
            <div class="commercial-number">السجل التجاري: {{ $package->commercial_number ?? '123456789' }}</div>
        </div>

        <div class="tracking-number">
            رقم متابعة الطرد: {{ $package->tracking_number ?? 'غير محدد' }}
        </div>

        <div class="section">
            <h3>معلومات أساسية</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">تاريخ إنشاء الطرد:</span>
                    <span>{{ optional($package->created_at)->format('d/m/Y H:i') ?? 'غير محدد' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">نوع الطرد:</span>
                    <span>{{ $package->package_type ? __('package.type_' . $package->package_type) : 'غير محدد' }}</span>
                    {{-- <span>{{ $package->package_type ?? 'غير محدد' }}</span> --}}
                </div>
                <div class="info-item">
                    <span class="info-label">الكمية:</span>
                    <span>{{ $package->quantity ?? 'غير محدد' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">طريقة التوصيل:</span>
                    <span >{{$package->delivery_method  ? __('package.speed_' . $package->delivery_speed) : 'غير محدد' }}</span>
                </div>
            </div>
        </div>

        <div class="info-grid">
            <div class="section">
                <h3>معلومات المرسل</h3>
                <div class="info-item">
                    <span class="info-label">الاسم:</span>
                    <span>{{ $package->sender_full_name ?? 'غير محدد' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">الهاتف:</span>
                    <span>{{ $package->sender_phone ?? 'غير محدد' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">العنوان:</span>
                    <span>{{ $package->sender_address ?? 'غير محدد' }}</span>
                </div>
            </div>

            <div class="section">
                <h3>معلومات المستلم</h3>
                <div class="info-item">
                    <span class="info-label">الاسم:</span>
                    <span>{{ $package->receiver_full_name ?? 'غير محدد' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">الهاتف:</span>
                    <span>{{ $package->receiver_phone ?? 'غير محدد' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">العنوان:</span>
                    <span>{{ $package->receiver_address ?? 'غير محدد' }}</span>
                </div>
            </div>
        </div>

        <div class="section">
            <h3>تفاصيل الطرد</h3>
            <div class="info-item">
                <span class="info-label">المحتويات:</span>
                <span>{{ $package->contents ?? '-' }}</span>
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">الوزن:</span>
                    <span>{{ $package->weight ?? '-' }} كجم</span>
                </div>
                <div class="info-item">
                    <span class="info-label">الأبعاد:</span>
                    <span>
                        {{ $package->dimensions['length'] ?? '-' }} سم ×
                        {{ $package->dimensions['width'] ?? '-' }} سم ×
                        {{ $package->dimensions['height'] ?? '-' }} سم
                    </span>
                </div>
            </div>
        </div>

        <div class="section">
            <h3>التحصيل المالي</h3>
            <table>
                <thead>
                    <tr>
                        <th>مبلغ التحصيل</th>
                        <th>طريقة الدفع</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $package->total_fee ?? '0' }} SAR</td>
                        {{-- <td>{{ $package->payment_method ?? '-' }}</td> --}}
                        <td>{{ $package->payment_method_translated  ?? '-'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section notes">
            <h3>ملاحظات</h3>
            <p>{{ $package->notes ?? '-' }}</p>
        </div>

        <div class="footer">
            تم إنشاء هذا السجل بواسطة نظام LogesTechsKSA في {{ date('d/m/Y H:i') }}
        </div>
    </div>

    {{-- صفحات المنتجات (ملصقات) --}}
    @if($package->packageProducts && $package->packageProducts->count() > 0)
        @foreach($package->packageProducts as $index => $product)

            <div class="document page-break">
                <div class="header">
                    <h1>LogesTechsKSA</h1>
                    <div class="commercial-number">السجل التجاري: {{ $package->commercial_number ?? '123456789' }}</div>
                </div>

                <div class="tracking-number">
                    رقم متابعة الطرد: {{ $package->tracking_number ?? 'غير محدد' }}:{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                </div>

                @if($product && $product->image)
                    <img src="{{ $product->image }}" class="product-image" alt="صورة المنتج">
                @endif

                <div class="barcode">
                    *{{ $package->tracking_number ?? 'غير محدد' }}:{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}*
                </div>

                <div class="section">
                    <h3>معلومات المنتج</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">الاسم:</span>
                            <span>{{ $product->custom_name ?? 'غير محدد' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">النوع:</span>
                            <span>{{ $product->type ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">الكمية:</span>
                            <span>{{ $packageProduct->quantity ?? '1' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">السعر:</span>
                            <span>{{ $packageProduct->price_per_unit ?? '0' }} ريال</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">الوزن:</span>
                            <span>{{ $product->weight ?? '-' }} كجم</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">الأبعاد:</span>
                            <span>
                                {{ $product->dimensions['length'] ?? '-' }} سم ×
                                {{ $product->dimensions['width'] ?? '-' }} سم ×
                                {{ $product->dimensions['height'] ?? '-' }} سم
                            </span>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h3>معلومات المستلم</h3>
                    <div class="info-item">
                        <span class="info-label">الاسم:</span>
                        <span>{{ $package->receiver_full_name ?? 'غير محدد' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">الهاتف:</span>
                        <span>{{ $package->receiver_phone ?? 'غير محدد' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">العنوان:</span>
                        <span>{{ $package->receiver_address ?? 'غير محدد' }}</span> <br>
                        <span>{{ $package->receiver_country }} - {{ $package->receiver_region }} - {{ $package->receiver_city }} - {{ $package->receiver_district }}  </span>
                    </div>
                </div>

                <div class="footer">
                    تم إنشاء هذا السجل بواسطة نظام LogesTechsKSA في {{ date('d/m/Y H:i') }}
                </div>
            </div>
        @endforeach
    @else
        <div class="document">
            <p>لا توجد منتجات في هذا الطرد.</p>
        </div>
    @endif

</body>
</html>
