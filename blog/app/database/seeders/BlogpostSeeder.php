<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogpostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        $faker->seed(668);
        for ($i = 0; $i < 50; $i++) {
            DB::table('blogposts')->insert([
                'title' => Str::substr($faker->realText(25, 5), 0, -1),
                'content' => $faker->realText(200, 3),
                'image' => $this->downloadPicsumFile($faker->numberBetween(1, 100000)),
                'featured' => false,
                'author_id' => $faker->numberBetween(1, 10),
                'category_id' => $faker->numberBetween(1, 10),
                'created_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'updated_at' => null
            ]);
        }
        DB::table('blogposts')->whereIn('id', $faker->randomElements(range(1,50),5))
            ->update(['featured' => true]);
    }

    private function downloadPicsumFile(int $seed) : string {
        $url = 'https://picsum.photos/seed/' . $seed . '/800/600';
        $fileName = md5($seed) . '.jpg';
        $fp = fopen('storage/app/public/' . $fileName, 'w');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64; rv:104.0) Gecko/20100101 Firefox/104.0');
        $success = curl_exec($ch) && (curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200);
        fclose($fp);
        curl_close($ch);
        if (! $success) {
            unlink('storage/app/public/' . $fileName);
            echo 'WARNING: image could not be downloaded !!! URL: ' . $url . PHP_EOL;
            echo 'HTTP-CODE: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE) . PHP_EOL;
            return '';
        } else {
            echo 'D';
            return $fileName;
        }
    }
}
