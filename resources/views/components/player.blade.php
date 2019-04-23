
<div class="col-3 p-1">
  <div class="col-12 square bg-blue">
    <div class="content">
      @if($player->avatar)
        <img class="col-12 overlay" src="{{ $player->avatar }}" alt="" >
      @endif
    </div>
    <div class="content flex-lb">
      <div class="px-2 py-1 m-1 col-12 overlay">
        <div class="flex-sbc">
          <strong style="font-size:1.2rem;">{{ $player->name }}</strong>
          <img src="{{$player->country_flag}}" alt="flag" height="15">
        </div>

        <p class="m-0 py-1" style="font-size:0.9em;line-height:normal;">{{ $player->category->name }}</p>
        <div class="flex-lc fa-lg">
          <i class="fab fa-twitter mr-2"></i>
          <i class="fab fa-twitch mr-2"></i>
          <i class="fab fa-instagram mr-2"></i>
          <i class="fab fa-youtube mr-2"></i>
        </div>
      </div>

    </div>
  </div>


</div>
