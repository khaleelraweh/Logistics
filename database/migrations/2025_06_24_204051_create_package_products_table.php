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
            // جدول المنتجات داخل الطرد
        Schema::create('package_products', function (Blueprint $table) {
            $table->id();

            // الطرد التابع له هذا المنتج
            $table->foreignId('package_id')->constrained()->onDelete('cascade');


            // نوع المنتج (اختياري)
            $table->enum('type', ['stock', 'custom'])->default('custom');

            // منتج من المخزون (اختياري)
            $table->foreignId('stock_item_id')->nullable()->constrained('stock_items')->nullOnDelete();

            // منتج مخصص (اختياري)
            $table->string('custom_name')->nullable();

            // البيانات المشتركة
            $table->integer('quantity');
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('price_per_unit', 10, 2)->nullable(); // السعر النهائي للوحدة
            $table->decimal('total_price', 10, 2)->nullable();    // quantity × price_per_unit

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
        Schema::dropIfExists('package_products');
    }
};
