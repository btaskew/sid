<?php

namespace App\Http\Controllers;

use App\Student;
use App\Staff;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;

class RegistrationController extends Controller
{
  public function create()
  {
    return view('registration.create');
  }

  public function store(RegistrationRequest $request)
  {
    //$this->determineRole($request);
    if($request->role === "staff")
    {
      $user = Staff::create([
        'name' => request('name'),
        'email' => request('email'),
        'password' => bcrypt(request('password')),
        'department' => request('department')
      ]);
    }
    else
    {
      $user = Student::create([
        'name' => request('name'),
        'email' => request('email'),
        'password' => bcrypt(request('password')),
      ]);
    }

    dd($user);

    auth()->login($user);

    //session()->flash('message', 'Thanks so much for signing up!');

    return redirect()->home();
  }

  protected function determineRole(RegistrationRequest $request)
  {
    dd($request->role);
  }


}
