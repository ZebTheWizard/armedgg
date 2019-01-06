<nav class="navbar is-white is-fixed-top" role="navigation" aria-label="main navigation">
  <div class="container">
    <div class="navbar-brand">
      <a class="navbar-item" href="/">
        <img src="/png/logo.png?v=1" alt="" width="50" height="50" style="max-height: 50px; margin-right: 0.5rem">
        <span class="is-size-4 has-text-weight-bold">{{ config('app.name', 'Laravel') }}</span>
      </a>

      <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" onclick="showNavbar()">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div class="navbar-end is-hidden-touch" id="navbarlinks">
      <a class="navbar-item" href="/">Home</a>
      <a class="navbar-item" href="/roster/all">Roster</a>
      <a class="navbar-item" href="/sponsors">Sponsors</a>
      <a class="navbar-item" href="/faq">FAQ</a>
    </div>
  </div>

</nav>
