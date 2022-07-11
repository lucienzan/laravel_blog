<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function Category(){
        return $this->belongsTo(Category::class); //post to category
    }

    public function User(){
        return $this->belongsTo(User::class); //post to user
    }
}
