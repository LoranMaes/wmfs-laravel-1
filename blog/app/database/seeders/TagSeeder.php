<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scienceIds = DB::table('blogposts')->where('category_id', 1)->pluck('id')->all();
        $tagId = DB::table('tags')->insertGetId(['title' => 'astrophysics']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $scienceIds[0], 'tag_id' => $tagId], ['blogpost_id' => $scienceIds[1], 'tag_id' => $tagId]]);
        $tagId = DB::table('tags')->insertGetId(['title' => 'chemistry']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $scienceIds[3], 'tag_id' => $tagId], ['blogpost_id' => $scienceIds[1], 'tag_id' => $tagId]]);
        $tagId = DB::table('tags')->insertGetId(['title' => 'medicine']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $scienceIds[3], 'tag_id' => $tagId], ['blogpost_id' => $scienceIds[2], 'tag_id' => $tagId]]);

        $designIds = DB::table('blogposts')->where('category_id', 3)->pluck('id')->all();
        $tagId = DB::table('tags')->insertGetId(['title' => 'vintage']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $designIds[0], 'tag_id' => $tagId], ['blogpost_id' => $designIds[1], 'tag_id' => $tagId], ['blogpost_id' => $designIds[2], 'tag_id' => $tagId]]);
        $tagId = DB::table('tags')->insertGetId(['title' => 'fashion']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $designIds[3], 'tag_id' => $tagId], ['blogpost_id' => $designIds[0], 'tag_id' => $tagId], ['blogpost_id' => $designIds[1], 'tag_id' => $tagId]]);
        $tagId = DB::table('tags')->insertGetId(['title' => 'ikea']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $designIds[2], 'tag_id' => $tagId]]);

        $cultureIds = DB::table('blogposts')->where('category_id', 6)->pluck('id')->all();
        $tagId = DB::table('tags')->insertGetId(['title' => 'theatre']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $cultureIds[0], 'tag_id' => $tagId], ['blogpost_id' => $cultureIds[1], 'tag_id' => $tagId], ['blogpost_id' => $cultureIds[2], 'tag_id' => $tagId]]);
        $tagId = DB::table('tags')->insertGetId(['title' => 'movies']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $cultureIds[0], 'tag_id' => $tagId], ['blogpost_id' => $cultureIds[2], 'tag_id' => $tagId]]);

        $travelIds = DB::table('blogposts')->where('category_id', 7)->pluck('id')->all();
        $tagId = DB::table('tags')->insertGetId(['title' => 'south_america']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $travelIds[0], 'tag_id' => $tagId], ['blogpost_id' => $travelIds[3], 'tag_id' => $tagId], ['blogpost_id' => $travelIds[2], 'tag_id' => $tagId]]);
        $tagId = DB::table('tags')->insertGetId(['title' => 'europe']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $travelIds[1], 'tag_id' => $tagId]]);
        $tagId = DB::table('tags')->insertGetId(['title' => 'hotels']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $travelIds[0], 'tag_id' => $tagId], ['blogpost_id' => $travelIds[1], 'tag_id' => $tagId], ['blogpost_id' => $travelIds[2], 'tag_id' => $tagId]]);

        $webIds = DB::table('blogposts')->where('category_id', 10)->pluck('id')->all();
        $tagId = DB::table('tags')->insertGetId(['title' => 'laravel']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $webIds[0], 'tag_id' => $tagId], ['blogpost_id' => $webIds[3], 'tag_id' => $tagId], ['blogpost_id' => $webIds[2], 'tag_id' => $tagId]]);
        $tagId = DB::table('tags')->insertGetId(['title' => 'vue.js']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $webIds[5], 'tag_id' => $tagId], ['blogpost_id' => $webIds[3], 'tag_id' => $tagId], ['blogpost_id' => $webIds[4], 'tag_id' => $tagId]]);
        $tagId = DB::table('tags')->insertGetId(['title' => 'css']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $webIds[0], 'tag_id' => $tagId], ['blogpost_id' => $webIds[1], 'tag_id' => $tagId], ['blogpost_id' => $webIds[2], 'tag_id' => $tagId]]);
        $tagId = DB::table('tags')->insertGetId(['title' => 'svelte']);
        DB::table('blogpost_tag')->insert([['blogpost_id' => $webIds[5], 'tag_id' => $tagId], ['blogpost_id' => $webIds[1], 'tag_id' => $tagId], ['blogpost_id' => $webIds[4], 'tag_id' => $tagId]]);

    }
}
