@extends('layouts.dashboard')

@section('dashboard')

<section class="section has-text-centered">
    <!-- <div class="container"> -->
      <p class="image is-96x96 has-text-centered" style="margin: auto auto 1rem;">
        <img src="{{ $invite->team->logo }}">
      </p>
      <h1 class="title">Join Team</h1>
      <h2 class="subtitle">{{ $invite->team->name }}</h2>
      <p class="is-size-6" style="max-width: 300px; margin: auto auto 1.5rem;"> {{$invite->team->overview }}</p>
      @if(!$accepted)
        <form class="is-marginless" action="/dashboard/invite/join" method="post">
          @csrf
          <input type="hidden" name="invite" value="{{ $invite->id }}">
          <input type="hidden" name="team" value="{{ $invite->team->id }}">
          <button type="submit" name="button" class="button is-medium is-info">Accept Invite</button>
        </form>
      @else
        <button type="button" disabled class="button is-medium is-info">Accept Invite</button>
        <p class="has-text-success">Congrats! You joined the team!</p>
      @endif
    <!-- </div> -->
  </section>


@endsection
