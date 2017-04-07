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

  public function store($message_id, $user_id)
  {
    $this->message_id = $message_id;
    $this->user_id = $user_id;
    $this->save();
  }
}
