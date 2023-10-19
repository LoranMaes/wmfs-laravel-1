<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('authors')->insert([
            'first_name' => 'Bart',
            'last_name' => 'Delrue',
            'email' => 'bart.delrue@odisee.be',
            'website' => 'https://be.linkedin.com/in/bart-delrue-040672117',
            'location' => 'Gent, Belgium',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'email_verified_at' => null,
            'password' => Hash::make('Azerty123')
        ]);
        DB::table('authors')->insert([
            'first_name' => 'Joris',
            'last_name' => 'Maervoet',
            'email' => 'joris.maervoet@odisee.be',
            'website' => 'https://www.linkedin.com/in/jorismaervoet/',
            'location' => 'Kruibeke, Belgium',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'email_verified_at' => null,
            'password' => Hash::make('Azerty123')
        ]);
        DB::table('authors')->insert([
            'first_name' => 'Pieter',
            'last_name' => 'Van Peteghem',
            'email' => 'pieter.vanpeteghem@odisee.be',
            'website' => 'https://weareantenna.be/',
            'location' => 'Lochristi, Belgium',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'email_verified_at' => null,
            'password' => Hash::make('Azerty123')
        ]);
        DB::table('authors')->insert([
            'first_name' => 'Davy',
            'last_name' => 'De Winne',
            'email' => 'davy.dewinne@odisee.be',
            'website' => 'https://www.linkedin.com/in/davydewinne/',
            'location' => 'Schellebelle, Belgium',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'email_verified_at' => null,
            'password' => Hash::make('Azerty123')
        ]);

        $faker = FakerFactory::create();
        $faker->seed(222);
        for ($i = 0; $i < 6; $i++) {
            DB::table('authors')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'website' => $faker->url,
                'location' => $faker->city . ', ' . $faker->state,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'email_verified_at' => null,
                'password' => Hash::make('Azerty123')
            ]);
        }
    }
}
