<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Team;

class Invitation extends Model
{
    public $incrementing = false;
    use \App\Traits\Guid;

    protected $fillable = ['id', 'nonce', 'team_id'];

    public function team()
    {
      return $this->belongsTo(Team::class);
    }
}
