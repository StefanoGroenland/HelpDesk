<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gebruikers')->insert([
            'username' => 'stefano',
            'password' => Hash::make('moodles'),
            'email' => 'stefano@moodles.nl',
            'bedrijf' => 'moodles',
            'voornaam' => 'stefano',
            'tussenvoegsel' => '',
            'achternaam' => 'groenland',
            'geslacht' => 'man',
            'profielfoto' => '',
            'telefoonnummer' => '0628909213',
        ]);
    }
}
