<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
        <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

    <title>{{ __('package.package_record') }} - {{ $package->tracking_number ?? __('package.not_specified') }}</title>

    <style>

         body {direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }};text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};margin: 0;padding: 20px;color: #333;font-family: 'Cairo', sans-serif;}
        .document {max-width: 800px;margin: 0 auto 40px auto;border: 1px solid #ddd;padding: 20px;box-shadow: 0 0 10px rgba(0,0,0,0.1);}
        .header {text-align: center;margin-bottom: 20px;border-bottom: 2px solid #2c3e50;padding-bottom: 15px;}
        .header h1 {color: #2c3e50;margin: 0;font-size: 24px;}
        .header .commercial-number {font-weight: bold;font-size: 16px;margin: 5px 0;}
        .section {margin-bottom: 20px;padding: 15px;background-color: #f9f9f9;border-radius: 5px;}
        .section h3 {margin-top: 0;color: #2c3e50;border-bottom: 1px solid #ddd;padding-bottom: 5px;}
        .info-grid {display: grid;grid-template-columns: 1fr 1fr;gap: 15px;}
        .info-item {margin-bottom: 8px;}
        .info-label {font-weight: bold;color: #2c3e50;}
        table {width: 100%;border-collapse: collapse;margin-top: 10px;}
        th, td {border: 1px solid #ddd;padding: 8px;text-align: center;}
        th {background-color: #f2f2f2;}
        .notes {background-color: #fff8e1;padding: 10px;border-left: 4px solid #ffc107;}
        .tracking-number {font-size: 18px;font-weight: bold;text-align: center;padding: 10px;background-color: #e3f2fd;border-radius: 5px;margin: 15px 0;}
        .footer {text-align: center;margin-top: 20px;font-size: 12px;color: #777;}
        .page-break {page-break-after: always;}
        .product-image {max-width: 150px;max-height: 150px;margin: 10px auto;display: block;}
        .barcode {text-align: center;margin: 15px 0;font-family: 'Libre Barcode 128', cursive;font-size: 30px;}
    </style>
</head>

<body style="font-family: 'Cairo', sans-serif;">



    {{-- صفحة معلومات الطرد الرئيسية --}}
    <div class="document">
        <div class="header">
            <h1>LogesTechsKSA</h1>
            <div class="commercial-number">{{ __('package.commercial_number') }}: {{ $package->commercial_number ?? '123456789' }}</div>
        </div>

         <div class="tracking-number">
            {{ __('package.tracking_number') }}: {{ $package->tracking_number ?? __('package.not_specified') }}
        </div>

        <div class="section">
            <h3>{{ __('package.basic_info') }}</h3>
            <div class="info-grid">
                <div class="info-item">
                    <div><span class="info-label">{{ __('package.creation_date') }}:</span> {{ optional($package->created_at)->format('d/m/Y H:i') ?? __('package.not_specified') }}</div>
                </div>
                <div class="info-item">
                    <div><span class="info-label">{{ __('package.package_type') }}:</span> {{ $package->package_type ? __('package.type_' . $package->package_type) : __('package.not_specified') }}</div>
                </div>
                <div class="info-item">
                    <div><span class="info-label">{{ __('package.quantity') }}:</span> {{ $package->quantity ?? __('package.not_specified') }}</div>
                </div>
                <div class="info-item">
                    <div><span class="info-label">{{ __('package.delivery_method') }}:</span> {{ $package->delivery_method ? __('package.speed_' . $package->delivery_speed) : __('package.not_specified') }}</div>
                </div>
            </div>
        </div>

        <div class="info-grid">
            <div class="section">
                <h3>{{ __('package.sender_info') }}</h3>
                <div class="info-item"><span class="info-label">{{ __('package.name') }}:</span> {{ $package->sender_full_name ?? __('package.not_specified') }}</div>
                <div class="info-item"><span class="info-label">{{ __('package.phone') }}:</span> {{ $package->sender_phone ?? __('package.not_specified') }}</div>
                <div class="info-item"><span class="info-label">{{ __('package.address') }}:</span> {{ $package->sender_address ?? __('package.not_specified') }}</div>
            </div>

            <div class="section">
                <h3>{{ __('package.receiver_info') }}</h3>
                <div class="info-item"><span class="info-label">{{ __('package.name') }}:</span> {{ $package->receiver_full_name ?? __('package.not_specified') }}</div>
                <div class="info-item"><span class="info-label">{{ __('package.phone') }}:</span> {{ $package->receiver_phone ?? __('package.not_specified') }}</div>
                <div class="info-item"><span class="info-label">{{ __('package.address') }}:</span> {{ $package->receiver_address ?? __('package.not_specified') }}</div>
            </div>
        </div>

          <div class="section">
            <h3>{{ __('package.package_details') }}</h3>
            <div class="info-item"><span class="info-label">{{ __('package.contents') }}:</span> {{ $package->contents ?? '-' }}</div>
            <div class="info-item"><span class="info-label">{{ __('package.weight') }}:</span> {{ $package->weight ?? '-' }} {{ __('package.kg') }}</div>
            <div class="info-item"><span class="info-label">{{ __('package.dimensionss') }}:</span> {{ $package->dimensions['length'] ?? '-' }} {{ __('package.cm') }} ×{{ $package->dimensions['width'] ?? '-' }} {{ __('package.cm') }} ×{{ $package->dimensions['height'] ?? '-' }} {{ __('package.cm') }}</div>
        </div>

        <div class="section">
            <h3>{{ __('package.payment_collection') }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>{{ __('package.amount') }}</th>
                        <th>{{ __('package.payment_method') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $package->total_fee ?? '0' }} {{ __('general.sar') }}</td>
                        <td>{{ $package->payment_method_translated  ?? '-'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section notes">
            <h3>{{ __('package.notes') }}</h3>
            <p>{{ $package->notes ?? '-' }}</p>
        </div>

        <div class="footer">
            {{ __('package.generated_by') }} LogesTechsKSA {{ date('d/m/Y H:i') }}
        </div>
    </div>

    {{-- صفحات المنتجات (ملصقات) --}}
    @if($package->packageProducts && $package->packageProducts->count() > 0)
        @foreach($package->packageProducts as $index => $product)

            <div class="document page-break">
                <div class="header">
                    <h1>LogesTechsKSA</h1>
                    <div class="commercial-number"> {{ __('package.commercial_number') }}: {{ $package->commercial_number ?? '123456789' }}</div>
                </div>

                <div class="tracking-number">
                    {{ __('package.tracking_number') }}: {{ $package->tracking_number ?? __('package.not_specified') }}:{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                </div>

                @if($product && $product->image)
                    <img src="{{ $product->image }}" class="product-image" alt="صورة المنتج">
                @endif


                <div class="section">
                    <h3>{{ __('package.items_info') }}</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">{{ __('product.name') }}:</span>
                            <span>{{ $product->custom_name ?? __('package.not_specified')  }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">{{ __('product.type') }}:</span>
                            <span>{{ $product->type ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">{{ __('product.quantity') }}:</span>
                            <span>{{ $packageProduct->quantity ?? '1' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">{{ __('product.price_per_unit') }}:</span>
                            <span>{{ $packageProduct->price_per_unit ?? '0' }} {{ __('general.sar') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">{{ __('product.weight') }}:</span>
                            <span>{{ $product->weight ?? '-' }} {{ __('package.kg') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">{{ __('package.dimensionss') }}:</span>
                            <span>
                                {{ $product->dimensions['length'] ?? '-' }} {{ __('package.cm') }} ×
                                {{ $product->dimensions['width'] ?? '-' }} {{ __('package.cm') }} ×
                                {{ $product->dimensions['height'] ?? '-' }} {{ __('package.cm') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h3>{{ __('package.sender_Information') }}</h3>
                    <div class="info-item">
                        <span class="info-label">{{ __('package.sender_name') }}:</span>
                        <span>{{ $package->sender_full_name ?? __('package.not_specified') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{{ __('package.sender_phone') }}:</span>
                        <span>{{ $package->sender_phone ?? __('package.not_specified') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{{ __('package.sender_address') }}:</span>
                        <span>{{ $package->sender_address ?? __('package.not_specified') }}</span> <br>
                        <span>{{ $package->sender_country }} - {{ $package->receiver_region }} - {{ $package->receiver_city }} - {{ $package->receiver_district }}  </span>
                    </div>
                </div>

                <div class="section">
                    <h3>{{ __('package.receiver_Information') }}</h3>
                    <div class="info-item">
                        <span class="info-label">{{ __('package.receiver_name') }}:</span>
                        <span>{{ $package->receiver_full_name ?? __('package.not_specified') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{{ __('package.receiver_phone') }}:</span>
                        <span>{{ $package->receiver_phone ?? __('package.not_specified') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{{ __('package.receiver_address') }}:</span>
                        <span>{{ $package->receiver_address ?? __('package.not_specified') }}</span> <br>
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
