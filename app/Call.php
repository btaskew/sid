<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
  protected $fillable = [
        'title', 'description', 'level', 'staff_id'
    ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function actions()
  {
    return $this->hasMany(Action::class);
  }

  public function saveAction(Action $action)
  {
    $action->call_id = $this->id;
    $this->actions()->save($action);
  }

  protected function renderLevel($level)
  {
    if($level === 1)
    {
      return "Urgent";
    }
    return "Normal";
  }
}
