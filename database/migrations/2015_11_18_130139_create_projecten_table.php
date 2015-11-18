<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projecten', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('projectnaam');
            $table->string('projecturl');
            $table->string('gebruikersnaam');
            $table->string('wachtwoord');
            $table->string('bedrijf');
            $table->text('omschrijvingproject');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projecten');
    }
}
