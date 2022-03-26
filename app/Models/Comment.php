<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
        //User belongs
        public function user(){
            return $this->belongsTo(User::class);
        }

        //Post belongs
        public function post(){
            return $this->belongsTo(Post::class);
        }
}
