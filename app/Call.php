<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
  protected $fillable = [
        'title', 'description', 'level', 'staff_id'
    ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
