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
        Schema::create('car_expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('car_id');
            $table->integer('type_id');
            $table->string('supplier');
            $table->string('image')->nullable();
            $table->decimal('price');
            $table->decimal('tax')->nullable();
            $table->decimal('total_price_tax');
            $table->string('note')->nullable();
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
        Schema::drop('car_expenses');
    }
};
