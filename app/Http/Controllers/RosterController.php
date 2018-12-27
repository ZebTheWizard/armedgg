<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Player;
use Team;

class RosterController extends Controller
{
    public function all() {
      return view('roster.all', [
        "players" => Player::with('user.teams')->get()
      ]);
    }

    public function creators() {
      return view('roster.creators', [
        "players" => Player::with('user.teams')->whereHas('user.teams', function ($q) {
          $q->where('name', 'like', '%creator%');
        })->get()
      ]);
    }

    public function streamers() {
      return view('roster.streamers', [
        "players" => Player::with('user.teams')->whereHas('user.teams', function ($q) {
          $q->where('name', 'like', '%stream%');
        })->get()
      ]);
    }

    public function teams($team) {
      return view('roster.team', [
        "team" => Team::where('id', $team)->with('users.player')->first()
      ]);
    }
}
