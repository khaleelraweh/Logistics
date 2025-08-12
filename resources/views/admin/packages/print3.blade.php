<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>سجل الطرد - {{ $package->tracking_number ?? 'غير محدد' }}</title>
    <style>
        body { font-family: "Arial", sans-serif; margin: 0; padding: 20px; color: #333; }
        .document { max-width: 800px; margin: 0 auto 40px auto; border: 1px solid #ddd; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #2c3e50; padding-bottom: 15px; }
        .header h1 { color: #2c3e50; margin: 0; font-size: 24px; }
        .section { margin-bottom: 20px; padding: 15px; background-color: #f9f9f9; border-radius: 5px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .info-item { margin-bottom: 8px; }
        .info-label { font-weight: bold; color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .tracking-number { font-size: 18px; font-weight: bold; text-align: center; padding: 10px; background-color: #e3f2fd; border-radius: 5px; margin: 15px 0; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #777; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>

    {{-- بيانات الطرد العامة --}}
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
                    <span class="info-label">تاريخ الإنشاء:</span>
                    <span>{{ optional($package->created_at)->format('d/m/Y H:i') ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">نوع الخدمة:</span>
                    <span>{{ $package->package_type ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">طريقة الدفع:</span>
                    <span>{{ $package->payment_method ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">الوزن:</span>
                    <span>{{ $package->weight ?? '-' }} كجم</span>
                </div>
                <div class="info-item">
                    <span class="info-label">الأبعاد:</span>
                    <span>
                        {{ $package->dimensions['length'] ?? '-' }} ×
                        {{ $package->dimensions['width'] ?? '-' }} ×
                        {{ $package->dimensions['height'] ?? '-' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- تفاصيل المنتجات --}}
    @if($package->packageProducts->count())
        @foreach($package->packageProducts as $index => $product)
        <div class="document page-break">
            <div class="header">
                <h1>LogesTechsKSA</h1>
                <div class="commercial-number">السجل التجاري: {{ $package->commercial_number ?? '123456789' }}</div>
            </div>

            <div class="tracking-number">
                رقم متابعة الطرد: {{ $package->tracking_number ?? 'غير محدد' }}:{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
            </div>

            <div class="section">
                <h3>معلومات المنتج</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">النوع:</span>
                        <span>{{ $product->type ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">الاسم المخصص:</span>
                        <span>{{ $product->custom_name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">الكمية:</span>
                        <span>{{ $product->quantity ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">سعر الوحدة:</span>
                        <span>{{ $product->price_per_unit ?? '0' }} ريال</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">السعر الإجمالي:</span>
                        <span>{{ $product->total_price ?? '0' }} ريال</span>
                    </div>
                </div>
            </div>

            <div class="footer">
                تم إنشاء هذا السجل بواسطة نظام LogesTechsKSA في {{ now()->format('d/m/Y H:i') }}
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
