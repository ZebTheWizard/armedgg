<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Player;
use App\YoutubeVideo;
use Carbon\Carbon;
use Symfony\Component\Process\Process;

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
        // $p = Player::find(2);

        $players = Player::whereNotNull('youtube')->get();
        $channel_ids = $players->pluck('youtube')->implode(",");
        // dd($);
        $process = new Process(["./getYoutubeStats", "--channels", $channel_ids, "--key", env("YOUTUBE_KEY")]);
        try {
            $process->mustRun();
            $data = json_decode($process->getOutput());
            foreach($data as $video) {
                $player = $players->where("youtube", $video->channel_id)->first();
                $date = Carbon::parse($video->publishedAt)->format('Y-m-d H:i:s');
                $data = [
                    "id" => $video->id,
                    "title" => $video->title,
                    "player_id" => $player->id,
                    "thumbnail" => $video->thumbnail,
                    "views" => $video->viewCount,
                    "created_at" => $date
                ];
                $yt = YoutubeVideo::find($video->id);
                if ($yt) {
                    $yt->update($data);
                } else {
                    $yt = YoutubeVideo::create($data);
                }
                dump($yt->toArray());
            }
            
            dd("[DONE]");
        } catch (ProcessFailedException $exception) {
            echo $exception->getMessage();
        }
        
    }
}
