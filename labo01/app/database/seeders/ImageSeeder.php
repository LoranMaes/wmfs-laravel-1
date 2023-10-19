<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // This is the concert id as value linked with path as key
        $paths = [
            'rally1.jpg' => 2,
            'rally2.jpg' => 2,
            'tomorrow1.jpg' => 1,
            'tomorrow2.jpg' => 1
        ];

        foreach ($paths as $path => $concert_id){
            DB::table('images')->insert([
                'id' => null,
                'path' => 'images/' . $path,
                'concert_id' => $concert_id,
                'created_at' => (Carbon::now())->format('Y-m-d H:i:s'),
                'updated_at' => (Carbon::now())->format('Y-m-d H:i:s')
            ]);
        }
    }
}
