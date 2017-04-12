<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
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
    $user = User::create([
      'role_id' => Role::id(request('role')),
      'name' => request('name'),
      'email' => request('email'),
      'password' => bcrypt(request('password')),
      'department' => request('department')
    ]);

    auth()->login($user);

    flash('Thanks so much for signing up!');

    return redirect()->home();
  }



}
