<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
  protected $fillable = [
        'type', 'content', 'action_id'
    ];

  protected $actions = [
    0 => "Close Call",
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

  public function actionedBy(Action $action)
  {
    $user = User::where('id', '=', "{$action->user_id}")->first();
    if($user->department)
    {
      return $user->name.' ('.$user->department.')';
    }
    return $user->name;
  }
}
