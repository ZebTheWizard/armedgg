@extends('layouts.main-layout', ["includeNavigation" => false])

@section('content')


<section id="featured" class="bg-black px-4 pb-5" style="min-height: 100vh; padding-top:60px">
    @include('layouts.navbar')
    <div class="flex-wrap pt-5" style="position:relative">
      <div class="col-tablet-portrait-8">
        <div id="featured-video" class="video"></div>
        

        <div class="col-12 flex-cc pt-3 text-white" id="video-info" style="display:none">
          <img id="video-avatar" class="mt-2" src="" width="50" height="50" alt="streamer-avatar" >
          <div class="flex-sbt ml-3" style="flex-grow: 1">
            <div class="text-white" style="font-size: 1em;line-height:1em;">
              <div class="h6 text m-0" id="video-title">...</div>
              <div id="video-user_name"></div>
            </div>
            <div class="h6 text m-0 flex-cc"><i class="fas fa-eye mr-2"></i> <span id="video-views"></span>  </div>
          </div>
        </div>

      </div>
      <div class="col-tablet-portrait-4 pl-5" style="position:relative; min-height:200px">
          <strong :class="['text-white', 'text-bold', 'mr-4', { semitransparent: selected != 'live'}]" @click="select('live')">Live</strong>
          <strong :class="['text-white', 'text-bold', { semitransparent: selected != 'videos'}]" @click="select('videos')">Videos</strong>

          @if(isset($streamers))
            <div class="pt-3" v-if="selected == 'live'">
              @foreach($streamers as $streamer)
                @php $stream = $streamer->stream; @endphp
                @if(isset($stream->title))
                <div class="mb-4 text-white flex-lc thumbnail" @click="twitch({{collect($stream)}},{{$streamer}})">
                    <img width="156" height="87" src="{{$streamer->stream->thumbnail}}" alt="stream-thumb">
                    <div class="pl-3" style="font-size: 0.8rem">
                      <strong class="mb-2" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">{{ $stream->title }}</strong>
                      <div>{{ $stream->user_name }}</div>
                      <strong>{{ number_format($stream->viewer_count) }}</strong>
                    </div>
                </div>
                @endif
              @endforeach
            </div>
          @endif

          @if(isset($ytvideos))
            <div class="mt-3" v-if="selected == 'videos'" style="position:absolute; height:100%; overflow-y:auto; overflow-x:hidden;">
              @foreach($ytvideos as $video)
                
                <div class="mb-4 text-white flex-lc thumbnail" @click="youtube({{$video}},{{$video->player}})">
                    <img width="160" height="90" src="{{$video->thumbnail}}" alt="stream-thumb">
                    <div class="pl-3" style="font-size: 0.8rem">
                      <strong class="mb-2" style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">{{ $video->title }}</strong>
                      <div>{{ $video->player->name }}</div>
                      <strong>{{ number_format($video->views) }}</strong>
                    </div>
                </div>
                
              @endforeach
            </div>
          @endif

        
        
      </div>
    </div>
    
</section>

{{-- @if(isset($player) && count($streamers) > 0)
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
@endif --}}


<section>
  {{-- <div class="container"> --}}
    <div class="px-4 flex-wrap">
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
    

  {{-- </div> --}}
</section>


<script src="/js/app.js" charset="utf-8"></script>

<script type="text/javascript">
  var $fs = document.getElementById('featured-video')
  var $fsw = $fs.getBoundingClientRect().width
  $fs.style.height = ($fsw / 16 * 9) + 'px'

</script>
@endsection


@section('scripts')

  <script type="text/javascript">

        window.onload = function () {
          @if(isset($streamers) && isset($streamers[0]->stream->title))
          featured.twitch({!! collect($streamers[0]->stream) !!},{!! $streamers[0] !!})
          @elseif(isset($streamers) && isset($streamers[count($streamers) - 1]->stream->title))
          featured.twitch({!! collect($streamers[1]->stream) !!},{!! $streamers[1] !!})
          @else
          featured.youtube({!!$ytvideos[0]!!},{!!$ytvideos[0]->player!!})
          @endif
        }
       

  </script>

@endsection
