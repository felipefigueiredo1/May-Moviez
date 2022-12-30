<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comment_likes', function (Blueprint $table) {
            $table->dropForeign('comment_likes_comment_id_foreign');
            $table->dropForeign('comment_likes_user_id_foreign');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade')->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments_likes', function (Blueprint $table) {
            //
        });
    }
};
