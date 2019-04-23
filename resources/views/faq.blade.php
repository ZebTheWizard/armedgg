@extends('layouts.main-layout')

@section('content')


<section>
  <div class="container">
    @foreach($faqs as $faq)
      <h4>{{ $faq->question }}</h4>
      <p>{{ $faq->answer }}</p>
    @endforeach
  </div>
</section>


@endsection
