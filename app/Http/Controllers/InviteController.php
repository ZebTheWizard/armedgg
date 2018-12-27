<?php

namespace App\Http\Controllers;

use App\Invitation as Invite;
use Illuminate\Http\Request;
use App\Http\Requests\Register;
use Team;
use Auth;
use DB;
use User;
use Hash;

class InviteController extends Controller
{


    public function view() {
      return view("dashboard.m.invites")->with('page', 'invites');
    }

    public function fetch()
    {
      $authTeams = Auth::user()->teams()->get()->pluck('id');

      $invites = Invite::with('team')->whereHas('team', function($query) use($authTeams) {
        $query->whereIn('id', $authTeams);
      })->get();

      return response()->json($invites);
    }

    public function create(Request $r)
    {
      $team = Team::findOrFail($r->id);
      $inv = Invite::create([
        "team_id" => $r->id
      ]);
      $team->invites()->save($inv);
    }

    public function join($id) {
      $invite = Invite::where('id', $id)->with('team')->firstOrFail();
      if (Auth::guest()) {
        return view('auth.register', [
          "invite" => $invite
        ]);
      }
      return view('dashboard.invite', [
          "invite" => $invite,
          "accepted" => $invite->team->users->contains('id', Auth::id())
      ]);
    }

    public function accept(Request $r) {
      $invite = Invite::findOrFail($r->invite);
      $team = Team::findOrFail($r->team);
      if (!$team->users->contains('id', Auth::id())) {
        $team->users()->attach([
          Auth::id()
        ]);
      }

      if(Auth::user()->player) {
        return redirect("/i/$invite->id");
      } else {
        return redirect("/dashboard/player/edit");
      }

    }

    public function createuser(Register $r) {
      // dd('asdfasdf');
      $invite = Invite::findOrFail($r->id);
      if($invite->nonce !== $r->nonce) return abort(404);
      $user = User::create([
          'email' => $r->email,
          'password' => Hash::make($r->password),
          'isAdmin' => false,
          'isMod' => false,
      ]);
      Auth::login($user, TRUE);
      return redirect("/i/$invite->id");
    }
}
