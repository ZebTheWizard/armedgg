@extends('layouts.main-layout')

@section('content')
@if(isset($player) && count($streamers) > 0)
<section class="section" style="background-color: #000; padding: 1rem 1.5rem 3rem;">
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-10">
        <div class="title has-text-white">
          <i class="fas fa-trophy-alt"></i>
          Featured Streamer
        </div>
        <div id="featured-stream" class="video"></div>
      </div>
    </div>
  </div>
</section>
@else
<section class="section" style="background-color: #000; padding: 1rem 1.5rem 3rem;">
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-10">
        <div class="title has-text-white has-text-centered">
          <br><br>
          Currently, none of our players are live on twitch. Join ArmedGG to see your stream here.
          <br><br>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

@if(count($streamers) > 0)
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

<section class="section has-background-light" style="padding: 1.5rem;">
  <div class="container" style="padding: 1.5rem 0;">
    <div class="columns is-centered">
      <div class="column is-10">
        <div class="is-blockquote has-background-info"></div>
        <div class="title"><i class="fas fa-crown"></i>About the Team</div>
        <p class="is-size-5" style="line-height: 3rem; max-width: 800px;">
        ArmedGG is a growing team of gamers, streamers, and other creators. We try to find people from varying diversity.
        We accept all gamers whether they play FPS, RPG or the slow, casual playthroughs! Our goal is to reach as many people as viewers as possible. Check out the roster section and find a team for you!
        Because ArmedGG is more relaxed than most other gaming teams, gamers are free to stream or play whatever game they want. Sometimes, it's nice to try something different.
        However, if you are more of a competitive player, we have that too. ArmedGG is on the path to Professional ESports gaming but we will need your help before we can make any big steps. If you find a team that interested you don't hesitate to ask, we are looking to expand and pick up new players.
        If you would like to join please message our Twitter account to get started!
        </p>
      </div>
    </div>
  </div>
</section>
<br>
<section class="section has-background-light" style="padding: 1.5rem;">
  <div class="container" style="padding: 1.5rem 0;">
    <div class="columns is-centered">
      <div class="column is-10">
        <div class="is-blockquote has-background-info"></div>
        <div class="title"><i class="fas fa-question-circle"></i>How to join</div>
        <p class="is-size-5" style="line-height: 3rem; max-width: 800px;">
          In order to join a team you must have an invite from another player or you can message our twitter account @armedgg for an invite. Or better yet, you can become an alpha member by clicking here: <a href="https://armedgg.com/i/062fd516-5062-4f7b-aa43-0f5d714aa897" class="button is-primary">Join Now</a>
        </p>
      </div>
    </div>

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
