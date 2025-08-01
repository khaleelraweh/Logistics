@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">إضافة طرد جديد</h2>
    <form action="{{ route('admin.packages.store') }}" method="POST">
        @csrf

        <!-- التاجر (اختياري) -->
        <div class="mb-3">
            <label for="merchant_id" class="form-label">التاجر (اختياري)</label>
            <select name="merchant_id" id="merchant_id" class="form-select">
                <option value="">بدون تاجر</option>
                @foreach($merchants as $merchant)
                    <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- معلومات المرسل -->
        <h5>معلومات المرسل (إذا لم يكن تاجرًا)</h5>
        <div class="mb-3">
            <label class="form-label">اسم المرسل</label>
            <input type="text" name="sender_name" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">هاتف المرسل</label>
            <input type="text" name="sender_phone" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">عنوان المرسل</label>
            <textarea name="sender_address" class="form-control"></textarea>
        </div>

        <!-- معلومات المستلم -->
        <h5>معلومات المستلم</h5>
        <div class="mb-3">
            <label class="form-label">اسم المستلم</label>
            <input type="text" name="receiver_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">هاتف المستلم</label>
            <input type="text" name="receiver_phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">عنوان المستلم</label>
            <textarea name="receiver_address" class="form-control" required></textarea>
        </div>

        <!-- تفاصيل الطرد -->
        <h5>تفاصيل الطرد</h5>
        <div class="mb-3">
            <label class="form-label">رقم التتبع</label>
            <input type="text" name="tracking_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الوزن (جرام)</label>
            <input type="number" name="weight" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">الأبعاد (JSON)</label>
            <textarea name="dimensions" class="form-control"></textarea>
        </div>

        <!-- الرسوم -->
        <h5>الرسوم</h5>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">رسوم التوصيل</label>
                <input type="number" name="delivery_fee" step="0.01" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">رسوم التأمين</label>
                <input type="number" name="insurance_fee" step="0.01" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">رسوم الخدمة</label>
                <input type="number" name="service_fee" step="0.01" class="form-control">
            </div>
        </div>

        <!-- طريقة التوصيل والنوع -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">طريقة التوصيل</label>
                <select name="delivery_method" class="form-select">
                    <option value="standard">عادي</option>
                    <option value="express">سريع</option>
                    <option value="pickup">استلام</option>
                    <option value="courier">مندوب</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">نوع الطرد</label>
                <select name="package_type" class="form-select">
                    <option value="box">صندوق</option>
                    <option value="envelope">ظرف</option>
                    <option value="pallet">منصة</option>
                    <option value="tube">أنبوب</option>
                    <option value="bag">حقيبة</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">حجم الطرد</label>
                <select name="package_size" class="form-select">
                    <option value="small">صغير</option>
                    <option value="medium" selected>متوسط</option>
                    <option value="large">كبير</option>
                    <option value="oversized">كبير جدًا</option>
                </select>
            </div>
        </div>

        <!-- خيارات خاصة -->
        <h5>خصائص إضافية</h5>
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="attributes[is_fragile]" value="1">
            <label class="form-check-label">الطرد هش</label>
        </div>
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="attributes[is_cod]" value="1">
            <label class="form-check-label">الدفع عند الاستلام</label>
        </div>
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="attributes[is_signature_required]" value="1">
            <label class="form-check-label">يتطلب توقيع</label>
        </div>

        <!-- بيانات الاستلام -->
        <h5>بيانات المصدر</h5>
        <div class="mb-3">
            <label class="form-label">نوع المصدر</label>
            <select name="origin_type" class="form-select">
                <option value="warehouse">مستودع</option>
                <option value="store">متجر</option>
                <option value="home">منزل</option>
                <option value="other">أخرى</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">عنوان المصدر (نصي)</label>
            <textarea name="origin_address" class="form-control"></textarea>
        </div>

        <!-- زر الحفظ -->
        <button type="submit" class="btn btn-primary">حفظ الطرد</button>
    </form>
</div>
@endsection
