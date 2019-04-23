@extends('layouts.dashboard')
@section('toolbar')
  <div class="h2 my-0 text-white">Account</div>
  <div class="">
    <!-- <label for="addrolemodal" class="btn btn-blue py-4" @click="setRole('', [])">Add Role</label> -->
  </div>
@endsection


@section('dashboard')


<section>
  <div class="container">

    <form class="mb-5" action="/dashboard/account/name" method="post" autocomplete="off">
      @csrf
      <div class="col mb-3">
        <label for="name" class="text mb-0 mt-3">Name</label>
        <div class="flex-cc">
          <input type="text" name="name" id="name" class="p-3"  placeholder="Name"  value="{{ $user->name }}" required>
          <button type="submit" class="btn btn-blue py-4 ml-4 px-5">Save</button>
        </div>
      </div>
    </form>
    <br>

    <form class="mb-5" action="/dashboard/account/email" method="post" autocomplete="off">
      @csrf
      <div class="col mb-3">
        <label for="name" class="text mb-0 mt-3">Email</label>
        <div class="flex-cc">
          <input type="email" name="email" id="email" class="p-3"  placeholder="Email"  value="{{ $user->email }}" required>
          <button type="submit" class="btn btn-blue py-4 ml-4 px-5">Save</button>
        </div>
      </div>
    </form>
    <br>

    <form class="mb-5" action="/dashboard/account/password" method="post" autocomplete="off">
      @csrf
      <div class="col mb-3">
        <label for="name" class="text mb-0 mt-3">Old Password
          @if (Session::get('oldpassword'))
            <strong class="text-red">Incorrect old password</strong>
          @elseif (Session::get('newpassword'))
            <strong class="text-blue">Password updated</strong>
          @endif
        </label>
        <input type="password" name="password_old" id="password_old" class="p-3"  placeholder="Password"  required>
        <label for="name" class="text mb-0 mt-3">Password</label>
        <input type="password" name="password" id="password" class="p-3"  placeholder="Password"  required>
        <label for="password_confirmation" class="text mb-0 mt-3">Confirm Password</label>
        <div class="flex-cc">
          <input type="password" name="password_confirmation" id="password_confirmation" class="p-3"  placeholder="Password"  required>
          <button type="submit" class="btn btn-blue py-4 ml-4 px-5">Save</button>
        </div>
      </div>
    </form>
    <br>

    <form action="/logout" class="mb-5" method="post">
      @csrf
      <button type="submit" class="btn btn-red">Logout</button>
    </form>

  </div>
</section>



@endsection