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

              // Translatable fields
            $table->json('name'); // Example: {"ar": "تسعيرة التوصيل", "en": "Delivery Pricing"}
            $table->json('description')->nullable();

            // Type of pricing rule
            $table->enum('type', ['delivery', 'storage', 'handling'])->default('delivery');

            // Condition (e.g., {"weight": {"from": 0, "to": 4}, "zone": "A"})
            $table->json('condition');

            // Numeric fields
            $table->decimal('base_price', 10, 2)->default(0);
            $table->decimal('price_per_kg', 10, 2)->default(0);

            $table->boolean('status')->default(true);

            $table->dateTime('published_on')->nullable();
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
        Schema::dropIfExists('pricing_rules');
    }
};
