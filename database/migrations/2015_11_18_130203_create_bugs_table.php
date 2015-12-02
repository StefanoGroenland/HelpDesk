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
            $table->integer('project_id');
            $table->string('titel');
            $table->string('prioriteit');
            $table->string('status');
            $table->string('voornaam_contactpersoon');
            $table->string('achternaam_contactpersoon');
            $table->string('email_contactpersoon');
            $table->string('bedrijf_contactpersoon');
            $table->string('telefoon_contactpersoon');
            $table->string('naam_medewerker');
            $table->string('gebruikersnaam');
            $table->string('wachtwoord');
            $table->string('behandeld_door');
            $table->text('beschrijving');
            $table->string('soort');
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
