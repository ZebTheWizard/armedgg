@extends('layouts.main-layout', ["includeNavigation" => false])

@section('content')

<section>
  <div class="container">

    <div class="h4">Login</div>
    <form action="{{ route('login') }}" method="post">
      @csrf
      <input type="hidden" name="redirect" value="{{ app('request')->input('redirect') }}">
      <div class="col mb-3">
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" class="p-3"  placeholder="Email"  value="{{ old('email') }}" required>
      </div>

      <div class="col mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="p-3"  placeholder="Password"  value="{{ old('password') }}" required>
      </div>

      <div class="col mb-3">
        <label for="remember" style="margin:0">
          <input class="d-inline" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="width:20px">
          Remember Me</label>
      </div>

      <button type="submit" class="btn btn-blue" name="submit">Login</button>
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
