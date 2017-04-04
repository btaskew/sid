<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CallRequest;
use App\User;
use App\Call;

class CallController extends Controller
{

  public function index()
  {
    $calls = auth()->user()->calls()->get();
    $calls = $this->render($calls);
    return view('calls.index', compact('calls'));
  }

  public function create()
  {
    $staff = User::staff();
    return view('calls.create', compact('staff'));
  }

  public function store(CallRequest $request)
  {
    auth()->user()->log(new Call(request(['title', 'description', 'level', 'staff_id'])));
    session()->flash('message', 'Your call has been made. Please allow up to 1 week for a response.');

    return redirect()->home();
  }

  protected function render($calls)
  {
    foreach ($calls as $call)
    {
      $call->level = Call::renderLevel($call->level);
      $call->assigned_to = User::renderStaff(User::find($call->staff_id));
    }
    return $calls;
  }
}
