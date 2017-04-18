<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Notification;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    if(auth()->check())
    {
      $notifications = currentUser()->getNotifications();
      return view('home', compact('notifications'));
    }
    return view('sessions.create');
  }

  public function delete(Notification $notification)
  {
    $notification->delete();
    return redirect()->back();
  }

  public function deleteAll()
  {
    $notifications = currentUser()->notifications()->get();
    foreach ($notifications as $notification)
    {
      $notification->delete();
    }
    return redirect()->back();
  }
}
