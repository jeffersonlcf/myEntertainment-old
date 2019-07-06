<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateURLsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('host');
            $table->string('path');
            $table->unsignedInteger('entertainment_id')->nullable();
            $table->foreign('entertainment_id')->references('id')->on('entertainments')->onDelete('cascade');
            $table->unsignedInteger('source_id')->nullable();
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade');
            $table->unsignedInteger('people_id')->nullable();
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');
            $table->unsignedInteger('episode_id')->nullable();
            $table->foreign('episode_id')->references('id')->on('episodes')->onDelete('cascade');
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
        Schema::dropIfExists('urls');
    }
}
