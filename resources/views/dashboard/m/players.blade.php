@extends('layouts.dashboard')

@section('dashboard')

<dashboard-manager model="Player"></dashboard-manager>
<players is_admin="{{ Auth::user()->isAdmin }}" team_id="{{ $team->id }}"></players>
<div class="sectionloader is-active">
  <div class="has-text-centered" style="margin-top: 3rem">
    <div class="loader-grid has-background-dark"></div>
    <div class="is-size-5" style="margin-top: 0.5rem">Loading...</div>
  </div>
</div>

@endsection
