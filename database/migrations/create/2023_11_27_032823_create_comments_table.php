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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('content')->nullable();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('blog_id')->unsigned()->nullable();
            $table->tinyInteger('status')->comment('0: Pending, 1: Approved, 2: Spam');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
