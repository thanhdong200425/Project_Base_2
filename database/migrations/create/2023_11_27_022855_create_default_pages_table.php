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
        Schema::create('default_pages', function (Blueprint $table) {
            $table->id('default_page_id');
            $table->string('title');
            $table->string('slug');
            $table->string('content');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_pages');
    }
};
