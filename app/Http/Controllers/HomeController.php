<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Notification;

class HomeController extends Controller
{
    public function index()
    {
      if(auth()->check())
      {
        $messages = [];
        $notifications = currentUser()->notifications()->get();

        foreach ($notifications as $notification)
        {
          $message = Message::find($notification->message_id);
          $messages[$notification->id] = $message;
        }
        return view('home', compact('messages'));
      }
      return view('sessions.create');
    }

    public function delete(Notification $notification)
    {
      $notification->delete();
      return redirect()->back();
    }
}
