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
        Schema::create('bill', function (Blueprint $table) {
            $table->id('billid');
            $table->bigInteger('userid')->unsigned()->nullable();
            $table->string('payment_method');
            $table->float('total_price');
            $table->integer('status')->default(0)->comment('0: Not pay, 1: Paid, 2: Cancel');
            $table->integer('payment_status')->nullable()->default(0);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
