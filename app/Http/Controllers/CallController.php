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

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index($category)
  {
    $calls = currentUser()->getCalls($category);
    $category = camelToString($category);
    return $this->show($calls, $category);
  }

  protected function show($calls, $category)
  {
    $actions = $this->loadActions($calls);
    return view("calls.index", compact('calls', 'actions', 'category'));
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
    return redirect()->route('calls', ['category' => 'active']);
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
      throw new \Exception("No calls found.");
    }
    $actions=[];
    foreach($calls as $call)
    {
      $collection = $call->actions()->get();
      if(!$collection->isEmpty())
      {
        $actions[$call->id] = count($collection);
      }
    }
    return $actions;
  }
}
