<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  public function notification()
  {
    return $this->hasMany(Notification::class);
  }
}
