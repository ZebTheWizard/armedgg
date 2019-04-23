<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\User;
use Role;
use Hash;

class UserController extends Controller
{
    public function index () {
      $users = User::get();
      $roles = Role::get();
      return view('dashboard.users.index')->with([
        "users" => $users,
        "roles" => $roles
      ]);
    }

    public function create (Request $request) {
      $pwd = Str::random(40);
      $user = User::updateOrCreate([
          'email' => $request->email,
          'name' => $request->name,
      ], [
        'password' => Hash::make($pwd),
        "verified" => false
      ]);
      $user->syncRoles([$request->role]);
      return back()->with([
        "password" => $pwd,
        "newuser" => $user
      ]);
    }

    public function delete(Request $r) {
      $User = User::find($r->id);
      $User->delete();
      return back();
    }
}
