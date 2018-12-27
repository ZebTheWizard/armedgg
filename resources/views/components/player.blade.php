<div class="column is-4" data-find='{{ $player->fname }} "{{ $player->nname }}" {{ $player->lname }}'>
  <div class="player-card" data-id="{{ $player->id }}">
    <div class="player-watermark"></div>
    <article class="media" style="">
      <figure class="media-left">
        <p class="image is-64x64">
          <img src="{{ $player->avatar }}" alt="{{ $player->nname }}-avatar">
        </p>
      </figure>
      <div class="media-content">
        <div class="content" style="margin-bottom: 0.5rem">
          <p>
            @if ($player->fname) {{ $player->fname }} @endif
            <strong>
              @if ($player->fname || $player->lname)"@endif{{ $player->nname }}@if ($player->fname || $player->lname)" @endif
            </strong>
            @if ($player->lname) {{ $player->lname }} @endif
          </p>
        </div>
        <nav class="level is-mobile">
          <div class="level-left">
            @foreach(config('socials.links') as $social => $link)
              @if($player->$social)
              <div class="level-item" style="margin-right: 0.2rem; font-size: 20px;">
                <a class="square social" href="{{ $link . $player->$social }}" style="width: 20px; background: rgba(0,0,0,0); color: {{ config('socials.colors.' . $social) }}">
                  <div class="content" style="padding: 0.4rem;">
                    <div class="social-background" id="{{$social}}-social"></div>
                    <i class="fab fa-{{$social}}" style="z-index: 1"></i>
                  </div>
                </a>
              </div>
              @endif
            @endforeach
            @if($player->othersocial)
              <div style="display: inline-block;border-right: 1px solid black;width: 0px;height: 20px;margin-right:0.2rem;"></div>
              @foreach(explode(", ", $player->othersocial) as $social)
                <div class="level-item" style="margin-right: 0.25rem">
                  <a class="square social" href="{{ $social }}" style="width: 16px; background: rgba(0,0,0,0);">
                    <div class="content">
                      <img src="https://api.faviconkit.com/{{ parse_url($social)['host'] }}/16" width="16" height="16">
                    </div>
                  </a>
                </div>
              @endforeach
            @endif
            <!-- <a class="level-item">
              <span class="icon is-small"><i class="fas fa-reply"></i></span>
            </a>
            <a class="level-item">
              <span class="icon is-small"><i class="fas fa-retweet"></i></span>
            </a>
            <a class="level-item">
              <span class="icon is-small"><i class="fas fa-heart"></i></span>
            </a> -->
          </div>
        </nav>
      </div>
    </article>
    @if(count($player->user->teams) > 0)
      <div style="display: flex;flex-wrap: wrap;">
        @foreach($player->user->teams as $team)
        <?php $color = useDarkText($team->color) ? '#363636' : 'white';?>
        <a href="/roster/team/{{ $team->id }}" class="tag" style="font-size: 0.6rem;background-color: {{ $team->color }}; border: 1px solid #363636; color: {{$color}}; margin:0.2rem 0.2rem 0 0;">
          {{ $team->name }}
        </a>
        @endforeach
      </div>

    @endif
  </div>

</div>
