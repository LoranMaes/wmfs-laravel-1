<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['title' => 'Science'],
            ['title' => 'Technology'],
            ['title' => 'Design'],
            ['title' => 'Politics'],
            ['title' => 'Business'],
            ['title' => 'Culture'],
            ['title' => 'Travel'],
            ['title' => 'Opinion'],
            ['title' => 'AI'],
            ['title' => 'Webtech'],
        ]);
    }
}
