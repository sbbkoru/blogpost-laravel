<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
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
        /* $newUser = User::factory()->newUser()->create();
        $users = User::factory(5)->create();
        $users = $newUsers->concat([$newUser]);

        $posts = BlogPost::factory(30)->make()->each(function($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        }); */

        if($this->command->confirm('Do you want to add fake data in your database?', true)) {
            // $this->command->call('migrate:refresh')
             $this->command->info('Database has been renovated.');
        }

        $this->call([UsersTableSeeder::class, BlogPostsTableSeeder::class]);
    }
}
