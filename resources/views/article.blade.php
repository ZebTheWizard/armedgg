@extends('layouts.main-layout')

@section('content')


<section>
  <div class="container">
    <h4>{{ $article->title }}</h4>
    <p>
      <strong>By {{ $article->author->name }} </strong>
      <br>
      {{ $article->created_at->format('Y-m-d') }}
    </p>
    <img style="width: 100%; height: auto" src="{{ $article->image }}" alt="news-article">
    <p style="white-space: pre-wrap">{{ trim($article->text) }}</p>
  </div>
</section>


@endsection
