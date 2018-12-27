@extends('layouts.main-layout')

@section('content')


<section class="hero is-white is-fullheight">
  <!-- <div class="hero-body"> -->
    <div class="container" style="padding-top: 2rem">
      <div class="title">
        Login
      </div>
      <form method="post" action="{{ route('login') }}">
        @csrf

        <div class="field">
          <label for="email" class="label">Email Address</label>
          <div class="control">
            <input id="email"
                   name="email"
                   class="input form-control{{ $errors->has('email') ? ' is-danger' : '' }}"
                   type="email"
                   placeholder="Email Address"
                   value="{{ old('email') }}"
                   required>
          </div>
          @if ($errors->has('email'))
              <p class="help is-danger">{{ $errors->first('email') }}</p>
          @endif
        </div>

        <div class="field">
          <label for="password" class="label">Password</label>
          <div class="control">
            <input id="password"
                   name="password"
                   class="input form-control{{ $errors->has('password') ? ' is-danger' : '' }}"
                   type="password"
                   placeholder="Secure password"
                   value="{{ old('password') }}"
                   required>
          </div>
          @if ($errors->has('password'))
              <p class="help is-danger">{{ $errors->first('password') }}</p>
          @endif
        </div>

        <div class="field">
          <input class="is-checkradio is-info" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <label for="remember" style="margin:0">Remember Me</label>
        </div>
        <button type="submit" class="button is-medium is-info" name="submit">Login</button>
      </form>
    </div>
  <!-- </div> -->
</section>

@endsection
