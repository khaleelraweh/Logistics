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
          // سجل تتبع الطرود
        Schema::create('package_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
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
            ]);

            // ملاحظات إضافية
            $table->text('note')->nullable();

            // المستخدم الذي غيّر الحالة (اختياري)
            $table->string('changed_by')->nullable();

            // السائق الذي كان مسؤولًا وقت التغيير (اختياري)
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->nullOnDelete();

            // وقت تسجيل الحالة
            $table->timestamp('logged_at')->useCurrent();

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
        Schema::dropIfExists('package_logs');
    }
};
