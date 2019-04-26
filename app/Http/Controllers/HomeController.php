<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Streamer;
use App\News;
use App\Player;
use DB;
use App\YoutubeVideo;

class HomeController extends Controller
{
    public function frontpage() {
        $ytvideos = YoutubeVideo::orderBy('created_at', 'desc')->limit(20)->get();
        try {
            $fstreamer = DB::table('featured_streamer')
                        ->orderBy('created_at', 'desc')
                        ->first();
            $player = Player::find($fstreamer->player_id);
            $fsdata = getTwitchStreamByUser($player->streamer->twitch_id)->data;
            $fstream = isset($fsdata[0]) ? $fsdata[0] : null; 

            $streamers = Streamer::where('twitch_live', true)->get();
            

            foreach($streamers as &$streamer) {
                $data = getTwitchStreamByUser($streamer->twitch_id)->data;
                $streamer->stream = isset($data[0]) ? $data[0] : (object)[]; 
                $streamer->stream->thumbnail = "https://static-cdn.jtvnw.net/previews-ttv/live_user_{$streamer->twitch}-480x270.jpg";
            }
            return view('home', [
                "articles" => News::limit(5)->orderBy('created_at', 'desc')->get(),
                "player" => $player,
                "stream" => $fstream,
                "streamers" => $streamers,
                "ytvideos" => $ytvideos
            ]);
        } catch (\Exception $e) {
            return view('home', [
                "articles" => News::limit(5)->orderBy('created_at', 'desc')->get(),
                "ytvideos" => $ytvideos
            ]);
        }
        
    }

    public function checkurl(Request $r)
    {
        $status = checkurl($r->url) ? 200 : 404;
        return response()->json($r->url, $status);
    }
}
