<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_writer = User::factory()->create(['email' => 'writer@zen-tech.com']);
        $user_editor = User::factory()->create(['email' => 'editor@zen-tech.com']);
        $user_admin = User::factory()->create(['email' => 'admin@zen-tech.com']);
        $user_super_admin = User::factory()->create(['email' => 'super.admin@zen-tech.com']);

        User::factory(30)->make()->each(function ($user) {
            $user->save();
        });
    }
}
