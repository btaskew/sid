<?php

namespace App;

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

    public function notifications()
    {
      return $this->hasMany(Notification::class);
    }

    public function activeCalls()
    {
      return $this->calls()->where('status', '=', 0)->get();
    }

    public function closedCalls()
    {
      return $this->calls()->where('status', '=', 1)->get();
    }

    public function assignedCalls()
    {
      return Call::where('assigned_id', '=', $this->id)->get();
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
      $this->sendNotification(1, $call->assigned_id);
    }

    public function formatName()
    {
      if($this->department)
      {
        return $this->name.' ('.$this->department.')';
      }
      return $this->name;
    }

    public function sendNotification($message_id, $id = null)
    {
      if(!$id)
      {
        $id = $this->id;
      }
      $notification = new Notification();
      $notification->store($message_id, $id);
    }
}
