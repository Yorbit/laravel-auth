<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Post extends Model

{
    public function user() {
        return $this->belongsTo("App\User");
    }

    public function category() {
        return $this->belongsTo("App\Models\Admin\Category");
    }
}