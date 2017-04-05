<?php

function currentUser()
{
  return auth()->user();
}

function flash($message)
{
  return session()->flash('message', $message);
}
