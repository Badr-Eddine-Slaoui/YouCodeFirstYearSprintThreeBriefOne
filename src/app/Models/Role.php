<?php

namespace App\Models;

use Foundations\DB\GoldDigger\Model;

class Role extends Model{
    public function users(){
        return $this->belongsToMany(User::class);
    }
}