<?php

use Illuminate\Database\Seeder;

class BugTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prio = array('laag', 'gemiddeld', 'hoog' , 'kritisch');
        $status = array('open', 'gesloten');
        $soort = array('lay-out','seo','performance', 'code');
        $i = rand(0,3);
        $x = rand(0,3);
        $y = rand(0,1);
        DB::table('bugs')->insert([
            'project_id' => rand(11,990),
            'titel' => str_random(10),
            'status' => $status[$y],
            'prioriteit' => $prio[$x],
            'soort' => $soort[$i],
            'beschrijving' => str_random(140),
            'klant_id' => rand(10,99),
            'project_id' => rand(10,99),
            'medewerker_id' => rand(10,99),
        ]);

    }
}
