@extends('layouts.dashboard')

@section('dashboard')

<dashboard-manager model="Invite"></dashboard-manager>
<div class="sectionloader is-active">
  <div class="has-text-centered" style="margin-top: 3rem">
    <div class="loader-grid has-background-dark"></div>
    <div class="is-size-5" style="margin-top: 0.5rem">Loading...</div>
  </div>
</div>
<invites></invites>


@endsection
