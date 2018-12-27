<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="has-navbar-fixed-top">
<head>
  <style media="screen">
  .is-loading {
    height: 100vh;
    overflow: hidden;
  }
  </style>
    @include('layouts.main-header')
</head>
<body >
    @include('layouts.navbar')
    <main id="app">
      <div class="" style="position: fixed; bottom: 0; right: 0; background: none; z-index: 10000; display: flex; align-items: center;">
        @if(Auth::check())
          @if(Auth::user()->player)
            <div class="dropup" style="margin: 1rem">
            <input type="checkbox" id="dashboard-dropup" class="handler">
            <div class="content has-background-white">
              <a href="/dashboard/player/edit" class="dropdown-item">
                Edit My Player
              </a>
              <!-- <a href="#" class="dropdown-item">
                Edit My Teams
              </a> -->
              @if (Auth::user()->player)
                <a href="/p/{{ Auth::user()->player->id }}" class="dropdown-item">
                  View Profile
                </a>
              @endif
              @if (Auth::user()->isAdmin)
              <hr class="dropdown-divider">
              <a href="/dashboard/faq/view" class="dropdown-item">
                Manage FAQ
              </a>
              <a href="/dashboard/sponsor/view" class="dropdown-item">
                Manage Sponsors
              </a>
              @endif
              @if (Auth::user()->isMod)
                <hr class="dropdown-divider">
                <a href="/dashboard/team/view" class="dropdown-item">
                  Manage Teams
                </a>
                <a href="/dashboard/invite/view" class="dropdown-item">
                  Invitations
                </a>
              @endif
              <hr class="dropdown-divider">
              <form class="is-marginless" action="/logout" method="post">
                @csrf
                <button type="submit" class="dropdown-item has-text-danger">
                  Logout
                </button>
              </form>

            </div>
            <label class="trigger" for="dashboard-dropup">
              <figure>
                <p class="image has-background-grey-lighter is-rounded" style="width: 40px">
                  <img src="{{ Auth::user()->player->avatar}}" class="is-rounded">
                </p>
              </figure>
            </label>
          </div>
          @else
            <a href="/dashboard" class="square has-text-dark" style="width: 50px; background: none;">
              <div class="content"><i class="fas fa-bolt is-size-4" style="color: red"></i></div>
            </a>
          @endif
        @else
          <a href="/dashboard" class="square has-text-dark" style="width: 50px; background: none;">
            <div class="content"><i class="fas fa-bolt is-size-4" style="color: gold"></i></div>
          </a>
        @endif
      </div>
      <!-- <div class="container" style="min-height: 100vh"> -->
        <!-- <div class="container-background has-text-light"></div> -->
        @yield('content')
      <!-- </div> -->
    </main>




    @include('layouts.main-footer')
    @yield('scripts')
</body>
</html>
