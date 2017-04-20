<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $messages = [
    1 => "Update Staff",
    2 => "Update",
    3 => "Request for Information",
    4 => "Request Response Staff",
    5 => "Close Call Staff",
    6 => "Close Call",
    7 => "Re-open Call Staff",
    8 => "Re-open Call",
  ];

  public function notification()
  {
    return $this->hasMany(Notification::class);
  }

  public static function setMessage($actionType)
  {
    $setter = new static;
    $message = array_search($actionType, $setter->messages);
    if(!$message)
    {
      throw new \Exception("Message not found");
    }
    return $message;
  }

}
