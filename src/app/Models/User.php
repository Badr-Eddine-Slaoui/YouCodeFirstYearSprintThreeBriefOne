<?php

namespace App\Models;

use Foundations\DB\GoldDigger\Model;

class User extends Model{
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}