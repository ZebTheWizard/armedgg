<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Team;
use User;
use App\Category;

class Player extends Model
{
    // public $incrementing = false;
    // use \App\Traits\Guid;

    protected $fillable = [
       'name', 'avatar', 'category_id', 'country_flag', 'country_name', 'instagram', 'twitch', 'twitter', 'youtube'
    ];

    // public function user() {
    //   return $this->belongsTo(User::class);
    // }

    public function category() {
      return $this->belongsTo('App\Category');
    }

    public function streamer() {
      return $this->hasOne('App\Streamer');
    }
}
