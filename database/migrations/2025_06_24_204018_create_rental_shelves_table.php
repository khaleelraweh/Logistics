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
        Schema::create('rental_shelves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_rental_id')->constrained()->onDelete('cascade');
            $table->foreignId('shelf_id')->constrained()->onDelete('cascade');
            $table->decimal('custom_price', 10, 2)->nullable();
            $table->date('custom_start')->nullable();
            $table->date('custom_end')->nullable();
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
        Schema::dropIfExists('rental_shelves');
    }
};
