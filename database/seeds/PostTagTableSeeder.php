<?php

use App\Models\Admin\Post;
use App\Models\Admin\Tag;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        foreach($posts as $post) {
            $randomTags = Tag::inRandomOrder()->limit(2)->get();

            foreach($randomTags as $tag) {
                $post->tags()->attach($tag->id);
            }
        }
    }
}