<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(App\User::class, 3)->create();
        
        factory(App\Post::class, 10)->create()->each(
            function ($post){
                
                $number_comments = rand(1,6);

                for ($i=0; $i < $number_comments; $i++) { 
                    $post->comments()->save(factory(App\Comment::class)->make());
                }

            }
        );
    }
}
