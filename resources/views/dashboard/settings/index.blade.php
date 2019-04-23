@extends('layouts.dashboard')

@section('toolbar')
  <div class="h2 my-0 text-white">Settings</div>
  <div class="">
    <label class="btn btn-blue py-4" @click="saveNavigation">Save</label>
  </div>
@endsection

@section('dashboard')

<section>
  <div class="container">

    <navigation-layout :available="{{ $availablelinks }}" :used="{{ $usedlinks }}"></navigation-layout>

  </div>
</section>

@endsection