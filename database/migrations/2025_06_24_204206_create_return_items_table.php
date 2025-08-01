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
        // جدول  تفاصيل العناصر المرتجعة
        Schema::create('return_items', function (Blueprint $table) {
            $table->id();
            // طلب المرتجع التابع له هذا العنصر
            $table->foreignId('return_request_id')->constrained()->onDelete('cascade');

            // نوع المنتج المرتجع: stock أو custom
            $table->enum('type', ['stock', 'custom'])->default('custom');

            // إذا كان stock → نملأ stock_item_id
            $table->foreignId('stock_item_id')->nullable()->constrained('stock_items')->nullOnDelete();

            // إذا كان custom → نملأ custom_name
            $table->string('custom_name')->nullable();

            // الرف الذي تم تخزين المرتجع فيه (اختياري)
            $table->foreignId('shelf_id')->nullable()->constrained('shelves')->nullOnDelete();

            $table->integer('quantity')->default(0);

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
        Schema::dropIfExists('return_items');
    }
};
