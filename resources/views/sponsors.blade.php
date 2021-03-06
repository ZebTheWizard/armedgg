@extends('layouts.main-layout', ["includeNavigation" => false])
@section('content')


<section class="has-nav">
  @include('layouts.navbar')
  <div class="container">

        @forelse($sponsors as $sponsor)
          <!-- <div class="flex-ct">
            <div class="col-3">

            </div>
            <div class="col mx-3">
              <div class="flex-lc mb-3">
                <h5 class="my-0 mr-3">{{ $sponsor->name }}</h5>
                <a href="{{ $sponsor->link }}" class="btn btn-blue px-3 py-0">View Sponsor</a>
              </div>

              <p class="mt-0 mb-2">{{ $sponsor->description }}</p>

            </div>
          </div> -->
          <div class="row">
            <div class="col-tablet-portrait-2"><img src="{{ $sponsor->image }}"></div>
            <div class="col-tablet-portrait-10">
              <h3 class="my-0 mr-3">{{ $sponsor->name }}</h3>
              <a href="{{ $sponsor->link }}" class="btn btn-blue px-5 py-3">View Sponsor</a>
            </div>
            <!-- <div class="col-tablet-portrait-4"></div> -->
          </div>
          <div class="row">
            <p class="mt-0 mb-2">{{ $sponsor->description }}</p>
          </div>
        @empty
          <p class="m-0">Currently we have no sponsors. If you would like to be our sponsor, please contact us.</p>
        @endforelse


  </div>
</section>


@endsection
