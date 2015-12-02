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
        DB::table('projecten')->insert([
            'titel' => str_random(10),
            'status' => 'open',
            'prioriteit' => 'laag',
            'soort' => 'seo',
            'projectnaam' => 'proj'. rand(1,99),
            'projecturl' => 'www.'. str_random(6). '.com',
            'gebruikersnaam' => str_random(10),
            'wachtwoord' => bcrypt('secret'),
            'voornaam' => str_random(10),
            'achternaam' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'bedrijf' => str_random(10),
            'telefoonnummer' => rand(1111111111,9999999999),
            'omschrijvingproject' => str_random(140),
        ]);
    }
}
