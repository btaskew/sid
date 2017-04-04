<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
  public function calls()
  {
    return $this->belongsTo(Call::class);
  }
}
