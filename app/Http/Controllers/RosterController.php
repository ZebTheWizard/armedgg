<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Player;

class RosterController extends Controller
{
    // private excludeAdmin = function($q) {
    //   $q->where('isAdmin', 0);
    // }

    public function index() {
      return view('roster')->with([
        'categories' => Category::whereNull('parent_id')->get(),
        "players" => Player::get()
      ]);
    }

    public function parentChild($parent, $child=null) {
      // dump($parent, $child);

      // dump(Category::whereNull('parent_id')->where('name', $parent)->first()->toArray());
      $category = null;
      if (!$child) {
        $category = Category::whereNull('parent_id')->where('name', $parent)->firstOrFail();
      } else {
        $possibleChildren = Category::whereNotNull('parent_id')->where('name', $child)->get();
        $arr = [];
        foreach ($possibleChildren  as $pchild) {
          if ($pchild->hasAncestor($parent)) $category = $pchild;
        }
        if (!$category) return abort(404);
      }
      
      return view('roster')->with([
        'categories' => [$category],
        "players" => Player::get()
      ]);
    }

    // private function excludeAdmin() {
    //   return function($q) {
    //     $q->where('isAdmin', 0);
    //   };
    // }
    //
    // public function all() {
    //   return view('roster.all', [
    //     "players" => Player::with('user.teams')
    //       ->whereHas('user', $this->excludeAdmin())
    //       ->get()
    //   ]);
    // }
    //
    // public function creators() {
    //   return view('roster.creators', [
    //     "players" => Player::with('user.teams')->whereHas('user.teams', function ($q) {
    //       $q->where('name', 'like', '%creator%');
    //     })->whereHas('user', $this->excludeAdmin())->get()
    //   ]);
    // }
    //
    // public function streamers() {
    //   return view('roster.streamers', [
    //     "players" => Player::with('user.teams')->whereHas('user.teams', function ($q) {
    //       $q->where('name', 'like', '%stream%');
    //     })->whereHas('user', $this->excludeAdmin())->get()
    //   ]);
    // }
    //
    // public function teams($team) {
    //   // return response()->json(
    //   //   Team::where('id', $team)->with('users.player')->with(['users' => $this->excludeAdmin()])->first()
    //   // );
    //   return view('roster.team', [
    //     "team" => Team::where('id', $team)->with('users.player')->with(['users' => $this->excludeAdmin()])->first()
    //   ]);
    // }
}
