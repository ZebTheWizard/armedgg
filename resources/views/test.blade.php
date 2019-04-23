@extends('layouts.main-layout', ["includeNavigation" => false])


@section('content')

<h1>{{ config('navigation.test') }}</h1>
<!-- <div class="dashboard"> -->
<ul class="navlinks">
  <li><a href="#">Link 1</a></li>
  <li><a href="#">Link 2</a></li>
  <li class="flyout"><a href="#">Link 3</a>
    <ul class="flyout-content navlinks stacked">
      <li><a href="#">Link 4</a></li>
      <li class="flyout-alt"><a href="#">Link 5</a>
        <ul class="flyout-content navlinks stacked">
          <li><a href="#">Link 7</a></li>
          <li><a href="#">Link 8</a></li>
          <li><a href="#">Link 9</a></li>
        </ul>
      </li>
      <li><a href="#">Link 6</a></li>
    </ul>
  </li>
</ul>

@endsection