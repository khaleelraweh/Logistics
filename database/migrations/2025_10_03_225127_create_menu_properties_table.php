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
        Schema::create('menu_properties', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('menu_id'); // الوحدة التي تنتمي لها الخاصية
            $table->json('property_value'); // قيمة الخاصية (يمكن أن تكون متعددة اللغات)

            $table->boolean('status')->default(true);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->dateTime('published_on')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_properties');
    }
};
