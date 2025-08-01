<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('return_requests', function (Blueprint $table) {
            $table->id();

            // العلاقات الأساسية
            $table->foreignId('package_id')->constrained()->onDelete('cascade');

            // السائق المكلف (اختياري لأنه قد لا يعين مباشرة)
            $table->foreignId('driver_id')->nullable()->constrained()->onDelete('set null');

            // نوع الإرجاع: إلى مستودع أو إلى التاجر مباشرة
            $table->enum('return_type', ['to_warehouse', 'to_merchant','to_both'])->default('to_warehouse');

            // السبب
            $table->text('reason')->nullable();

            // الحالة
            $table->enum('status', ['requested', 'in_transit', 'received', 'rejected' , 'partially_received' , 'status_cancelled'])->default('requested');

            // وقت طلب الإرجاع والاستلام
            $table->dateTime('requested_at')->nullable();
            $table->dateTime('received_at')->nullable();

            // الهدف من الإرجاع
            // $table->foreignId('target_shelf_id')->nullable()->constrained('shelves')->nullOnDelete(); // رف مستهدف إذا الإرجاع للمستودع
            $table->string('target_address')->nullable(); // عنوان التاجر إذا الإرجاع إليه

            // إدارة التتبع والنشر
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
    public function down(): void
    {
        Schema::dropIfExists('return_requests');
    }
};
