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
        Schema::create('product', function (Blueprint $table) {
            $table->id('productid');
            $table->string('product_name')->nullable();
            $table->string('slug')->nullable();
            $table->float('price')->nullable();
            $table->integer('quantity')->unsigned();
            $table->string('thumbnail2')->nullable();
            $table->bigInteger('promotionid')->unsigned()->nullable();
            $table->string('dimensions')->nullable();
            $table->string('color')->nullable();
            $table->integer('evaluate_star')->nullable();
            $table->integer('evaluate_quantity')->nullable();
            $table->text('description')->nullable();
            $table->integer('product_status')->unsigned()->comment('0: inactive, 1: active')->nullable();
            $table->text('ingredient')->nullable();
            $table->string('origin')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
