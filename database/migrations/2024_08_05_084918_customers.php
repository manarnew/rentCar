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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('com_name');
            $table->string('identity_number');
            $table->string('identity_front_image')->nullable();
            $table->string('identity_back_image')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('address');
            $table->string('nationality');
            $table->string('driver_license_number');
            $table->string('driver_license_address');
            $table->date('driver_license_release_date');
            $table->date('driver_license_address_end_date');
            $table->string('driver_license_front_image')->nullable();
            $table->string('driver_license_back_image')->nullable();
            $table->string('details')->nullable();
            $table->integer('contract_number')->default(0);
            $table->decimal('total_money',10,2)->default(0);
            $table->decimal('paid_money',10,2)->default(0);
            $table->decimal('remaining_money',10,2)->default(0);
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
        Schema::drop('customers');
    }
};
