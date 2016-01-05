<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('afzender_id');
            $table->integer('klant_id');
            $table->integer('medewerker_id');
            $table->integer('bug_id');
            $table->integer('project_id');
            $table->text('bericht');
            $table->boolean('last_admin');
            $table->boolean('last_client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chats');
    }
}
