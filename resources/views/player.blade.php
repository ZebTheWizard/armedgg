@extends('layouts.main-layout')

@section('content')

<div class="container" style="margin-top: 0rem;">
  <div class="columns">
    <div class="column is-3">
      <div class="">
        <p class="is-size-3" style="margin-bottom: 0.5rem;">
          {{ $player->nname }}
        </p>
        <div class="">
          <figure style="">
            <p class="image has-background-grey-lighter" style="height: 150px; width: 150px">
              <img src="{{ $player->avatar }}">
            </p>
          </figure>
        </div>
        <br>
        @if($player->fname)
          <div class="">
            <div>
              <span class="has-text-weight-bold">First Name:</span>
              <span>{{ $player->fname }}</span>
            </div>
          </div>
        @endif
        @if($player->lname)
          <div class="">
            <div>
              <span class="has-text-weight-bold">Last Name:</span>
              <span>{{ $player->lname }}</span>
            </div>
          </div>
        @endif
        @if($player->about)
          <div class="">
            <div>
              <span class="has-text-weight-bold">About:</span>
              <div class="content">{{ $player->about }}</div>
            </div>
          </div>
        @endif
      </div>
      @if($player->twitter)
      <hr>
      <div class="" style="margin: 1rem 0;">
        <a class="twitter-timeline" data-height="300" data-dnt="true" data-link-color="#19CF86" href="https://twitter.com/{{ $player->twitter }}">Tweets by {{ $player->twitter }}</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      </div>
      @endif
    </div>

    <div class="column">
      <div class="has-text-centered">
        @foreach(config('socials.links') as $social => $link)
          @if($player->$social)
            <a class="square social is-size-3" href="{{ $link . $player->$social }}" style="background: rgba(0,0,0,0); color: {{ config('socials.colors.' . $social) }}">
              <div class="content" style="padding: 0.4rem;">
                <div class="social-background" id="{{$social}}-social"></div>
                <i class="fab fa-{{$social}}" style="z-index: 1"></i>
              </div>
            </a>
          @endif
        @endforeach

        @if($player->othersocial)
        <div style="display: inline-block;border-right: 2px solid black;width: 0px;height: 50px;"></div>
          @foreach(explode(", ", $player->othersocial) as $social)
            <a class="square social is-size-3" href="{{ $social }}" style="background: rgba(0,0,0,0);">
              <div class="content" style="padding: 0.4rem;">
                <img src="https://api.faviconkit.com/{{ parse_url($social)['host'] }}/144" width="30" height="30">
              </div>
            </a>
          @endforeach
        @endif

      </div>
      @if($player->twitch)
        <div id="featured-stream" class="video"></div>
      @endif
      <!-- <div class="column is-one-fifth"> -->
      <div class="box" style="margin-top: 1rem;">Please disable adblock</div>
      <!-- </div> -->
      @if($player->youtube)
      <section class="section" style="padding: 3rem 0">
        <div id="player_youtube">
          <div class="title">YouTube Videos</div>
          <youtube-videos player_id="{{ $player->id }}"></youtube-videos>
        </div>
      </section>
      @endif
    </div>


  </div>
</div>


@endsection


@section('scripts')
  <script src="/js/app.js" charset="utf-8"></script>
  @if($player->twitch)
  <script type="text/javascript">
        var $fs = document.getElementById('featured-stream')
        var $fsw = $fs.getBoundingClientRect().width
        $fs.style.height = ($fsw / 16 * 9) + 'px'
        window.onload = function () {
          console.log('loaded');
            new Twitch.Embed("featured-stream", {
              width: "100%",
              height: $fsw / 16 * 9,
              channel: "{{ $player->twitch }}",
              layout: "video",
              theme: "dark"
            });
        }
  </script>
  @endif
@endsection
