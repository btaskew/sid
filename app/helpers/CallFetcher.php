<?php

namespace App\helpers;
use App\User;
use App\Call;

class CallFetcher
{
  protected $user;

  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function active()
  {
    return $this->user->calls()->where('status', '=', 0)->get();
  }

  public function closed()
  {
    return $this->user->calls()->where('status', '=', 1)->get();
  }

  public function assigned()
  {
    return Call::where([
      ['assigned_id', '=', $this->user->id],
      ['status', '=', 0],
      ])->get();
  }

  public function closedAssigned()
  {
    return Call::where([
      ['assigned_id', '=', $this->user->id],
      ['status', '=', 1],
      ])->get();
  }
}
