@extends('layouts.main-layout')

@section('content')
@if(isset($player))
<section class="section" style="background-color: #000; padding: 1rem 1.5rem 3rem;">
  <div class="container">
        <div id="featured-stream" class="video"></div>
    </div>
  </div>
</section>
@endif

<section class="section" style="padding: 1.5rem;">
  <div class="container" style="padding: 1.5rem 0;">
    <div class="is-blockquote has-background-info"></div>
    <div class="title">About the Team</div>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </div>
</section>

<section class="section" style="padding: 1.5rem;">
  <div class="container" style="padding: 1.5rem 0;">
    <div class="is-blockquote has-background-info"></div>
    <div class="title">How to join</div>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
