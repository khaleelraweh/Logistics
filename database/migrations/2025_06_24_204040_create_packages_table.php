<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // جدول الطرود (Packages)
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            // المفتاح الأساسي (ID) لكل طرد

            // ====================== بيانات المرسل ===========================
            // تاجر مرتبط (اختياري)
            $table->foreignId('merchant_id')->nullable()->constrained('merchants')->nullOnDelete();
            // يشير إلى التاجر الذي يملك الطرد، يمكن أن يكون فارغًا

            // معلومات المرسل (لطرد عام)
            $table->string('sender_first_name')->nullable();
            $table->string('sender_middle_name')->nullable();
            $table->string('sender_last_name')->nullable();
            // اسم المرسل (قد يكون متعدد اللغات أو يحتوي على عدة بيانات)، يمكن أن يكون فارغًا
            $table->string('sender_phone')->nullable();
            // رقم هاتف المرسل، اختياري
            $table->string('sender_email')->nullable();
            // ايميل المرسل

            // Trip sender information
            $table->string('sender_country')->nullable();
            $table->string('sender_region')->nullable();
            $table->string('sender_city')->nullable();
            $table->string('sender_district')->nullable();
            $table->string('sender_postal_code')->nullable();
            $table->string('sender_latitude')->nullable();
            $table->string('sender_longitude')->nullable();
            $table->string('sender_others')->nullable();

            // ====================== بيانات المستلم ===========================
            // تاجر المستلم (اختياري)
            $table->foreignId('receiver_merchant_id')->nullable()->constrained('merchants')->nullOnDelete();
            // معلومات المستلم (ضرورية)
            $table->string('receiver_first_name');
            $table->string('receiver_middle_name');
            $table->string('receiver_last_name');
            // اسم المستلم (قد يكون متعدد اللغات أو أكثر من قيمة)
            $table->string('receiver_phone');
            // رقم هاتف المستلم (ضروري)
            $table->string('receiver_email');
            // ايميل المستلم

            // Trip receiver information
            $table->string('receiver_country')->nullable();
            $table->string('receiver_region')->nullable();
            $table->string('receiver_city')->nullable();
            $table->string('receiver_district')->nullable();
            $table->string('receiver_postal_code')->nullable();
            $table->string('receiver_latitude')->nullable();
            $table->string('receiver_longitude')->nullable();
            $table->string('receiver_others')->nullable();


            //================== بيانات الطرد ==========================
            // محتويات الطرد
            $table->string('package_content')->nullable();
            // ملاحظات الطرد
            $table->string('package_note')->nullable();

            // ========== بيانات منتجات الطرد =================
            // علاقات أخرى مهمة
            $table->foreignId('rental_shelf_id')->nullable()->constrained('rental_shelves')->nullOnDelete();
            // الرف المؤجر الذي يخزن فيه الطرد (اختياري)
            $table->foreignId('parent_package_id')->nullable()->constrained('packages')->nullOnDelete();
            // إذا كان هذا الطرد جزءًا من طرد أكبر (طرد فرعي)، يُشير إلى الطرد الأب

            // ========= البيانات الفيزيائية للطرد ========
            // معلومات الطرد الفيزيائية
            $table->integer('weight')->nullable();
            // وزن الطرد بالجرام، اختياري
            $table->json('dimensions')->nullable();
            // أبعاد الطرد (طول، عرض، ارتفاع) بصيغة JSON

            $table->integer('quantity')->default(1);
            // عدد العناصر في الطرد، افتراضيًا 1

            // ============= التحصيل ============================
            // مسؤولية الدفع: التاجر أو المستلم
            $table->enum('payment_responsibility', ['merchant', 'recipient'])->default('merchant');

            // طريقة الدفع
            $table->enum('payment_method', [
                'prepaid',            // مدفوع مسبقاً
                'cash_on_delivery',   // الدفع عند الاستلام
                'exchange',           // تبديل
                'bring'               // إحضار
            ])->default('prepaid');

            // طريقة التحصيل
            $table->enum('collection_method', [
                'cash',               // كاش
                'cheque',             // شيك
                'bank_transfer',      // حوالة بنكية
                'e_wallet',           // محفظة إلكترونية
                'credit_card',        // بطاقة ائتمان
                'mada'                // مدى
            ])->default('cash');

            // الرسوم والتكاليف
            $table->decimal('delivery_fee', 10, 2)->default(0);
            // رسوم التوصيل

            $table->decimal('insurance_fee', 10, 2)->default(0);
            // رسوم التأمين على الطرد

            $table->decimal('service_fee', 10, 2)->default(0);
            // رسوم خدمات إضافية

            $table->decimal('total_fee', 10, 2)->default(0);
            // المجموع الكلي للرسوم

            $table->decimal('paid_amount', 10, 2)->default(0);
            // المبلغ المدفوع حتى الآن

            $table->decimal('due_amount', 10, 2)->default(0);
            // // المبلغ المتبقي للدفع

            $table->decimal('cod_amount', 10, 2)->default(0);
            // // مبلغ الدفع عند الاستلام (COD)



            //========== بيانات اضافية ===============

            // سرعة التوصيل المطلوبة
            $table->enum('delivery_speed', [
                'standard',        // عادي
                'express',         // سريع
                'same_day',        // توصيل نفس اليوم
                'next_day'         // توصيل اليوم التالي
            ])->default('standard');

            // بيانات حالة التسليم العامة
            $table->date('delivery_date')->nullable();
            // تاريخ التوصيل الفعلي (إن تم)


            // حالة الطرد
            $table->enum('status', [
                'pending',
                'assigned_to_driver',
                'driver_picked_up',
                'in_transit',
                'arrived_at_hub',
                'out_for_delivery',
                'delivered',
                'delivery_failed',
                'returned',
                'cancelled',
                'in_warehouse'
            ])->default('pending');
                // حالة الطرد الحالية، الافتراضية: قيد الانتظار

            // طريقة التوصيل
            $table->enum('delivery_method', [
                'standard',        // توصيل عادي
                'express',         // توصيل سريع
                'pickup',          // استلام من المتجر
                'courier'          // خدمة توصيل عبر مندوب
            ])->default('standard');

            // نوع الطرد
            $table->enum('package_type', [
                'box',             // صندوق
                'envelope',        // ظرف
                'pallet',          // منصة نقالة
                'tube',            // أنبوب
                'bag'              // حقيبة
            ])->default('box');

            // حجم الطرد
            $table->enum('package_size', [
                'small',           // صغير
                'medium',          // متوسط
                'large',           // كبير
                'oversized'        // كبير جدًا
            ])->default('medium');


            // مصدر الطرد
            $table->enum('origin_type', [
                'warehouse',       // مستودع
                'store',           // متجر
                'home',            // منزل
                'other'            // مصدر آخر
            ])->default('warehouse');


            $table->text('delivery_status_note')->nullable();
            // ملاحظات حول حالة التسليم (مثل تأخير بسبب الطقس)

            // خصائص إضافية للطرد بصيغة JSON
            $table->json('attributes')->nullable()->default(json_encode([
                "is_fragile" => true,                  // الطرد هش ويحتاج عناية خاصة
                "is_returnable" => false,              // هل يمكن إرجاع الطرد؟
                "is_confidential" => true,             // يحتوي على معلومات سرية
                "is_express" => false,                  // هل هو توصيل سريع؟
                "is_cod" => true,                       // هل الدفع عند الاستلام مفعل؟
                "is_gift" => false,                     // هل الطرد هدية؟
                "is_oversized" => false,                // هل الطرد كبير جدًا؟
                "is_hazardous_material" => false,      // يحتوي على مواد خطرة؟
                "is_temperature_controlled" => false,  // يحتاج إلى تحكم بدرجة الحرارة؟
                "is_perishable" => false,               // قابل للتلف؟
                "is_signature_required" => true,       // هل يتطلب توقيع عند التسليم؟
                "is_inspection_required" => false,     // هل يحتاج لتفتيش خاص؟
                "is_special_handling_required" => true // هل يحتاج معاملة خاصة؟
            ]));


            // بيانات الموقع الأصلي لاستلام الطرد
            $table->foreignId('origin_warehouse_id')->nullable()->constrained('warehouses')->onDelete('set null');
            // المستودع الذي استلم منه الطرد (اختياري)

              // تتبع الطرد
            $table->string('tracking_number')->unique();
            // رقم تتبع الطرد فريد لضمان إمكانية تتبعه بسهولة


            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
