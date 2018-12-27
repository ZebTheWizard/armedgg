@extends('layouts.dashboard')

@section('dashboard')

<div class="title">Dashboard {{Auth::user()->email}}</div>

<?php
  $tiles = [
    [
      "middleware" => "none",
      "name" => "My Player",
      "icon" => "fas fa-user-circle",
      "link" => "/dashboard/player/edit",
      "color" => "dark",
    ],
    // [
    //   "middleware" => "none",
    //   "name" => "My Teams",
    //   "icon" => "fas fa-headset",
    //   "link" => "/dashboard/player/teams",
    //   "color" => "dark",
    // ],
    [
      "middleware" => "isMod",
      "name" => "Invitations",
      "icon" => "fas fa-envelope",
      "link" => "/dashboard/invite/view",
      "color" => "warning",
    ],
    // [
    //   "middleware" => "isMod",
    //   "name" => "Players",
    //   "icon" => "fas fa-users",
    //   "link" => "/dashboard/player/view",
    //   "color" => "warning",
    // ],
    [
      "middleware" => "isMod",
      "name" => "Teams",
      "icon" => "fas fa-gamepad",
      "link" => "/dashboard/team/view",
      "color" => "warning",
    ],
    [
      "middleware" => "isAdmin",
      "name" => "FAQ",
      "icon" => "fas fa-question",
      "link" => "/dashboard/faq/view",
      "color" => "danger",
    ],
    [
      "middleware" => "isAdmin",
      "name" => "Sponsors",
      "icon" => "fas fa-dollar-sign",
      "link" => "/dashboard/sponsor/view",
      "color" => "danger",
    ],
  ];
?>


<div class="columns is-multiline">
  @foreach($tiles as $tile)
    @if(Auth::user()[$tile['middleware']] || $tile['middleware'] === 'none')
      <div class="column is-2">
        <a href="{{ $tile['link'] }}" class="box square is-size-3 is-size-5-tablet" style="width: 100%">
          <div class="content">
            <div class="has-text-centered has-text-weight-bold">
              {{ $tile['name'] }}
              <div class="is-size-1" style="margin-top: 0.5rem;"><i class="{{ $tile['icon'] }}"></i></div>
            </div>
          </div>
        </a>
      </div>
    @endif
  @endforeach
  <div class="column is-2">
    <form action="/logout" class="is-marginless" method="post">
      @csrf
      <button type="submit" class="box square is-size-3 is-size-5-tablet" style="width: 100%">
        <div class="content">
          <div class="has-text-centered has-text-weight-bold has-text-danger">
            Logout
            <div class="is-size-1" style="margin-top: 0.5rem;"><i class="fas fa-sign-out"></i></div>
          </div>
        </div>
      </button>
    </form>

  </div>
</div>

@endsection
