<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //A video can have many comments
    use HasFactory;
        public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
        
}
