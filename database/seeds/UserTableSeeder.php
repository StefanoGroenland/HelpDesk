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
            'username' => str_random(10),
            'password' => bcrypt('secret'),
            'klantnummer' => rand(1111,9999),
            'email' => str_random(10).'@gmail.com',
            'bedrijf' => str_random(10),
            'voornaam' => str_random(10),
            'tussenvoegsel' => str_random(10),
            'achternaam' => str_random(10),
            'geslacht' => str_random(4),
            'profielfoto' => str_random(4),
            'telefoonnummer' => rand(1111111111,9999999999),

        ]);
    }
}
