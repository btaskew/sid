<?php

namespace App;

use App\helpers\CallFetcher;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  protected $fillable = [
        'name', 'email', 'password', 'role_id', 'department'
    ];

    public function role()
    {
      return $this->belongsTo(Role::class);
    }

    public function calls()
    {
      return $this->hasMany(Call::class);
    }

    public function actions()
    {
      return $this->hasMany(Action::class);
    }

    public function notifications()
    {
      return $this->hasMany(Notification::class);
    }

    public function getCalls($category)
    {
      $callFetcher = new CallFetcher($this);
      if(method_exists($callFetcher, $category))
      {
        return $callFetcher->$category();
      }
      throw new \Exception("Call cetegory does not exist");
    }

    public static function staff()
    {
      return User::where('role_id', 1)
        ->orderBy('department')
        ->get();
    }

    public function log(Call $call)
    {
      $this->calls()->save($call);
      (new Notification)->notifyNewCall(0, $call->id, $call->assigned_id);
    }

    public function formatName()
    {
      if($this->department)
      {
        return $this->name.' ('.$this->department.')';
      }
      return $this->name;
    }

    public function getNotifications()
    {
      $collection = [];
      $notifications = $this->notifications()->get();
      foreach ($notifications as $notification)
      {
        $message = Message::find($notification->message_id);
        $collection[$notification->id] = array(
          'call_id' => $notification->call_id,
          'title' => $message->title,
          'message' => $message->message
        );
      }
      return $collection;
    }
}
