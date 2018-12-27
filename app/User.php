<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Player;
use Team;
use DB;

class User extends Authenticatable
{
    public $incrementing = false;
    use \App\Traits\Guid;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email', 'password', 'isAdmin', 'isMod'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function player() {
      return $this->hasOne(Player::class);
    }

    public function teams() {
      return $this->belongsToMany('App\Team', 'team_user')
                  ->withPivot('isMod')
                  ->selectRaw('? as can_delete', [$this->isAdmin])
                  ->addSelect('teams.*');
    }

    public function runsTeam(Team $team) {
      return $this->teams()
        ->where('teams.id', $team->id)
        ->wherePivot('isMod', true)
        ->exists();
    }
}
