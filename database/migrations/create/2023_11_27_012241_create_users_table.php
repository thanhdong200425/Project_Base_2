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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('thumbnail')->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->integer('phone')->nullable();
            $table->text('description')->nullable();
            $table->string('contact_facebook')->nullable();
            $table->string('contact_twitter')->nullable();
            $table->string('contact_linkedin')->nullable();
            $table->string('contact_pinterest')->nullable();
            $table->text('forget_token')->nullable();
            $table->text('active_token')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->bigInteger('decentralization_id')->unsigned()->nullable();
            $table->dateTime('last_active')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
