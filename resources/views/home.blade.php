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
    <div class="row">
      <div class="col-tablet-portrait-8 pr-4">
        <div class="h4 mb-4">Recent News</div>
        <hr>
        @forelse($articles as $article)
        @component('components.news', ["article"=> $article])@endcomponent
        @empty
        <p class="m-0">Currently there is no news.</p>
        @endforelse
      </div>
      <div class="col-tablet-portrait-4 pt-3">
          <a class="twitter-timeline" data-height="500" data-dnt="true" data-link-color="#19CF86" href="https://twitter.com/armedgg"></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
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
