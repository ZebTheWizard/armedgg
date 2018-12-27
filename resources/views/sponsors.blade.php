@extends('layouts.main-layout')

@section('content')

@foreach($sponsors as $sponsor)
<section class="section">
  <div class="container">
    <a href="{{ $sponsor->url }}" target="_blank">
      <article class="media box">
        @if($sponsor->image)
        <figure class="media-left">
          <p class="image is-128x128">
            <img src="{{ $sponsor->image }}">
          </p>
        </figure>
        @endif
        <div class="media-content">
          <div class="content">
            <div class="title">{{ $sponsor->name }}</div>
            <p>{{ $sponsor->about}}</p>
          </div>
        </div>
      </article>
    </a>


  </div>
</section>
@endforeach

@endsection
