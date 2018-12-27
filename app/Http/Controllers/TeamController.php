<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TeamUpdate;
use Team;
use Auth;
use DB;
use User;

class TeamController extends Controller
{

    private function isMod(Team $team) {
      if (Auth::user()->runsTeam($team) || Auth::user()->isAdmin) {
        return;
      }
      else return abort(404);
    }

    public function logo(Request $r) {
      $team = Team::find($r->team_id);
      $team->logo = upload_image($r, [
        "path" => "/team_logos",
        "width" => 150,
        "square" => true,
        "quality" => 60
      ]);
      $team->save();
      return $team->logo;
    }

    public function view($value='')
    {
      return view("dashboard.m.teams");
    }

    public function fetch($value='')
    {
      if (Auth::user()->isMod) {
        $teams = Auth::user()->teams()->wherePivot('isMod', 1)->get();
        if (Auth::user()->isAdmin) {
          $teams = Team::selectRaw('? as can_delete', [Auth::user()->isAdmin])
          ->addSelect('teams.*')
          ->get();
        }
        return response()->json($teams);
      } else {
        return abort(403);
      }
    }

    public function players(Team $team) {
      return view('dashboard.m.players')->with('team', $team);
    }

    public function players_fetch($team) {
      $team = Team::where('id', $team)->with('users.player')->whereHas('users.player', function ($q) {
        if (!Auth::user()->isAdmin) {
          $q->where('users.isMod', 0);
        }
      })->first();
      return response()->json($team);
    }

    public function edit(Team $team)
    {
      $this->isMod($team);
      return view('dashboard.edit-team')->with('team', $team);
    }

    public function create(Request $r)
    {
      // dd(factory('App\Team')->make()->toArray());
      $team = Team::create(factory('App\Team')->make()->toArray());
      $team->users()->sync([
        Auth::id() => ['isMod' => true]
      ]);
      return redirect('/dashboard/team/edit/' . $team->id);
    }

    public function update(TeamUpdate $r)
    {
      $data = $r->validated();
      $team = Team::findOrFail($r->id);
      $this->isMod($team);
      $team->update($data);
      return back();
    }

    public function delete(Request $r)
    {
      $team = Team::findOrFail($r->id)->delete();
      return redirect('/dashboard/a/manage-teams');
    }

    public function makemod (Request $r) {
      $user = User::find($r->user_id);
      $team = Team::find($r->team_id);
      $isMod = User::with('teams')->get()->find($r->user_id)->teams->find($r->team_id)->pivot->isMod;
      if ($isMod) {
        $user->teams()->updateExistingPivot($r->team_id, [ "isMod" => 0 ]);
      } else {
        $user->teams()->updateExistingPivot($r->team_id, [ "isMod" => 1 ]);
      }
      return response()->json(User::with('teams')->get()->find($r->user_id)->teams->find($r->team_id)->pivot->isMod);
    }
}
