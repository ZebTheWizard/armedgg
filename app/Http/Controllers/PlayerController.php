<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\Category;
// use Auth;
// use Image;
// use Storage;
// use Validator;
// use App\Rules\LiveUrl;
// use \romanzipp\Twitch\Twitch;

class PlayerController extends Controller
{
  public function index () {
    return view('dashboard.players.index')->with([
      "players" => Player::with('category')->get(),
      "categories" => Category::whereNull('parent_id')->get()
    ]);
  }

  public function create(Request $request) {
    
    $player = Player::find($request->id);

    $data = [
      "name" => $request->name,
      "category_id" => (int)$request->category,
      "country_name" => $request->country_name,
      "country_flag" => $request->country_flag,
      "instagram" => $request->instagram,
      "twitch" => $request->twitch,
      "twitter" => $request->twitter,
      "youtube" => $request->youtube,
      "snippet" => $request->snippet
    ];
    if ($request->photo) {
      $request->validate(["photo" => "image|file|max:2048"]);
      $data['avatar'] = upload_image($request, [
        "path" => "/player_avatars",
        "width" => 150,
        "square" => true,
        "quality" => 60
      ]);
    }
    // if ($player) dd($player);
    
    if ($player) {
      $player->update($data);
    } else {
      Player::create($data);
    }

    return back();
  }

  public function delete(Request $r) {
    $Player = Player::find($r->id);
    $Player->delete();
    return back();
  }

  public function getYoutube(Player $player) {
    if (!$player->youtube) abort(404);
    $videos = getYoutubeVideosFromChannel($player->youtube);
    
    return response()->json($videos);
  }

    // public function twitch ($username) {
    //   dd(liveOnTwitch($username));
    // }
    //
    // public function avatar(Request $r) {
    //   if (isset(Auth::user()->player)) {
    //     $player = Auth::user()->player;
    //   } else {
    //     $player = new Player;
    //     $player->user_id = Auth::id();
    //   }
    //
    //   $player->avatar = upload_image($r, [
    //     "path" => "/player_avatars",
    //     "width" => 150,
    //     "square" => true,
    //     "quality" => 60
    //   ]);
    //   $player->save();
    //   return $player->avatar;
    // }
    //
    // public function edit()
    // {
    //   $player = Auth::user()->player ? Auth::user()->player : new Player;
    //   return view('dashboard.my-player')->with('player', $player);
    // }
    //
    // public function create(Request $r)
    // {
    //   Player::create([
    //     //
    //   ]);
    // }
    //
    // public function update(Request $r)
    // {
    //   // dd([$r->reddit_url, $r->reddit]);
    //   $r->validate([
    //     'facebook_url' => [(new LiveUrl)->checkValueForEmpty($r->facebook)],
    //     'instagram_url' => [(new LiveUrl)->checkValueForEmpty($r->instagram)],
    //     'mixer_url' => [(new LiveUrl)->checkValueForEmpty($r->mixer)],
    //     'snapchat_url' => [(new LiveUrl)->checkValueForEmpty($r->snapchat)],
    //     // 'reddit_url' => [(new LiveUrl)->checkValueForEmpty($r->reddit)],
    //     'twitch_url' => [(new LiveUrl)->checkValueForEmpty($r->twitch)],
    //     'twitter_url' => [(new LiveUrl)->checkValueForEmpty($r->twitter)],
    //     'youtube_url' => [(new LiveUrl)->checkValueForEmpty($r->youtube)],
    //     'avatar' => 'required',
    //     'nname' => 'required'
    //   ]);
    //
    //   $player = Auth::user()->player ? Auth::user()->player : new Player;
    //   // $player = Player::findOrFail($r->id);
    //   $player->user_id = Auth::id();
    //   $player->fname = $r->fname;
    //   $player->lname = $r->lname;
    //   $player->nname = $r->nname;
    //   $player->about = trim($r->about);
    //   $player->youtube = $r->youtube;
    //   $player->twitter = $r->twitter;
    //   $player->twitch = $r->twitch;
    //   $player->instagram = $r->instagram;
    //   $player->facebook = $r->facebook;
    //   $player->snapchat = $r->snapchat;
    //   // $player->mixer = $r->mixer;
    //   // $player->reddit = $r->reddit;
    //   $player->fname = $r->fname;
    //   $player->othersocial = $r->othersocial;
    //   $player->avatar = $r->avatar;
    //   $player->save();
    //   return back();
    // }
    //
    // public function delete(Request $r)
    // {
    //   $player = Player::findOrFail($r->id)->delete();
    //   return redirect('/dashboard/m/manage-players');
    // }
    //
    // public function profile(Player $player) {
    //   return view('player')->with('player', $player);
    // }
    //
    

}
