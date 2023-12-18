<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('decentralization_id')->references('id')->on('decentralization')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('bill', function (Blueprint $table) {
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('billdetail', function (Blueprint $table) {
            $table->foreign('billid')->references('billid')->on('bill')->onDelete('cascade');
            $table->foreign('productid')->references('productid')->on('product')->onDelete('cascade');
            $table->primary('billdetail_id');
        });

        Schema::table('product', function (Blueprint $table) {
            $table->foreign('promotionid')->references('promotionid')->on('promotion')->onDelete('cascade');
        });

        Schema::table('default_pages', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('login_token', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Schema::table('pets', function (Blueprint $table) {
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // });

        Schema::table('user_service', function (Blueprint $table) {
            $table->foreign('serviceid')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('periodTime')->references('id')->on('timeworking')->onDelete('cascade');
            $table->primary(['serviceid', 'userid']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->foreign('teamid')->references('position_id')->on('staff_position')->onDelete('cascade');
        });

//        Schema::table('staff_teams', function(Blueprint $table) {
//            $table->foreign('teamid')->references('teamid')->on('expert_teams')->onDelete('cascade');
//            $table->foreign('staff_position_id')->references('staff_position_id')->on('staff_positions')->onDelete('cascade');
//            $table->primary(['teamid', 'staff_position_id']);
//        });

        Schema::table('expert_team', function (Blueprint $table) {
            $table->foreign('position_id')->references('position_id')->on('staff_position')->onDelete('cascade');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('blog_id')->references('id')->on('blog')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });

        Schema::table('blog', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');
        });

        Schema::table('cart', function (Blueprint $table) {
            $table->foreign('productid')->references('productid')->on('product')->onDelete('cascade');
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
    }
};
