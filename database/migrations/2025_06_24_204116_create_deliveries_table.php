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
        // جدول التوصيلات
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->dateTime('delivered_at')->nullable();
            $table->dateTime('assigned_at')->nullable();
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
            ])->default('pending');
            $table->string('note')->nullable(); // show notes

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
        Schema::dropIfExists('deliveries');
    }
};
