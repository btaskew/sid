<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest', ['except' => 'destroy']);
  }

  public function create()
  {
    return view('sessions.create');
  }

  public function destroy()
  {
    if(auth()->check())
    {
      auth()->logout();
      flash('Successfully logged out');
      return redirect()->route('login');
    }
    flash('You are not logged in');
    return redirect()->route('login');
  }

  public function store()
  {
    if(!auth()->attempt(request(['email', 'password'])))
    {
      return back()->withErrors([
        'message' => 'Please check you details and try again.'
      ]);
    }
    flash('Welcome back!');
    return redirect()->home();
  }

}
