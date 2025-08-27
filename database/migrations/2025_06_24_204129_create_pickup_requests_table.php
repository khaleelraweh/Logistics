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

        // جدول طلبات الاستلام من المتاجر
        Schema::create('pickup_requests', function (Blueprint $table) {
            $table->id();

            // التاجر صاحب الطلب
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade');

            // السائق المكلف (اختياري لأنه قد لا يعين مباشرة)
            $table->foreignId('driver_id')->nullable()->constrained()->onDelete('set null');


            // العنوان الهدف
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('postal_code')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();  // خط العرض
            $table->decimal('longitude', 10, 7)->nullable();

            // الوقت المجدول للاستلام من التاجر
            $table->dateTime('scheduled_at')->nullable();

            // حالة الطلب: pending, accepted, completed
            $table->enum('status', ['pending', 'accepted', 'completed'])->default('pending');

            // لجعل الحالة مرئية للنظام أو إخفاؤها (في حالة الحذف اللين مثلاً)
            $table->boolean('status_visible')->default(true);

            $table->string('note')->nullable(); // show notes


            // تاريخ النشر أو تفعيل الطلب (اختياري)
            $table->dateTime('published_on')->nullable();

            // يمكن استخدام user ids أو أسماء من قام بالإنشاء/التعديل/الحذف
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
        Schema::dropIfExists('pickup_requests');
    }
};
