<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntertainmentUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entertainment_user', function (Blueprint $table) {
            $table->unsignedInteger('entertainment_id');
            $table->foreign('entertainment_id')->references('id')->on('entertainments')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['entertainment_id', 'user_id']);
            $table->tinyInteger('rating')->nullable();
            $table->timestamp('favourite')->nullable();
            $table->timestamp('seen')->nullable();
            $table->timestamp('tbseen')->nullable();
            $table->timestamp('ntbseen')->nullable();
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
        Schema::dropIfExists('entertainment_user');
    }
}
