<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Posts() {
        return $this->hasMany('App\Models\Post');
    }
}
// a categoria appartengono piu posts