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
        Schema::create('pricing_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('type', ['delivery', 'storage', 'handling'])->default('delivery');
            $table->string('zone')->nullable(); // المدينة أو المنطقة
            $table->integer('min_weight')->default(0); // بالجرام
            $table->integer('max_weight')->nullable(); // null يعني مفتوح
            $table->integer('max_length')->nullable();
            $table->integer('max_width')->nullable();
            $table->integer('max_height')->nullable();
            $table->decimal('base_price', 10, 2)->default(0);
            $table->decimal('price_per_kg', 10, 2)->default(0);
            $table->decimal('extra_fee', 10, 2)->default(0);
            $table->boolean('oversized')->default(false); // لمعالجة الطرود الضخمة
            $table->boolean('fragile')->default(false);
            $table->boolean('perishable')->default(false);
            $table->boolean('express')->default(false); // رسوم إضافية للشحن السريع
            $table->boolean('same_day')->default(false); // رسوم للتوصيل نفس اليوم
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
