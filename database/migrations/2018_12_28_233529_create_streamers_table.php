<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streamers', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->primary('id');
          $table->string('id', 36)->index();
          $table->string('player_id', 36)->references('id')->on('players');
          $table->string('twitch')->unique();
          $table->boolean('twitch_live')->default(0);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streamers');
    }
}
