@extends('layouts.main-layout', ["includeNavigation" => false])

@section('content')

<section>
  <div class="container">

    <div class="h4">Register</div>
    <form action="{{ route('register') }}" method="post">
      @csrf
      @if(isset($invite))
        <input type="hidden" name="id" value="{{ $invite->id }}">
        <input type="hidden" name="nonce" value="{{ $invite->nonce }}">
      @endif
      <div class="col mb-3">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="p-3"  placeholder="Name"  value="{{ old('name') }}" required>
      </div>

      <div class="col mb-3">
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" class="p-3"  placeholder="Email"  value="{{ old('email') }}" required>
      </div>

      <div class="col mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="p-3"  placeholder="Password"  value="{{ old('password') }}" required>
      </div>

      <div class="col mb-3">
        <label for="password">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="p-3"  placeholder="Password"  value="{{ old('password_confirmation') }}" required>
      </div>

      <div class="col mb-3">
        <label for="remember" style="margin:0">
          <input class="d-inline" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="width:20px">
          Remember Me</label>
      </div>

      <button type="submit" class="btn btn-blue" name="submit">Register</button>
    </form>
  </div>
</section>

@if ($errors->any())
    <div class="p-3 bg-red m-1">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@endsection
