<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
  protected $fillable = [
        'title', 'description', 'priority', 'assigned_id'
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
    $staff = User::find($this->assigned_id);
    return $staff->formatName($staff);
  }

  public function saveAction(Action $action)
  {
    $action->assignIds($this->id);
    $message_id = $this->updateStatus($action->action_type);
    $this->actions()->save($action);
    Notification::send($this, $message_id);
  }

  protected function updateStatus($action_type)
  {
    $message_id = 2;
    if($action_type === "Close Call")
    {
      $this->status = 1;
      $message_id = 3;
    }
    else if($action_type === "Re-Open Call")
    {
      $this->status = 0;
      $message_id = 4;
    }
    $this->save();
    return $message_id;
  }

  public function caller()
  {
    return User::find($this->user_id);
  }

  public function assignedTo()
  {
    return User::find($this->assigned_id);
  }


}
