<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $roles = [
    'staff' => 1,
    'student' => 2
  ];

  public static function id($key)
  {
    $role = new static;
    if (array_key_exists($key, $role->roles))
    {
      return $role->roles[$key];
    }
    die("Array key does not exists");
  }

  public function user()
  {
    return $this->hasMany(User::class);
  }
}
