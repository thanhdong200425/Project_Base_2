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
        Schema::create('user_service', function (Blueprint $table) {
            $table->bigInteger('serviceid')->unsigned();
            $table->bigInteger('userid')->unsigned();
            $table->tinyInteger('status')->comment('0: Pending, 1: Accepted, 2: Rejected, 3: Completed')->default(0);
            $table->tinyInteger('payment_status')->nullable()->default(0)->comment('0: Not payment, 1: Paymented');
            $table->date('register_day')->nullable();
            $table->bigInteger('periodTime')->unsigned()->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_services');
    }
};
