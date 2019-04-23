@extends('layouts.main-layout')

@section('content')

<section>
  <div class="container">
    <div class="row">
        @forelse($sponsors as $sponsor)
          <div class="col-3">
              <img src="{{ $sponsor->image }}">
          </div>
          <div class="col">
            <h5 class="mt-0 mb-3">{{ $sponsor->name }}</h5>
            <p>{{ $sponsor->description }}</p>
            <a href="{{ $sponsor->link }}" class="btn btn-dark">View</a>
          </div>
        @empty
          <p class="m-0">Currently we have no sponsors. If you would like to be our sponsor, please contact us.</p>
        @endforelse
    </div>
    
  </div>
</section>


@endsection
