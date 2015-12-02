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
        DB::table('bugs')->insert([
            'project_id' => rand(11,990),
            'titel' => str_random(10),
            'status' => 'open',
            'prioriteit' => 'laag',
            'soort' => 'seo',
            'naam_contactpersoon' => str_random(140),
            'naam_medewerker' => str_random(140),
            'behandeld_door' => str_random(140),
            'beschrijving' => str_random(140),
        ]);
    }
}
