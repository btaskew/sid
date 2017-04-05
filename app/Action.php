<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
  protected $fillable = [
        'type', 'content'
    ];

  protected $actions = [
    0 => "Closed",
    1 => "Update",
    2 => "Request for Information",
    3 => "Request Response"
  ];

  public function getActionIdAttribute($action_id)
  {
    if(array_key_exists($action_id, $this->actions))
    {
      return $this->actions[$action_id];
    }
  }

  public function calls()
  {
    return $this->belongsTo(Call::class);
  }
}
