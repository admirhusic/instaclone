<?php

use App\Post;
use App\PostFactory;
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
        PostFactory::factory()->count(50)->create();
    }
}
