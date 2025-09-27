<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء طلب إرجاع</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border: none;
        }
        .card-header {
            background-color: #4a6fdc;
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }
        .info-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        .info-value {
            color: #333;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }
        .map-container {
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }
        .section-title {
            border-bottom: 2px solid #4a6fdc;
            padding-bottom: 10px;
            margin: 25px 0 15px;
            color: #4a6fdc;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
        .package-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            display: none; /* سيتم إظهاره عبر JavaScript */
        }
        .product-table {
            font-size: 0.9rem;
        }
        .product-table th {
            background-color: #f1f4f9;
        }
        .sender-info, .receiver-info {
            display: none; /* سيتم إظهاره عبر JavaScript */
        }
        .coordinates {
            font-family: monospace;
            background-color: #f8f9fa;
            padding: 5px;
            border-radius: 4px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">إنشاء طلب إرجاع</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="#">إدارة طلبات الإرجاع</a></li>
                            <li class="breadcrumb-item active">إنشاء طلب إرجاع</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        معلومات طلب الإرجاع
                    </div>
                    <div class="card-body">
                        <form>
                            <!-- Package Selection -->
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label required-field">الطرد</label>
                                <div class="col-sm-10">
                                    <select id="packageSelect" class="form-select" onchange="showPackageDetails()">
                                        <option value="">اختر الطرد</option>
                                        <option value="1">123456789 - أحمد محمد (جدة)</option>
                                        <option value="2">987654321 - سعيد عبدالله (الرياض)</option>
                                    </select>
                                    <div class="form-text">اختر الطرد الذي تريد إنشاء طلب إرجاع له</div>
                                </div>
                            </div>

                            <!-- Package Details (Initially Hidden) -->
                            <div id="packageDetails" class="package-details">
                                <h5 class="section-title">تفاصيل الطرد</h5>

                                <div class="row">
                                    <!-- Sender Information -->
                                    <div class="col-md-6">
                                        <div class="card sender-info" id="senderInfo1">
                                            <div class="card-header bg-info py-2">
                                                <i class="bi bi-person me-2"></i> معلومات المرسل - الطرد #123456789
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="info-label">الاسم الكامل</div>
                                                        <div class="info-value">محمد أحمد</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">رقم الهاتف</div>
                                                        <div class="info-value">+966512345678</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="info-label">العنوان</div>
                                                        <div class="info-value">حي الرياض، شارع الملك فهد، الرياض 12345</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">المدينة</div>
                                                        <div class="info-value">الرياض</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">المنطقة</div>
                                                        <div class="info-value">منطقة الرياض</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">خط الطول</div>
                                                        <div class="info-value coordinates">46.6752957</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">خط العرض</div>
                                                        <div class="info-value coordinates">24.7135517</div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="map-container">
                                                            <i class="bi bi-geo-alt me-2"></i> خريطة موقع المرسل
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card sender-info" id="senderInfo2" style="display: none;">
                                            <div class="card-header bg-info py-2">
                                                <i class="bi bi-person me-2"></i> معلومات المرسل - الطرد #987654321
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="info-label">الاسم الكامل</div>
                                                        <div class="info-value">عبدالله السعدي</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">رقم الهاتف</div>
                                                        <div class="info-value">+966587654321</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="info-label">العنوان</div>
                                                        <div class="info-value">حي النور، شارع الأمير Sultan، جدة 23456</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">المدينة</div>
                                                        <div class="info-value">جدة</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">المنطقة</div>
                                                        <div class="info-value">منطقة مكة المكرمة</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">خط الطول</div>
                                                        <div class="info-value coordinates">39.1493614</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">خط العرض</div>
                                                        <div class="info-value coordinates">21.5434861</div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="map-container">
                                                            <i class="bi bi-geo-alt me-2"></i> خريطة موقع المرسل
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Receiver Information -->
                                    <div class="col-md-6">
                                        <div class="card receiver-info" id="receiverInfo1">
                                            <div class="card-header bg-success py-2">
                                                <i class="bi bi-person me-2"></i> معلومات المستلم - الطرد #123456789
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="info-label">الاسم الكامل</div>
                                                        <div class="info-value">أحمد محمد</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">رقم الهاتف</div>
                                                        <div class="info-value">+966512345679</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="info-label">العنوان</div>
                                                        <div class="info-value">حي النخيل، شارع التحلية، جدة 54321</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">المدينة</div>
                                                        <div class="info-value">جدة</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">المنطقة</div>
                                                        <div class="info-value">منطقة مكة المكرمة</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">خط الطول</div>
                                                        <div class="info-value coordinates">39.1722166</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">خط العرض</div>
                                                        <div class="info-value coordinates">21.4852866</div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="map-container">
                                                            <i class="bi bi-geo-alt me-2"></i> خريطة موقع المستلم
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card receiver-info" id="receiverInfo2" style="display: none;">
                                            <div class="card-header bg-success py-2">
                                                <i class="bi bi-person me-2"></i> معلومات المستلم - الطرد #987654321
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="info-label">الاسم الكامل</div>
                                                        <div class="info-value">سعيد عبدالله</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">رقم الهاتف</div>
                                                        <div class="info-value">+966598765432</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="info-label">العنوان</div>
                                                        <div class="info-value">حي العليا، شارع العروبة، الرياض 67890</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">المدينة</div>
                                                        <div class="info-value">الرياض</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">المنطقة</div>
                                                        <div class="info-value">منطقة الرياض</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">خط الطول</div>
                                                        <div class="info-value coordinates">46.7343861</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="info-label">خط العرض</div>
                                                        <div class="info-value coordinates">24.7253899</div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="map-container">
                                                            <i class="bi bi-geo-alt me-2"></i> خريطة موقع المستلم
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Package Products -->
                                <h5 class="section-title mt-4">منتجات الطرد</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered product-table">
                                        <thead>
                                            <tr>
                                                <th>نوع المنتج</th>
                                                <th>اسم المنتج</th>
                                                <th>الكمية المشحونة</th>
                                                <th>الكمية المراد إرجاعها</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>منتج مخزون</td>
                                                <td>هاتف ذكي - Samsung Galaxy S22</td>
                                                <td>2</td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm" min="0" max="2" value="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>منتج مخصص</td>
                                                <td>حقيبة جلدية</td>
                                                <td>1</td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm" min="0" max="1" value="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>منتج مخزون</td>
                                                <td>سماعات لاسلكية - Sony WH-1000XM4</td>
                                                <td>3</td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm" min="0" max="3" value="0">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Driver Selection -->
                            <h5 class="section-title">معلومات التسليم</h5>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-field">السائق</label>
                                <div class="col-sm-10">
                                    <select class="form-select">
                                        <option value="">اختر السائق</option>
                                        <option value="1">علي أحمد - سيارة</option>
                                        <option value="2">خالد سعيد - دراجة نارية</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Return Type -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-field">نوع الإرجاع</label>
                                <div class="col-sm-10">
                                    <select class="form-select">
                                        <option value="to_warehouse">إلى المستودع</option>
                                        <option value="to_merchant">إلى التاجر</option>
                                        <option value="to_both">إلى المستودع والتاجر</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Target Address -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">عنوان الوجهة</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="أدخل عنوان الوجهة">
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="col-form-label required-field">تاريخ الطلب</label>
                                    <input type="date" class="form-control" value="2023-11-15">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">تاريخ الاستلام</label>
                                    <input type="date" class="form-control" value="2023-11-20">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label required-field">الحالة</label>
                                <div class="col-sm-10">
                                    <select class="form-select">
                                        <option value="requested">مطلوب</option>
                                        <option value="in_transit">قيد النقل</option>
                                        <option value="received">تم الاستلام</option>
                                        <option value="rejected">مرفوض</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Reason -->
                            <div class="row mb-4">
                                <label class="col-sm-2 col-form-label">السبب</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" placeholder="أدخل سبب الإرجاع (إن وجد)"></textarea>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="text-start pt-3">
                                <button type="button" class="btn btn-primary px-4">
                                    <i class="bi bi-save me-2"></i> حفظ طلب الإرجاع
                                </button>
                                <a href="#" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-x-circle me-2"></i> إلغاء
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // دالة لعرض تفاصيل الطرد عند الاختيار
        function showPackageDetails() {
            const packageSelect = document.getElementById('packageSelect');
            const packageDetails = document.getElementById('packageDetails');
            const selectedValue = packageSelect.value;

            // إخفاء جميع معلومات المرسلين والمستلمين
            document.querySelectorAll('.sender-info, .receiver-info').forEach(el => {
                el.style.display = 'none';
            });

            if (selectedValue) {
                // إظهار تفاصيل الطرد
                packageDetails.style.display = 'block';

                // إظهار المعلومات المناسبة للطرد المحدد
                document.getElementById('senderInfo' + selectedValue).style.display = 'block';
                document.getElementById('receiverInfo' + selectedValue).style.display = 'block';
            } else {
                // إخفاء تفاصيل الطرد إذا لم يتم اختيار أي طرد
                packageDetails.style.display = 'none';
            }
        }

        // تهيئة أولية لإظهار بيانات افتراضية إذا كان هناك قيمة محددة مسبقاً
        document.addEventListener('DOMContentLoaded', function() {
            // يمكنك هنا تهيئة القيم إذا كانت هناك قيمة محددة مسبقاً
            // document.getElementById('packageSelect').value = '1';
            // showPackageDetails();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
