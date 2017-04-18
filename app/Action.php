<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
  protected $fillable = [
        'type', 'content', 'action_type'
    ];

  protected $actions = [
    0 => "New Call",
    1 => "Update",
    2 => "Request for Information",
    3 => "Request Response",
    4 => "Close Call",
    5 => "Re-open Call"
  ];

  public function call()
  {
    return $this->belongsTo(Call::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function getActionTypeAttribute($action_type)
  {
    if(array_key_exists($action_type, $this->actions))
    {
      return $this->actions[$action_type];
    }
    throw new \Exception("Action does not exist");
  }

  public function actionedBy()
  {
    $user = $this->user()->first();
    if(!$user)
    {
      throw new \Exception("User not found");
    }
    return $user->formatName();
  }

  public function caller()
  {
    $call = $this->call()->first();
    if(!$call)
    {
      throw new \Exception("Call not found");
    }
    return $call->caller();
  }

  public function assignIds($call_id)
  {
    $this->call_id = $call_id;
    $this->user_id = currentUser()->id;
    return $this;
  }

  public function isActionedByCaller($callerId)
  {
    if ($callerId === $this->user_id)
    {
      return true;
    }
    return false;
  }
}
