<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Player;
use DB;

class ChooseFeaturedStreamer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'streamer:featured';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Choose random featured streamer';

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
        $streamer = DB::table('featured_streamer')
          ->orderBy('created_at', 'desc')
          ->first();
        if (!$streamer) {
          $streamer = collect([]);
          $playerquery = Player::whereNotNull('twitch');
        } else {
          $playerquery = Player::whereNotNull('twitch')
            ->where('id', '!=', $streamer->player_id);
        }
        // dd($streamer->toArray());
        $player = $playerquery
          ->inRandomOrder()
          ->first();

        DB::table('featured_streamer')->insertGetId([
            "player_id" => $player->id,
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

    }
}
