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
        Schema::create('debentures', function (Blueprint $table) {
            $table->id();
            $table->integer('car_id');
            $table->integer('customer_id');
            $table->integer('contract_id');
            $table->decimal('remind_price')->nullable();
            $table->decimal('paid_price')->nullable();
            $table->string('payment_type');
            $table->string('check_number')->nullable();;
            $table->string('note')->nullable();;
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
        Schema::drop('debentures');
    }
};
