@extends('layouts.main-layout')

@section('content')

<?php if (empty($page)) $page = '' ?>

<div class="section">
  <div class="columns">
    <aside class="column is-2">
      <nav class="menu">
        <p class="menu-label">
          General
        </p>
        <ul class="menu-list">
          <li><a href="/dashboard" class="{{ $v('dashboard.home') }}">Home</a></li>
          <li>
            <a href="/dashboard/player/edit" class="{{ $v('dashboard.my-player') }}">My Player</a>
          </li>
          <li><a href="/dashboard/player/teams" class="{{ $v('dashboard.my-team') }}">My Teams</a></li>
        </ul>
        @if (Auth::user()->isAdmin)
        <p class="menu-label">
          Administration
        </p>
        <ul class="menu-list">
          <li><a href="/dashboard/faq/view" class="{{ $v('dashboard.a.faq') }}">Manage FAQ</a></li>
          <li><a href="/dashboard/sponsor/view" class="{{ $v('dashboard.a.sponsors') }}">Manage Sponsors</a></li>
        </ul>
        @endif
        @if(Auth::user()->isMod)
        <p class="menu-label">
          Moderation
        </p>
        <ul class="menu-list">
          <li>
            <a href="/dashboard/team/view" class="{{ $v('dashboard.m.teams') }}">Manage Teams</a>
            <ul class="menu-list">
              <li><a href="/dashboard/invite/view" class="{{ $v('dashboard.m.invites') }}">Invitations</a></li>
              <!-- <li><a href="/dashboard/player/view" class="{{ $v('dashboard.m.players') }}">Manage Players</a></li> -->
            </ul>
          </li>
        </ul>
        @endif
      </nav>
    </aside>

    <main class="column" id="dashboard">
      @yield('dashboard')
    </main>
  </div>
</div>
@endsection

@section('scripts')
<script src="/js/app.js" charset="utf-8"></script>
@yield('dashboardscripts')
@endsection
