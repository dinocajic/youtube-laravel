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
        Schema::create('personal_cars', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->foreignId('personal_car_brand_id');
            $table->foreignId('personal_car_model_id');
            $table->boolean('is_manual')->default(true);
            $table->string('exterior_color');
            $table->unsignedInteger('purchase_amount');
            $table->unsignedInteger('current_value');
            $table->unsignedInteger('sales_amount');
            $table->date('date_purchased');
            $table->date('date_sold')->nullable()->default(null);
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
        Schema::dropIfExists('personal_cars');
    }
};
