<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Player;
use DB;
use App\Streamer;

class AddToStreamersTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'streamer:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add players with twitch streams to streamer database';

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
      $players = Player::whereNotNull('twitch')->get();
      
      foreach ($players as $player) {
        if(!$player->twitch_id) {
          $twitch_user = getTwitchUserByLogin($player->twitch);
        }

        $id = $player->twitch_id ?? $twitch_user->_id;

        Streamer::updateOrCreate([
          "player_id" => $player->id,
        ],[
          "twitch" => $player->twitch,
          "twitch_live" => liveOnTwitch($player->twitch),
          "twitch_id" => $id,
          "twitch_logo" => $player->twitch_logo ?? $twitch_user->logo,
          "twitch_display_name" => $player->twitch_display_name ?? $twitch_user->display_name,
        ]);
      }
    }
}
