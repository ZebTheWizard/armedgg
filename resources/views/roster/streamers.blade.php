@extends('layouts.roster', ['title' => 'Streamers'])
@section('roster-content')

<div class="container">
  <div class="columns">
    <div class="column field" style="width: 100%;">
      <p class="control has-icons-left">
        <input class="input" type="text" placeholder="Search for players..." oninput="search(this, 'players', 'players-noresults')">
        <span class="icon is-small is-left">
          <i class="fas fa-search"></i>
        </span>
      </p>
    </div>
  </div>
</div>

<div class="container">
  <div class="has-text-centered is-size-4 has-background-light" id="players-noresults" style="display: none">
    Could not find any players.
  </div>
  <div class="columns is-multiline" id="players">
    @foreach($players as $player)
      @component('components.player', [
        "player" => $player
      ])@endcomponent
    @endforeach
  </div>
</div>

@endsection
