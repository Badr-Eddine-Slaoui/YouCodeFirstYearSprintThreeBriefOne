<?php

namespace App\Models;

use Foundations\DB\GoldDigger\Model;

class Post extends Model{
    public function user(){
        return $this->belongsTo(User::class);
    }
}