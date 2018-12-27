<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlayerAndTeamTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function ($table) {
          $table->engine = 'InnoDB';
          $table->primary('id');
          $table->string('id', 36)->index();
          $table->string('user_id', 36)->references('id')->on('users');
          $table->string('fname')->nullable();
          $table->string('lname')->nullable();
          $table->string('nname')->nullable();
          $table->string('about')->nullable();
          $table->string('avatar')->nullable();
          $table->string('youtube')->nullable();
          $table->string('twitter')->nullable();
          $table->string('twitch')->nullable();
          $table->string('instagram')->nullable();
          $table->string('facebook')->nullable();
          $table->string('snapchat')->nullable();
          $table->string('mixer')->nullable();
          $table->string('reddit')->nullable();
          $table->string('othersocial')->nullable();
          $table->timestamps();
        });

        Schema::create('invitations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->primary('id');
            $table->string('id', 36)->index();
            $table->string('nonce', 11)->unique();
            $table->string('team_id', 36)->references('id')->on('teams');
            $table->timestamps();
        });

        Schema::create('teams', function($table) {
          $table->engine = 'InnoDB';
          $table->primary('id');
          $table->string('id', 36)->index();
          $table->string('name');
          $table->string('logo');
          $table->string('color');
          $table->longText('overview');
          $table->timestamps();
        });

        Schema::create('team_user', function ($table) {
          $table->engine = 'InnoDB';
          $table->increments('id');
          $table->string('user_id', 36)->references('id')->on('users');
          $table->string('team_id', 36)->references('id')->on('teams');
          $table->boolean('isMod')->default(false);
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
        Schema::dropIfExists('players');
        Schema::dropIfExists('invitations');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('team_user');
    }
}
