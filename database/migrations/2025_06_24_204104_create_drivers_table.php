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

        // جدول السائقين
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('phone')->nullable();
            $table->string('driver_image')->nullable();


            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();

            $table->decimal('current_latitude', 10, 7)->nullable();
            $table->decimal('current_longitude', 10, 7)->nullable();

            $table->string('license_number')->nullable(); // رقم الترخيص
            $table->string('vehicle_type')->nullable();  // نوع السيارة
            $table->string('vehicle_number')->nullable(); // رقم اللوحة
            $table->string('vehicle_model')->nullable();  // موديل المركبة
            $table->string('vehicle_color')->nullable();  // لون المركبة

            $table->decimal('vehicle_capacity_weight', 8, 2)->nullable(); // الوزن الأقصى بالكيلو
            $table->decimal('vehicle_capacity_volume', 8, 2)->nullable(); // الحجم الأقصى بالمتر المكعب
            $table->string('vehicle_image')->nullable();


            $table->string('license_image')->nullable(); // صورة الرخصة
            $table->string('id_card_image')->nullable(); // صورة البطاقة الشخصية
            $table->date('license_expiry_date')->nullable(); // تاريخ انتهاء الرخصة

            $table->date('hired_date')->nullable();      // تاريخ التوظيف
            $table->string('supervisor_id')->nullable(); // المراقب المسؤول عنه

            $table->integer('total_deliveries')->default(0);   // عدد التوصيلات
            $table->float('rating')->default(0);

            $table->enum('availability_status', ['available', 'busy', 'offline'])->default('offline');
            $table->dateTime('last_seen_at')->nullable();


            $table->enum('status', ['active', 'inactive', 'suspended', 'terminated'])->default('active');
            $table->string('reason')->nullable();

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
        Schema::dropIfExists('drivers');
    }
};
