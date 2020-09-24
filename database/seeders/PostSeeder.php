<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        Post::factory(50)->make()->each(function ($comment) use ($users) {
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
