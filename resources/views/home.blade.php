@extends('layouts.main-layout', ["includeNavigation" => false])

@section('content')


<section id="featured" class="bg-black px-4 pb-5 pt-1 has-nav">
    @include('layouts.navbar')
    <div class="video-section">
      <!-- <div class="col-tablet-portrait-8 mb-3"> -->
      <div class="">
        <div id="featured-video" class="video"></div>

        <div class="col-12 flex-cc pt-3 text-white hide" id="video-info">
          <img id="video-avatar" class="mt-2" src="" width="50" height="50" alt="streamer-avatar" >
          <div class="col flex-sbt ml-3"xw>
            <div class="text-white text-reset">
              <a href="" class="h6 text text-white m-0 d-block" id="video-title">...</a>
              <a href="" class="text-white d-block text-reset" id="video-user_name"></a>
            </div>
            <div class="h6 text m-0 flex-cc"><i class="fas fa-eye mr-2"></i> <span id="video-views"></span>  </div>
          </div>
        </div>
      </div>


      <!-- </div> -->

      <div class="videos">
        <div class="mb-3">
          <button class="btn btn-white text-dark py-1 px-3 mr-2" :class="[{ semitransparent: selected != 'live'}]" @click="select('live')">Live</button>
          <button class="btn btn-white text-dark py-1 px-3 mr-2" :class="[{ semitransparent: selected != 'videos'}]" @click="select('videos')">Videos</button>
        </div>
        <div class="overflow-y-onhover" style="max-height:100vh" v-show="selected == 'live'">
          @if(isset($streamers))
              @foreach($streamers as $streamer)
                @php $stream = $streamer->stream; @endphp
                @if(isset($stream->title))
                  <div id="twitch-{{$streamer->twitch_id}}" class="mb-4 flex-lt thumbnail" @click="twitch({{collect($stream)}},{{$streamer}})">
                      <img width="156" height="87" src="{{$streamer->stream->thumbnail}}" alt="stream-thumb">
                      <div class="pl-3 text-small">
                        <strong class="mb-2 clamp-2">{{ $stream->title }}</strong>
                        <div>{{ $stream->user_name }}</div>
                        <strong id="thumbnail-views-{{$streamer->twitch_id}}">{{ number_format($stream->viewer_count) }}</strong>
                        <span class="ml-1">watching</span>
                      </div>
                  </div>
                @endif
              @endforeach
          @endif
        </div>
        <div class="overflow-y-onhover" style="max-height:100vh" v-show="selected == 'videos'">
          @if(isset($ytvideos))
              @foreach($ytvideos as $video)

                <div id="youtube-{{$video->id}}" class="mb-4 text-white flex-lt thumbnail" @click="youtube({{$video}},{{$video->player}})" >
                    <img width="160" height="90" src="https://i.ytimg.com/vi/{{$video->id}}/mqdefault.jpg" alt="stream-thumb">
                    <div class="pl-3 text-small">
                      <strong class="mb-2 clamp-2 overflow-none">{{ $video->title }}</strong>
                      <div>{{ $video->player->name }}</div>
                      <strong>{{ number_format($video->views) }}</strong>
                      <span class="ml-1">views</span>
                    </div>
                </div>

              @endforeach
          @endif
        </div>
      </div>
    </div>

</section>


<section>
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

        ready(function () {
          @if(isset($streamers))
            @if(isset($streamers[0]->stream->title))
            featured.twitch({!! collect($streamers[0]->stream) !!},{!! $streamers[0] !!})
            @elseif(isset($streamers[count($streamers) - 1]->stream->title))
            featured.twitch({!! collect($streamers[1]->stream) !!},{!! $streamers[1] !!})
            @else
            featured.youtube({!!$ytvideos[0]!!},{!!$ytvideos[0]->player!!})
            @endif
          @else
          featured.youtube({!!$ytvideos[0]!!},{!!$ytvideos[0]->player!!})
          @endif
        })


  </script>

@endsection
