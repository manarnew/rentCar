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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->integer('car_id');
            $table->integer('customer_id');
            $table->tinyInteger('contract_type');
            $table->tinyInteger('contract_number');
            $table->decimal('contract_price');
            $table->tinyInteger('contract_status');
            $table->string('payment_type');
            $table->decimal('pre_paid_price')->nullable();
            $table->decimal('paid_price')->nullable();
            $table->decimal('tax_price')->nullable();
            $table->decimal('total_price')->nullable();
            $table->decimal('excess_km_price')->nullable();
            $table->decimal('remind_price')->nullable();
            $table->decimal('penalty_price')->nullable();
            $table->decimal('patrol_price')->nullable();
            $table->decimal('washing_price')->nullable();
            $table->decimal('insurance_price')->nullable();
            $table->date('exist_date');
            $table->time('exist_time');
            $table->date('return_date');
            $table->time('return_time');
            $table->decimal('exist_km');
            $table->decimal('return_km')->nullable();
            $table->decimal('due_km')->nullable();
            $table->decimal('free_km')->nullable();
            $table->decimal('total_km')->nullable();
            $table->decimal('excess_km')->nullable();
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
        Schema::drop('contracts');
    }
};
