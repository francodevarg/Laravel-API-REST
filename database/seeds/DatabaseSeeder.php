<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $counterAvatar = 1;
    protected $counterPost = 1;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(App\User::class, 6)->create()->each(
            function ($user){
                $user->image()->save(factory(App\Image::class)->make([
                    'url' => $this->userImage($this->counterAvatar)
                ]));
                $user->followers()->attach($this->isNotSelf($user->id));
            }
        );
        
        factory(App\Post::class, 10)->create()->each(
            function ($post){

                $post->image()->save(factory(App\Image::class)->make([
                    'url' => $this->postImage($this->counterPost),
                ]));
                $number_comments = rand(1,6);

                for ($i=0; $i < $number_comments; $i++) { 
                    $post->comments()->save(factory(App\Comment::class)->make());
                }

            }
        );
    }
    public function postImage($max)
    {
        $url = array(1=>'https://images.unsplash.com/photo-1612611820416-38d7ebaad38f?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&ixlib=rb-1.2.1&q=80&w=400', 
        2=>'https://images.unsplash.com/photo-1613256253373-352901921b9c?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&ixlib=rb-1.2.1&q=80&w=400', 
        3=>'https://images.unsplash.com/photo-1612293105714-bc8b720da59e?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&ixlib=rb-1.2.1&q=80&w=400',
        4=> 'https://images.unsplash.com/photo-1613929905267-bc82260eb660?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&ixlib=rb-1.2.1&q=80&w=400',
        5=> 'https://images.unsplash.com/photo-1612583386053-87b6261ff7b0?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&ixlib=rb-1.2.1&q=80&w=400',
        6=> 'https://images.unsplash.com/photo-1612815160130-ff641f5bf967?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&ixlib=rb-1.2.1&q=80&w=400',
        7=>'https://images.unsplash.com/photo-1613375772563-af532af5cef9?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&ixlib=rb-1.2.1&q=80&w=400',
        8=>'https://images.unsplash.com/photo-1612294590672-fa8da573f09c?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&ixlib=rb-1.2.1&q=80&w=400',
        9=>'https://images.unsplash.com/photo-1612207149044-231306f00e17?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&ixlib=rb-1.2.1&q=80&w=400',
        10=>'https://images.unsplash.com/photo-1612557671631-e0f246bba8f5?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&ixlib=rb-1.2.1&q=80&w=400');
        $this->counterPost++;
        return $url[$max];
    }

    public function userImage($max){
        $url = array(
            1=>'https://i.pravatar.cc/300?img=12',
            2=>'https://i.pravatar.cc/300?img=47',
            3=>'https://i.pravatar.cc/300?img=32',
            4=>'https://i.pravatar.cc/300?img=36',
            5=>'https://i.pravatar.cc/300?img=30',
            6=>'https://i.pravatar.cc/300?img=25'
        );
        $this->counterAvatar++;
        return $url[$max];
    }

    public function isNotSelf($id){
        $randNumber = rand(1,6);
        while($id == $randNumber){
            $randNumber = rand(1,6); 
        }
        return $randNumber;
    }
}
