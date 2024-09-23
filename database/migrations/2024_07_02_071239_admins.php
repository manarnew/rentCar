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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->integer('com_code');
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('permission_roles_id')->default(1);
            $table->tinyInteger('active');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('admins');
    }
};
