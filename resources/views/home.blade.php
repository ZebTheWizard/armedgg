@extends('layouts.main-layout')

@section('content')


@if(isset($player) && count($streamers) > 0)
  <section class="bg-black pt-3 px-4 pb-5">
    <div class="container">
      <div class="col">
        <div id="featured-stream" class="video"></div>
      </div>
    </div>
  </section>
@else
  <section class="bg-black pt-3 px-4 pb-5">
    <div class="container">
      <p class="text-center text-white my-5 col-8 mx-auto">
          Currently, none of our players are live on twitch. Join ArmedGG to see your stream here.
      </p>
    </div>
  </section>
@endif

@if(isset($player) && count($streamers) > 0)
<section class="section" style="padding: 1rem 1.5rem 3rem;">
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-10">
        <div class="title">
          <i class="fas fa-video"></i>
          Other streamers online
        </div>

      </div>
    </div>
    <div class="columns is-multiline" style="flex-wrap: nowrap;overflow-y: hidden;overflow-x: auto;">
      @foreach($streamers as $streamer)
        @component('components.player', [
          "player" => $streamer->player
        ])@endcomponent
      @endforeach
    </div>
  </div>
</section>
@endif


<section>
  <div class="container">
    <div class="h2">Recent News</div>
    @forelse($articles as $article)
      @component('components.news', ["article"=> $article])@endcomponent
    @empty
      <p class="m-0">Currently there is no news.</p>
    @endforelse
  </div>
</section>

<section>
  <div class="container">
    <div class="h2" id="about">About the Team</div>
    <p>ArmedGG is a growing team of gamers, streamers, and other creators. We try to find people from varying diversity.
    We accept all gamers whether they play FPS, RPG or the slow, casual playthroughs! Our goal is to reach as many people as viewers as possible. Check out the roster section and find a team for you!
    Because ArmedGG is more relaxed than most other gaming teams, gamers are free to stream or play whatever game they want. Sometimes, it's nice to try something different.
    However, if you are more of a competitive player, we have that too. ArmedGG is on the path to Professional ESports gaming but we will need your help before we can make any big steps. If you find a team that interested you don't hesitate to ask, we are looking to expand and pick up new players.
    If you would like to join please message our Twitter account to get started!</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="h2" id="how-to-join">How to Join</div>
    <p>To be apart of a team you must have an invite from a leader of Armed Gaming. You can contact a leader through the <a href="//twitter.com/armedgg">@armedgg</a> Twitter Account.</p>
  </div>
</section>


<script type="text/javascript">
  var $fs = document.getElementById('featured-stream')
  var $fsw = $fs.getBoundingClientRect().width
  $fs.style.height = ($fsw / 16 * 9) + 'px'
</script>
@endsection


@section('scripts')
@if(isset($player))
<script type="text/javascript">



      window.onload = function () {
        console.log('loaded');
        // setTimeout(function () {
          new Twitch.Embed("featured-stream", {
            width: "100%",
            height: $fsw / 16 * 9,
            channel: "{{$player->twitch}}",
            layout: "video",
            theme: "dark"
          });
        // }, 1000)
      }
      // $('#featured-stream').height($('#featured-stream').width() / 16 * 9)

</script>
@endif
@endsection
