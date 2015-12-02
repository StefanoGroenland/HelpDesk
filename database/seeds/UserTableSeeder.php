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
            'achternaam' => str_random(10),
        ]);
    }
}
