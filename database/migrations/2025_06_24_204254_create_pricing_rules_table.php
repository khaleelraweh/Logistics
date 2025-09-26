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
        // جدول قواعد التسعير
       Schema::create('pricing_rules', function (Blueprint $table) {
            $table->id();

            // الاسم والوصف
            $table->json('name');
            $table->json('description')->nullable();

            // نوع القاعدة
            $table->enum('type', ['delivery', 'storage', 'handling'])->default('delivery');

            // المنطقة أو المدينة (عشان داخل/خارج المدن الرئيسية)
            $table->string('zone')->nullable(); // مثال: "Riyadh", "Jeddah", "Remote"

            // الوزن (من - إلى)
            $table->integer('min_weight')->default(0); // بالجرام
            $table->integer('max_weight')->nullable(); // null يعني مفتوح

            // الأبعاد (اختياري)
            $table->integer('max_length')->nullable();
            $table->integer('max_width')->nullable();
            $table->integer('max_height')->nullable();

            // سعر الأساس
            $table->decimal('base_price', 10, 2)->default(0);

            // سعر لكل كيلوجرام إضافي بعد min_weight
            $table->decimal('price_per_kg', 10, 2)->default(0);

            // تكلفة إضافية للـ (express, same_day, oversized...)
            $table->decimal('extra_fee', 10, 2)->default(0);

            // الحالة
            $table->boolean('status')->default(true);

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
        Schema::dropIfExists('pricing_rules');
    }
};
