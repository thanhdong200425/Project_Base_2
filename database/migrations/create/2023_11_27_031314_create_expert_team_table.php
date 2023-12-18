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
        Schema::create('expert_team', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('position_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->tinyInteger('gender')->comment('0: Man, 1: Woman')->nullable();
            $table->date('dob');
            $table->integer('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('experience')->default(1);
            $table->text('about')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('tiktok')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expert_teams');
    }
};
