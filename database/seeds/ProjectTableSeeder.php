<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $soort = array('seo','lay-out','performance','code');
        $prio = array('laag', 'gemiddeld', 'hoog', 'kritisch');
        $status = array('open','bezig','gesloten');
        $i = rand(0,3);
        $y = rand(0,3);
        $x = rand(0,2);

        DB::table('projecten')->insert([
            'titel' => str_random(10),
            'status' => $status[$x],
            'prioriteit' => $prio[$y],
            'soort' => $soort[$i],
            'projectnaam' => 'proj'. rand(1,99),
            'projecturl' => 'www.'. str_random(6). '.com',
            'gebruikersnaam' => str_random(10),
            'wachtwoord' => bcrypt('secret'),
            'omschrijvingproject' => str_random(140),
            'gebruiker_id' => rand(10,99),
        ]);
    }
}
