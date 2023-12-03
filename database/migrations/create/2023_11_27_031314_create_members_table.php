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
        Schema::create('members', function (Blueprint $table) {
            $table->id('member_id');
            $table->bigInteger('position_id')->unsigned()->nullable();
            $table->string('name');
            $table->tinyInteger('gender')->comment('0: Man, 1: Woman');
            $table->date('dob');
            $table->integer('phone');
            $table->string('email');
            $table->string('avatar');
            $table->text('description');
            $table->string('pinterest');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('tiktok');
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
