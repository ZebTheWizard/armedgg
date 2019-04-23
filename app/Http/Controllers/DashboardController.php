<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home () {
      return view('dashboard.account.index')->with([
        "user" => Auth::user()
      ]);
    }

    public function overview () {
      return view('dashboard.overview.index');
    }
}
