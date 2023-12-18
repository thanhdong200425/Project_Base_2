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
        Schema::create('promotion', function (Blueprint $table) {
            $table->id('promotionid');
            $table->string('promotion_name')->nullable();
            $table->string('promotion_type')->nullable();
            $table->float('promotion_value')->nullable();
            $table->integer('promotion_status')->unsigned()->comment('0: inactive, 1: active');
            $table->dateTime('time_start')->nullable();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
