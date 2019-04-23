<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Player;
use Illuminate\Database\Eloquent\Collection;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ["name"];

    protected $parents = [];

    public function players() {
      return $this->hasMany('App\Player');
    }

    public function root(&$arr=[]){
      if ($this->parent){
          array_push($arr, $this->parent);
          return $this->parent->root($arr);
      } else {
          return $this;
      }
    }


    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function parents() {
        $this->parents = [];
        $this->root($this->parents);
        return $this->parents;
    }

    public function hasAncestor($name) {
      $this->parents = [];
      $this->root($this->parents);
      return collect($this->parents)->contains('name', $name);
    }

    public function children() {
        return $this->hasMany(self::class, 'parent_id','id');
    }

}
