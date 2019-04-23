<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

class AccountController extends Controller
{
  public function index () {
    return view('dashboard.account.index')->with([
      "user" => Auth::user()
    ]);
  }

  public function name (Request $request) {
    $request->validate([
      "name" => "required"
    ]);

    Auth::user()->name = $request->name;
    Auth::user()->save();
  }

  public function email (Request $request) {
    $request->validate([
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    ]);

    Auth::user()->email = $request->email;
    Auth::user()->save();
  }

  public function password (Request $request) {
    $request->validate([
      "password_old" => 'required',
      'password' => ['required', 'string', 'min:6', 'confirmed']
    ]);
    if (!Hash::check($request->password_old, Auth::user()->password)) {
      return back()->with([
        "oldpassword" => "doesn't match"
      ]);
    } else {
      Auth::user()->password = Hash::make($request->password);
      Auth::user()->verified = true;
      Auth::user()->save();
      return back()->with([
        "newpassword" => "success"
      ]);
    }

  }
}
