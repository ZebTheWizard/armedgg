@extends('layouts.main-layout')

@section('content')
@if(isset($player))
<section class="section" style="background-color: #000; padding: 1rem 1.5rem 3rem;">
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-10">
        <div id="featured-stream" class="video"></div>
      </div>
    </div>
  </div>
</section>
@endif

<section class="section" style="padding: 1.5rem;">
  <div class="container" style="padding: 1.5rem 0;">
    <div class="is-blockquote has-background-info"></div>
    <div class="title">About the Team</div>
    <p>
      ArmedGG is a multi-gaming organzation that was established in 2019. The team's philosiphy is to push the limits  by persistently streaming and creating new content. ArmedGG would like to invite all players to become apart of a new generation of gaming.
    </p>
  </div>
</section>

<section class="section" style="padding: 1.5rem;">
  <div class="container" style="padding: 1.5rem 0;">
    <div class="is-blockquote has-background-info"></div>
    <div class="title">How to join</div>
    <p>
      In order to join a team you must have an invite from another player or you can message our twitter account @armedgg for an invite. Or better yet, you can become an alpha member by clicking here: <a href="https://armedgg.com/i/062fd516-5062-4f7b-aa43-0f5d714aa897" class="button is-primary is-small">Join Now</a>
    </p>
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
