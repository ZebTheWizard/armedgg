<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Streamer;
use App\News;
use App\Player;
use DB;

class HomeController extends Controller
{
    public function frontpage() {
        try {
            $featured_streamer = DB::table('featured_streamer')
                        ->orderBy('created_at', 'desc')
                        ->first();
            $player = Player::find($featured_streamer->player_id);

            return view('home', [
                "articles" => News::limit(5)->orderBy('created_at', 'desc')->get(),
                "player" => $player,
                "streamers" => Streamer::where('twitch_live', true)->inRandomOrder()->limit(4)->get(),
            ]);
        } catch (\Exception $e) {
            return view('home', [
                "articles" => News::limit(5)->orderBy('created_at', 'desc')->get(),
            ]);
        }
        
    }

    public function checkurl(Request $r)
    {
        $status = checkurl($r->url) ? 200 : 404;
        return response()->json($r->url, $status);
    }
}
