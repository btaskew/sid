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

  public function getActionTypeAttribute($action_type)
  {
    if(array_key_exists($action_type, $this->actions))
    {
      return $this->actions[$action_type];
    }
  }

  public function calls()
  {
    return $this->belongsTo(Call::class);
  }

  public function actionedBy()
  {
    $user = User::where('id', '=', "{$this->user_id}")->first();
    return $user->formatName($user);
  }

  public function caller()
  {
    $call = Call::find($this->call_id);
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
