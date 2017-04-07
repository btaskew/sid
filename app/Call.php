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
    $this->statusActions($action);
    $this->actions()->save($action);
  }

  protected function assignIds(Action $action)
  {
    $action->call_id = $this->id;
    $action->user_id = currentUser()->id;
    return $action;
  }

  protected function statusActions(Action $action)
  {
    if($action->action_id === "Close Call")
    {
      $this->status = 1;
    }
    else if($action->action_id === "Re-Open Call")
    {
      $this->status = 0;
    }
    $this->save();
    return;
  }


}
