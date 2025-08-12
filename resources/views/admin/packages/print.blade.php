<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <title>سجل الطرد - {{ $package->id }}</title>
    <style>
        body { font-family: "Arial", sans-serif; direction: rtl; }
        /* أضف التنسيقات المطلوبة */
        .header { font-weight: bold; margin-bottom: 10px; }
        .section { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>سجل الطرد: {{ $package->tracking_number ?? 'غير محدد' }}</h2>
        <p>تاريخ الإنشاء: {{ $package->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="section">
        <h3>معلومات المرسل</h3>
        <p>الاسم: {{ $package->sender_first_name }} {{ $package->sender_last_name }}</p>
        <p>الهاتف: {{ $package->sender_phone }}</p>
        <p>العنوان: {{ $package->sender_city }}, {{ $package->sender_country }}</p>
    </div>

    <div class="section">
        <h3>معلومات المستلم</h3>
        <p>الاسم: {{ $package->receiver_first_name }} {{ $package->receiver_last_name }}</p>
        <p>الهاتف: {{ $package->receiver_phone }}</p>
        <p>العنوان: {{ $package->receiver_city }}, {{ $package->receiver_country }}</p>
    </div>

    <div class="section">
        <h3>تفاصيل الطرد</h3>
        <p>نوع الخدمة: {{ $package->package_type }}</p>
        <p>الحجم: {{ $package->package_size }}</p>
        <p>الوزن: {{ $package->weight }} كجم</p>
        <p>الأبعاد: الطول {{ $package->dimensions['length'] ?? '-' }} سم، العرض {{ $package->dimensions['width'] ?? '-' }} سم، الإرتفاع {{ $package->dimensions['height'] ?? '-' }} سم</p>
    </div>

    <div class="section">
        <h3>ملاحظات</h3>
        <p>{{ $package->delivery_status_note ?? '-' }}</p>
    </div>

    <!-- يمكنك إضافة المزيد حسب حاجتك -->
</body>
</html>
