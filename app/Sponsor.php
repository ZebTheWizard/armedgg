<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
  public $incrementing = false;
  use \App\Traits\Guid;

  protected $fillable = ["name", "about", "image", "url"];
}
