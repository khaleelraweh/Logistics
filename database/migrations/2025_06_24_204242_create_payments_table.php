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
         // جدول المدفوعات
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade');
            $table->json('method');
            $table->decimal('amount', 10, 2);// المبلغ الكامل المدفوع
            $table->json('currency')->default('USD');
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->date('paid_on')->nullable();
            $table->enum('for', ['delivery', 'service_fee', 'storage', 'combined'])->default('delivery');
            $table->string('reference_note')->nullable(); // ملاحظات اضافية


            $table->boolean('status_visible')->default(true);
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
        Schema::dropIfExists('payments');
    }
};
