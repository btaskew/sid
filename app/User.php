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

    public function activeCalls()
    {
      return $this->calls()->where('status', '=', 0)->get();
    }

    public function closedCalls()
    {
      return $this->calls()->where('status', '=', 1)->get();
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
    }
}
