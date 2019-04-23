<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Role;
use Permission;
use App\User;

class RoleController extends Controller
{
    public function index () {
      $roles = Role::get();
      return view('dashboard.roles.index')->with([
        "roles" => $roles,
        "permissions" => Permission::get()
      ]);
    }

    public function create (Request $request) {
      $perms = [];
      foreach ($request->all() as $key => $value) {
        $e = explode(":", $key);
        if (isset($e[1])) {
          array_push($perms, (int)$e[1]);
        }
      };
      $role = Role::firstOrCreate(["name" => $request->name]);
      $role->syncPermissions($perms);
      return back();
    }

    public function delete(Request $r) {
      $Role = Role::find($r->id);
      if(User::role($Role)->count() <= 0) {
        $Role->delete();
      }
      return back();
    }
}
