<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function page($page=null)
    {
      if ($page) {
        $folder = request()->segment(2);
        try {
          return view("dashboard.$folder." . str_slug($page))->with('page', str_slug($page));
        } catch (\Exception $e) {
          return abort(404);
        }
      }
      else {
        return view('dashboard.home')->with('page', 'home');
      }
    }
}
