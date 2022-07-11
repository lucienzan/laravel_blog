<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function post(){
        return $this->hasOne(Post::class); //Category to post
    }

    public function posts(){
        return $this->hasMany(Post::class); //Category to post
    }

    public function User(){
        return $this->belongsTo(User::class); //category to user
    }

}
