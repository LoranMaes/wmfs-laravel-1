<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        $faker->seed(999);
        $blogposts = DB::table('blogposts')->get();
        foreach ($blogposts as $blogpost) {
            $amount = $faker->numberBetween(0, 6);
            for ($i = 0; $i < $amount; $i++) {
                DB::table('comments')->insert([
                    'content' => $faker->realText(100, 3),
                    'author_id' => $faker->numberBetween(1, 10),
                    'blogpost_id' => $blogpost->id,
                    'created_at' => $faker->dateTimeBetween($blogpost->created_at, 'now')->format('Y-m-d H:i:s'),
                    'updated_at' => null
                ]);
            }
        }
    }
}
