<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('start_datum');
            $table->datetime('eind_datum');
            $table->string('titel');
            $table->string('prioriteit');
            $table->string('status');
            $table->string('soort');
            $table->text('beschrijving');
            $table->integer('klant_id');
            $table->integer('project_id');
            $table->integer('medewerker_id');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bugs');
    }
}
