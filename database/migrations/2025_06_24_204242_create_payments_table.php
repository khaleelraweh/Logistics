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
            $table->morphs('payable'); // هذا سينشئ payable_id و payable_type : دفع طرد ، ايجار ، خدمة
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade');
            $table->enum('method', ['cash', 'credit_card', 'bank_transfer', 'wallet', 'cod']);
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->dateTime('paid_on')->nullable();
            $table->enum('for', ['delivery', 'service_fee', 'storage', 'combined'])->default('delivery');
            $table->string('reference_note')->nullable();
            $table->string('payment_reference')->nullable(); // مرجع خارجي أو رقم العملية
            // $table->foreignId('invoice_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('set null'); // اذا كان الدفع عند الاستلام


            $table->boolean('status_visible')->default(true);
            $table->dateTime('published_on')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // إضافة فهرس على عمود merchant_id
        Schema::table('payments', function (Blueprint $table) {
            $table->index('merchant_id');
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
