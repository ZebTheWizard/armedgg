<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Player;
use Team;

class RosterController extends Controller
{
    // private excludeAdmin = function($q) {
    //   $q->where('isAdmin', 0);
    // }

    private function excludeAdmin() {
      return function($q) {
        $q->where('isAdmin', 0);
      };
    }

    public function all() {
      return view('roster.all', [
        "players" => Player::with('user.teams')
          ->whereHas('user', $this->excludeAdmin())
          ->get()
      ]);
    }

    public function creators() {
      return view('roster.creators', [
        "players" => Player::with('user.teams')->whereHas('user.teams', function ($q) {
          $q->where('name', 'like', '%creator%');
        })->whereHas('user', $this->excludeAdmin())->get()
      ]);
    }

    public function streamers() {
      return view('roster.streamers', [
        "players" => Player::with('user.teams')->whereHas('user.teams', function ($q) {
          $q->where('name', 'like', '%stream%');
        })->whereHas('user', $this->excludeAdmin())->get()
      ]);
    }

    public function teams($team) {
      // return response()->json(
      //   Team::where('id', $team)->with('users.player')->with(['users' => $this->excludeAdmin()])->first()
      // );
      return view('roster.team', [
        "team" => Team::where('id', $team)->with('users.player')->with(['users' => $this->excludeAdmin()])->first()
      ]);
    }
}
