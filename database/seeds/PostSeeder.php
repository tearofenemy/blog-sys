<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset posts table
        DB::table('posts')->truncate();

        $posts = [];

        $faker = Faker\Factory::create();

        $date = Carbon::create(2019, 12, 25, 10);

        for ($i = 0; $i <= 20; $i++) {

            $img = "Post_Image_" . rand(1, 5) . ".jpg";
            $date->addDays(1);
            $publishedDate = clone ($date);
            //$createdDate = clone ($date);
            //$date = date("Y-m-d H:i:s", strtotime("2019-12-23 23:10 + {$i} days"));

            $posts[] = [
                'author_id' => rand(1, 3),
                'category_id' => rand(1, 5),
                'title' => $faker->title(),
                'slug' => $faker->slug(),
                'view_count' => rand(1, 15) * 10,
                'excerpt' => $faker->text(rand(10, 30)),
                'body' => $faker->paragraphs(rand(1, 3), true),
                'img' => rand(0, 1) == 1 ? $img : "no-image.png",
                'published_at' => $i < 5 ? $publishedDate : (rand(0, 1) == 0 ? NULL : $publishedDate)
            ];
        }

        DB::table('posts')->insert($posts);
    }
}