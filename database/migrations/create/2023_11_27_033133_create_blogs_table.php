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
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('blog_category_id')->unsigned()->nullable();
            $table->text('content')->nullable();
            $table->integer('view_count')->nullable();
            $table->integer('comment_count')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('descr')->nullable();
            $table->string('author')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
