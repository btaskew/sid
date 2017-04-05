<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
  protected $fillable = [
        'title', 'description', 'priority', 'staff_id'
    ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function actions()
  {
    return $this->hasMany(Action::class);
  }

  public function getPriorityAttribute($priority)
  {
    if($priority === 1)
    {
      return "Urgent";
    }
    return "Normal";
  }

  public function getAssignedAttribute($id)
  {
    $staff = User::find($this->staff_id);
    return $staff->name.' - '.$staff->department;
  }

  public function saveAction(Action $action)
  {
    $this->assignIds($action);
    if($action->action_id === "Close Call")
    {
      $this->closeCall();
    }
    $this->actions()->save($action);
  }

  protected function assignIds(Action $action)
  {
    $action->call_id = $this->id;
    $action->user_id = currentUser()->id;
    return $action;
  }

  protected function closeCall()
  {
    $this->status = 1;
    $this->save();
  }


}
