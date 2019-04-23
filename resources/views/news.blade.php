@extends('layouts.main-layout')

@section('content')


<section>

  <div class="container">
      <div class="col-12 mt-3">
        <form action="/news" method="get" autocomplete="off">
            <input style="font-size:1.3rem" name="q" value="{{ $query }}" type="text" class="input" id="news_search" placeholder="Search news..." data-fetch="/news?json=true" data-template="/tl/news-search" data-result="result">
        </form>
      </div>
    </div>

  <div class="container">
      @forelse($articles as $article)
        @component('components.news', ["article"=> $article])@endcomponent
      @empty
        <p class="m-0">Currently there is no news.</p>
      @endforelse
  </div>
</section>


@endsection
