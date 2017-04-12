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

  public static function send(Call $call, Action $action)
  {
    $notification = new static;
    $parameters = $notification->setParameters($call, $action);

    $user = User::find($parameters["recipient"]);
    $user->sendNotification($parameters["message"]);
  }

  public function store($message_id, $user_id)
  {
    $this->message_id = $message_id;
    $this->user_id = $user_id;
    $this->save();
  }

  protected function setParameters(Call $call, Action $action)
  {
    $parameters = [
      "recipient" => null,
      "message" => null,
    ];

    $actionedByCaller = $action->isActionedByCaller($call->user_id);

    switch ($action->action_type) {
      case "Update":
        if($actionedByCaller)
        {
          $parameters["recipient"] = $call->assigned_id;
          $parameters["message"] = 1;
          continue;
        }
        $parameters["recipient"] = $call->user_id;
        $parameters["message"] = 2;
        break;
      case "Request for Information":
        $parameters["recipient"] = $call->user_id;
        $parameters["message"] = 3;
        break;
      case "Request Response":
        $parameters["recipient"] = $call->assigned_id;
        $parameters["message"] = 4;
        break;
      case "Close Call":
        if($actionedByCaller)
        {
          $parameters["recipient"] = $call->assigned_id;
          $parameters["message"] = 5;
          continue;
        }
        $parameters["recipient"] = $call->user_id;
        $parameters["message"] = 6;
        break;
      case "Re-open Call":
        if($actionedByCaller)
        {
          $parameters["recipient"] = $call->assigned_id;
          $parameters["message"] = 7;
          continue;
        }
        $parameters["recipient"] = $call->user_id;
        $parameters["message"] = 8;
        break;
      default:
        throw new Exception("Action type invalid", 1);
      break;
    }

    return $parameters;
  }

}
