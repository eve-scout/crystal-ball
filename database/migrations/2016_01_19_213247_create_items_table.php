<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('itemID');
            $table->string('name');
            $table->string('description');
            $table->string('notes');
            $table->string('status');
            $table->timestamps();

            $table->integer('build_id')->unsigned();
            $table->foreign('build_id')->references('id')->on('builds');
            $table->integer('release_id')->unsigned();
            $table->foreign('release_id')->references('id')->on('releases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
