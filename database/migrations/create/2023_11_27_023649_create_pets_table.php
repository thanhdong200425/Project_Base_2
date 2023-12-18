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
            $table->id('id');
            $table->string('name')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('descr')->nullable();
            $table->bigInteger('pet_category_id')->unsigned()->nullable();
            $table->string('origin')->nullable();
            $table->string('other_name')->nullable();
            $table->string('classify')->nullable();
            $table->string('fur_style')->nullable();
            $table->string('fur_color')->nullable();
            $table->string('weight')->nullable();
            $table->string('longevity')->nullable();
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
