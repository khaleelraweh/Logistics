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
        Schema::create('invoices', function (Blueprint $table) {
             $table->id();
            $table->string('invoice_number')->unique(); // رقم الفاتورة
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade'); // التاجر
            $table->morphs('payable'); // Polymorphic (ربط بطرد أو إيجار)
            $table->decimal('total_amount', 10, 2); // المبلغ الإجمالي
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->string('currency', 10)->default('USD'); // العملة
            $table->enum('status', ['unpaid', 'paid', 'partial'])->default('unpaid'); // حالة الفاتورة
            $table->date('due_date')->nullable(); // تاريخ الاستحقاق
            $table->timestamp('issued_at')->useCurrent(); // تاريخ الإصدار
            $table->text('notes')->nullable(); // ملاحظات إضافية
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
        Schema::dropIfExists('invoices');
    }
};
