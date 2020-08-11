<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainCommentsLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_comments_likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('comment_id');
            $table->integer('user_id');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domain_comments_likes');
    }
}