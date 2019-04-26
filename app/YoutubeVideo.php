<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
    public $incrementing = false;
    // use \App\Traits\Guid;

    protected $fillable = [
        'id', 'title', 'player_id', 'views', 'created_at', 'thumbnail'
    ];

    public function player() {
        return $this->belongsTo('App\Player');
    }
}
