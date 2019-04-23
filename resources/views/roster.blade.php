@extends('layouts.main-layout')
@section('content')


<section>
  <div class="container">
    <div class="h2">Roster</div>
    <?php $show = [] ?>
    @forelse($categories as $category)
      <?php $show[$category->name] = false ?>

      @foreach($players as $player)
        @if($player->category->hasAncestor($category->name) || $player->category->name == $category->name)
          <?php $show[$category->name] = true ?>
        @endif

      @endforeach

      @if($show[$category->name])
        <div class="h5 mb-0 mt-4">{{ $category->name }}</div>
      @endif

      @foreach($category->children as $child)
        <a href="/roster/{{$category->name}}/{{$child->name}}" class="btn btn-dark px-2 py-1">{{ $child->name }}</a>
      @endforeach
      <div class="flex-wrap mt-3" style="margin: 0 -0.25rem">
        @forelse($players as $player)
          @if($player->category->hasAncestor($category->name) || $player->category->name == $category->name)
            @include('components.player', $player)
          @endif
        @empty
          <p class="m-0">Looks like we need more players! Contact us to join.</p>
        @endforelse
      </div>
    @empty
      <p class="m-0">Looks like we need more players! Contact us to join.</p>
    @endforelse

  </div>
</section>



@endsection