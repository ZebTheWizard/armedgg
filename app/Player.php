<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Team;
use User;

class Player extends Model
{
    public $incrementing = false;
    use \App\Traits\Guid;

    protected $fillable = [
        'id', 'fname', 'lname', 'avatar'
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function streamer() {
      return $this->hasOne('App\Streamer');
    }
}
