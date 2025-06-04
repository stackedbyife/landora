<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Video;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Truncating tables
        Post::truncate();
        Video::truncate();
        Comment::truncate();

        // I am using this to call seeders
        $this->call([
            PostSeeder::class,
            VideoSeeder::class,
            CommentSeeder::class,
        ]);
    }
}