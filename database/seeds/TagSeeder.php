<?php

use App\Post;
use Illuminate\Database\Seeder;
use App\Tag;
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
        DB::table('tags')->truncate(); // reset table

        $php = new Tag();
        $php->title = 'PHP';
        $php->slug = 'php';
        $php->save();

        $laravel = new Tag();
        $laravel->title = 'Laravel';
        $laravel->slug = 'laravel';
        $laravel->save();

        $js = new Tag();
        $js->title = 'JS';
        $js->slug = 'js';
        $js->save();

        $vue = new Tag();
        $vue->title = 'Vue';
        $vue->slug = 'vue';
        $vue->save();

        $tags = [
            $php->id,
            $laravel->id,
            $js->id,
            $vue->id
        ];

        foreach (Post::all() as $post) {
            shuffle($tags);
            for ($i = 0; $i < rand(0, count($tags) - 1); $i++) {
                $post->tags()->detach($tags[$i]);
                $post->tags()->attach($tags[$i]);
            }
        }
    }
}