@extends('layouts.main-layout')

@section('content')

<section class="hero is-white is-fullheight">
  <!-- <div class="hero-body"> -->
    <div class="container" style="padding-top: 2rem">
      <div class="title">
        Register
        @if(isset($invite))
        | <a href="/login" class="has-text-info">Login</a>
        @endif
      </div>
      <form method="post" action="{{ isset($invite) ? '/i/createuser' : route('register') }}">
        @csrf
        @if(isset($invite))
          <input type="hidden" name="id" value="{{ $invite->id }}">
          <input type="hidden" name="nonce" value="{{ $invite->nonce }}">
        @endif
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
          <label for="password_confirmation" class="label">Password</label>
          <div class="control">
            <input id="password_confirmation"
                   name="password_confirmation"
                   class="input form-control{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}"
                   type="password"
                   placeholder="Match secure password"
                   required>
          </div>
          @if ($errors->has('password_confirmation'))
              <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
          @endif
        </div>

        <button type="submit" class="button is-medium is-info" name="submit">Register</button>
      </form>
    </div>
  <!-- </div> -->
</section>

@endsection
