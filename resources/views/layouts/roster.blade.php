@extends('layouts.main-layout')
@section('content')

<section class="hero is-danger is-medium" style="margin-bottom: 1rem; background-image: url(/png/banner.png);background-repeat: no-repeat;background-size: cover; background-color: #1d2733">
  <div class="hero-body">
    <div class="container">
      <h1 class="is-size-1 has-text-centered has-text-weight-bold">
        {{ isset($title) ? $title : 'All Players'}}
      </h1>
    </div>
  </div>
  <div class="hero-foot">
    <nav class="tabs">
      <div class="container">
        <ul>
          <li class="{{ $v('roster.all') }}"><a {{ $nv('roster.all', 'href=/roster/all') }}>All</a></li>
          <li class="{{ $v('roster.creators') }}"><a {{ $nv('roster.creators', 'href=/roster/creators') }}>Creators</a></li>
          <li class="{{ $v('roster.streamers') }}"><a {{ $nv('roster.streamers', 'href=/roster/streamers') }}>Streamers</a></li>
        </ul>
      </div>
    </nav>
  </div>
</section>

@yield('roster-content')

@endsection


@section('scripts')
<script type="text/javascript">
Array.from(document.querySelectorAll('.player-card')).forEach(el => {
  if (el.dataset.id) {
    el.addEventListener('click', e => {
      e.stopPropagation()
      console.log(e);
    })
  }
})
</script>
@endsection
