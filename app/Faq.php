<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public $incrementing = false;
    use \App\Traits\Guid;

    protected $fillable = ["question", "answer", "rank"];
}
