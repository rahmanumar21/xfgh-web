<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Comment;
use App\Models\Like;

class Post extends Model
{

    //User belongs
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Comments Has Many
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //Likes Has Many
    public function likes(){
        return $this->hasMany(Like::class);
    }




}
