<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Video;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //comments to posts
        Post::all()->each(function ($post) {
            Comment::factory()->count(3)->create([
                'commentable_id' => $post->id,
                'commentable_type' => Post::class,
            ]);
        });

        //comments to videos
        Video::all()->each(function ($video) {
            Comment::factory()->count(3)->create([
                'commentable_id' => $video->id,
                'commentable_type' => Video::class,
            ]);
        });
    }
}
