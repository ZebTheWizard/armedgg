<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Streamer extends Model
{
  public $incrementing = false;
  use \App\Traits\Guid;

  protected $fillable = [
      'id', 'twitch', 'twitch_live', 'player_id', 'twitch_id', 'twitch_logo', 'twitch_display_name'
  ];

  public function player() {
    return $this->belongsTo('App\Player');
  }
}
