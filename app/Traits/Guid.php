<?php
namespace App\Traits;

use Sujip\Guid\Guid as Uid;

trait Guid
{
  protected static function boot() {
    parent::boot();

    static::creating(function ($model) {
      $guid = new Uid;
      $model->{$model->getKeyName()} = $guid->create();
      if (in_array('nonce', $model->fillable)) $model->nonce = str_random(11);
    });
  }
}
