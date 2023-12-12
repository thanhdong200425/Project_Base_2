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
            $table->foreign('decentralization_id')->references('decentralization_id')->on('decentralizations')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('bills', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('bill_details', function (Blueprint $table) {
            $table->foreign('bill_id')->references('bill_id')->on('bills')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->primary('billdetail_id');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('promotion_id')->references('promotion_id')->on('promotions')->onDelete('cascade');
        });

        Schema::table('default_pages', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('login_tokens', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('pets', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('user_services', function (Blueprint $table) {
            $table->foreign('service_id')->references('service_id')->on('services')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('period_time_id')->references('timeworking_id')->on('timeworkings')->onDelete('cascade');
            $table->primary(['service_id', 'user_id']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->foreign('teamid')->references('positionid')->on('staff_positions')->onDelete('cascade');
        });

//        Schema::table('staff_teams', function(Blueprint $table) {
//            $table->foreign('teamid')->references('teamid')->on('expert_teams')->onDelete('cascade');
//            $table->foreign('staff_position_id')->references('staff_position_id')->on('staff_positions')->onDelete('cascade');
//            $table->primary(['teamid', 'staff_position_id']);
//        });

        Schema::table('expert_teams', function (Blueprint $table) {
            $table->foreign('positionid')->references('positionid')->on('staff_positions')->onDelete('cascade');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('blog_id')->references('blog_id')->on('blogs')->onDelete('cascade');
            $table->foreign('parent_id')->references('comment_id')->on('comments')->onDelete('cascade');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('blog_categories')->onDelete('cascade');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
