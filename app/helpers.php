<?php

function currentUser()
{
  return auth()->user();
}

function flash($message)
{
  return session()->flash('message', $message);
}

function camelToString($string)
{
  return strtolower(preg_replace('/((?:^|[A-Z])[a-z]+)/', ' $0', $string));
}
