@extends('layouts.main-layout')

@section('content')

@foreach($faqs as $faq)
<section class="section">
  <div class="container">
    <div class="title">{{$faq->question}}</div>
    <p>{{ $faq->answer }}</p>
  </div>
</section>
@endforeach

@endsection
