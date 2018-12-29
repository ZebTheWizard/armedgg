<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Player;
use DB;
use App\Streamer;
use Artisan;

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
        Artisan::call('streamer:add');
        $player = Streamer::where('twitch_live', true)
          ->inRandomOrder()
          ->first();

        if ($player !== null) {
          DB::table('featured_streamer')->insertGetId([
              "player_id" => $player->player_id,
              "created_at" => \Carbon\Carbon::now(),
              "updated_at" => \Carbon\Carbon::now(),
          ]);
        }



    }
}
