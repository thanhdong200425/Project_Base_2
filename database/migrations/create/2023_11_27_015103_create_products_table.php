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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name');
            $table->string('slug')->nullable();
            $table->float('price');
            $table->integer('quantity')->unsigned();
            $table->string('thumbnail2');
            $table->bigInteger('promotion_id')->unsigned()->nullable();
            $table->string('dimension');
            $table->string('color');
            $table->integer('evaluate_star');
            $table->integer('evaluate_count');
            $table->text('description');
            $table->integer('status')->unsigned()->comment('0: inactive, 1: active');
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
