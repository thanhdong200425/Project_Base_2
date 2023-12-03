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
        Schema::create('pets', function (Blueprint $table) {
            $table->id('pet_id');
            $table->string('name');
            $table->string('thumbnail');
            $table->text('description');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('pet_category_id')->unsigned()->nullable();
            $table->string('origin');
            $table->string('other_names');
            $table->string('classify');
            $table->string('fur_style');
            $table->string('fur_color');
            $table->string('weight');
            $table->string('longevity');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_pets');
    }
};
