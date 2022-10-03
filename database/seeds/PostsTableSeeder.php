<?php

use App\Models\Admin\Category;
use App\Models\Admin\Post;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();
        $categories = Category::all();

        for ($i=0; $i < 100 ; $i++) { 
            
            $newPost = new Post();
            $newPost->user_id = $faker->randomElement($users)->id;
            $newPost->category_id = $faker->randomElement($categories)->id;
            $newPost->title = $faker->words(4, true);
            $newPost->content = $faker->paragraphs(2, true);
            $newPost->date = $faker->dateTime();
            $newPost->post_image = $faker->imageUrl();
            $newPost->save();
        }
    }
}