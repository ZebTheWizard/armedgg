@extends('layouts.dashboard')

@section('dashboard')

<dashboard-manager model="Team" hasbutton></dashboard-manager>
<teams></teams>
<div class="sectionloader is-active">
  <div class="has-text-centered" style="margin-top: 3rem">
    <div class="loader-grid has-background-dark"></div>
    <div class="is-size-5" style="margin-top: 0.5rem">Loading...</div>
  </div>
</div>


@endsection
