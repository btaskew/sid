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

  public function index()
  {
    $calls = auth()->user()->calls()->get();
    $actions = $this->loadActions($calls);
    return view('calls.index', compact('calls', 'actions'));
  }

  public function create()
  {
    $staff = User::staff();
    return view('calls.create', compact('staff'));
  }

  public function store(CallRequest $request)
  {
    auth()->user()->log(new Call(request(['title', 'description', 'priority', 'staff_id'])));
    session()->flash('message', 'Your call has been made. Please allow up to 1 week for a response.');

    return redirect()->home();
  }

  public function edit(Call $call)
  {
    $actions = $call->actions()->get();
    return view('calls.edit', compact('call', 'actions'));
  }

  public function save(Call $call, ActionRequest $request)
  {
    $call->saveAction(new Action(request(['type', 'content'])));
    session()->flash('message', 'Your action has been recorded.');
    return redirect()->back();
  }

  protected function loadActions($calls)
  {
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
