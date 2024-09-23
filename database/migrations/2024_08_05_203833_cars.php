<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number');
            $table->string('car_color');
            $table->string('image')->nullable();
            $table->integer('type_id');
            $table->tinyInteger('car_status')->default(1);//available 1 and 0 not available
            $table->integer('car_modals_id');
            $table->tinyInteger('full_insurance');
            $table->tinyInteger('third_party');
            $table->tinyInteger('full_cover');
            $table->tinyInteger('UAE');
            $table->tinyInteger('oman');
            $table->decimal('km_number',10,2);
            $table->decimal('daily_rent_price',10,2);
            $table->decimal('hourly_rent_price',10,2);
            $table->decimal('weekly_rent_price',10,2);
            $table->decimal('monthly_rent_price',10,2);
            $table->decimal('km_rent_price',10,2);
            $table->integer('contract_number')->default(0);
            $table->integer('com_code');
            $table->date('date');
            $table->integer('added_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('cars');
    }
};
