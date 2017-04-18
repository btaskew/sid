<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  public function message()
  {
    return $this->hasOne(Message::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function send(Call $call, Action $action)
  {
    $parameters = $this->setParameters($call, $action);

    $user = User::find($parameters["recipient"]);
    $user->sendNotification($parameters["message"], $call->id, $this);
  }

  public function store($message_id, $call_id, $user_id)
  {
    $this->message_id = $message_id;
    $this->call_id = $call_id;
    $this->user_id = $user_id;
    $this->save();
  }

  protected function setParameters(Call $call, Action $action)
  {
    $parameters = [
      "recipient" => null,
      "message" => null,
      "action" => $action->action_type,
    ];

    $callerAction = $action->isActionedByCaller($call->user_id);

    $parameters = $this->setRecipient($parameters, $callerAction, $call);
    $parameters["message"] = Message::setMessage($parameters["action"]);

    return $parameters;
  }

  protected function setRecipient($parameters, $callerAction, Call $call)
  {
    if ($callerAction)
    {
      $parameters["recipient"] = $call->assigned_id;
      $parameters["action"] .= " Staff";
      return $parameters;
    }
    $parameters["recipient"] = $call->user_id;
    return $parameters;
  }

}
