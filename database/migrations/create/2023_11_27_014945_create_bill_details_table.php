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
        Schema::create('billdetail', function (Blueprint $table) {
            $table->bigInteger('billdetail_id')->unsigned()->nullable();
            $table->bigInteger('billid')->unsigned()->nullable();
            $table->bigInteger('productid')->unsigned()->nullable();
            $table->integer('quantity')->nullable();
            $table->float('price')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};
