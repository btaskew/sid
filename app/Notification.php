<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  protected $actionType;

  public function message()
  {
    return $this->hasOne(Message::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function notifyNewCall($message_id, $call_id, $user_id)
  {
    $this->message_id = $message_id;
    $this->call_id = $call_id;
    $this->user_id = $user_id;
    $this->save();
  }

  public function send(Call $call, Action $action)
  {
    $this->setParameters($call, $action);
    $this->save();
  }

  protected function setParameters(Call $call, Action $action)
  {
    $this->actionType = $action->action_type;
    $this->setRecipient($call, $action);
    $this->message_id = Message::setMessage($this->actionType);
    $this->call_id = $call->id;
  }

  protected function setRecipient(Call $call, Action $action)
  {
    if ($action->isActionedByCaller($call->user_id))
    {
      $this->user_id = $call->assigned_id;
      $this->actionType .= " Staff";
      return;
    }
    $this->user_id = $call->user_id;
    $call->setResponded();
  }

}
