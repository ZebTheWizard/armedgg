<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;
use Invite;

class Team extends Model
{
  public $incrementing = false;
  use \App\Traits\Guid;

  protected $fillable = [
      'id', 'name', 'logo', 'color', 'overview'
  ];

  public function users() {
    return $this->belongsToMany('App\User', 'team_user')->withPivot('isMod');
  }

  public function invites() {
    return $this->hasMany(Invite::class);
  }
}
