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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('mname')->nullable()->change();
            $table->string('email');
            $table->integer('ygrad')->nullable()->change();
            $table->integer('ismis')->nullable()->change();
            $table->string('campus');
            $table->string('status');
            $table->string('request');
            $table->string('appdate');
            $table->string('tracking_code');
            $table->string('appstatus')->default('PENDING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
