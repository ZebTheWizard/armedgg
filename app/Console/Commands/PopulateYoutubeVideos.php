<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Player;
use App\YoutubeVideo;
use Carbon\Carbon;

class PopulateYoutubeVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the database with the latest youtube videos from all players.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $p = Player::find(2);

        $players = Player::whereNotNull('youtube')->get();
        foreach($players as $player) {
            $uploadPlayist = getYoutubeUploadsFromChannel($player->youtube);
            $videos = getYoutubeVideosFromPlaylist($uploadPlayist);
            foreach($videos as $video) {
                $v = $video->snippet;
                $id = $v->resourceId->videoId;
                $stats = getYoutubeVideoStats($id);
                $date = Carbon::parse($v->publishedAt)->format('Y-m-d H:i:s');
                $data = [
                    "id" => $id,
                    "title" => $v->title,
                    "player_id" => $player->id,
                    "thumbnail" => $v->thumbnails->medium->url,
                    "views" => $stats->viewCount,
                    "created_at" => $date
                ];
                $yt = YoutubeVideo::find($id);
                if ($yt) {
                    $yt->update($data);
                } else {
                    YoutubeVideo::create($data);
                }
                dump($data);
            }
        }
        // dump($players->toArray());
        
    }
}
