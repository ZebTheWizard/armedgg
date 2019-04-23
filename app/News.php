<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        "title", "text", "image", "user_id", "slug"
    ];

    public function author() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
