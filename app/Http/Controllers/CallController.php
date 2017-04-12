<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CallRequest;
use App\Http\Requests\ActionRequest;
use App\User;
use App\Call;
use App\Action;

class CallController extends Controller
{

  public function activeCalls()
  {
    $calls = currentUser()->activeCalls();
    return $this->show($calls, 'active');
  }

  public function closedCalls()
  {
    $calls = currentUser()->closedCalls();
    return $this->show($calls, 'closed');
  }

  public function assignedCalls()
  {
    $calls = currentUser()->assignedCalls();
    return $this->show($calls, 'assigned');
  }

  protected function show($calls, $category)
  {
    $actions = $this->loadActions($calls);
    return view("calls.calls", compact('calls', 'actions', 'category'));
  }

  public function create()
  {
    $staff = User::staff();
    return view('calls.create', compact('staff'));
  }

  public function store(CallRequest $request)
  {
    currentUser()->log(new Call(request(['title', 'description', 'priority', 'assigned_id'])));
    flash('Your call has been made. Please allow up to 1 week for a response.');
    return redirect()->route('calls');
  }

  public function edit(Call $call)
  {
    $actions = $call->actions()->orderBy('created_at')->get();
    return view('calls.edit', compact('call', 'actions'));
  }

  public function save(Call $call, ActionRequest $request)
  {
    $call->saveAction(new Action(request(['action_type', 'content'])));
    flash('Your action has been recorded.');
    return redirect()->back();
  }

  protected function loadActions($calls)
  {
    if(!$calls)
    {
      throw new \Exception("No calls found.", 1);
    }
    $actions=[];
    foreach($calls as $call)
    {
      $collection = $call->actions()->get();
      if(!$collection->isEmpty())
      {
        $actions[$call->id] = $collection;
      }
    }
    return $actions;
  }
}
