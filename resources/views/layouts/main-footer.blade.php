<!-- <footer class="footer has-background-dark has-text-light"> -->
  <section class="section has-background-black">
    <div class="container has-text-centered">
      <div class="title has-text-light">Follow Armed.gg Everywhere!</div>
      <div class="has-text-centered">
        @foreach(config('socials.local') as $s)
        <a class="square social is-size-3" href="{{ $s['link'] }}" style="background: rgba(0,0,0,0); color: {{ $s['color'] }}">
          <div class="content" style="padding: 0.4rem;">
            <div class="social-background" id="{{ $s['name'] }}-social"></div>
            <i class="{{$s['icon']}}" style="z-index: 1"></i>
          </div>
        </a>
        @endforeach
      </div>
      <p class="has-text-light">
        <strong class="has-text-light">Armed.gg</strong> is created by <a href="https://twitter.com/wizardzeb" class="has-text-info">@wizardzeb</a>.
      </p>
    </div>
  </section>
<!-- </footer> -->


<!-- <script src="/js/app.js" charset="utf-8"></script> -->
