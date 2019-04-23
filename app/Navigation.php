<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $table = "navigation";

    protected $casts = [
      "used" => "array",
      "available" => "array"
    ];

    public static function fetch () {
      if (!Navigation::get()->first()) {
        $nav = new Navigation;
        $nav->used = config('navigation.used_navigation');
        $nav->available = config('navigation.available_navigation');
        $nav->save();
        return $nav;
      } else {
        return Navigation::get()->first();
      }
    }
}
