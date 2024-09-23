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
        Schema::create('panel_settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_name');
            $table->string('photo');
            $table->string('phone_one');
            $table->string('phone_two');
            $table->string('email');
            $table->string('address');
            $table->string('cr_number');
            $table->string('intro');
            $table->string('tax_number');
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
        Schema::drop('panel_settings');
    }
};
