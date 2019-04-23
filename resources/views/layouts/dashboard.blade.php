@extends('layouts.main-layout', ["includeNavigation" => false])
@section('header')
<link rel="stylesheet" href="/css/dashboard.css">
<link rel="stylesheet" href="/css/tablesort.css">
@endsection

@section('content')

<!-- <div class="dashboard"> -->
<input type="checkbox" class="navcheck" id="navmenu" checked>
<div class="dashboard" id="dashboard">
  <div class="header flex-sbc bg-blue px-3">
    <label for="navmenu" class="mr-5 text-white"><i class="far fa-bars fa-2x"></i></label>
    @yield('toolbar')
  </div>
  <div class="nav-header flex-cc">
    <img src="/logo-white.png?v=1"class="my-3 mx-auto" style="max-width: 100%; height: auto;" width="65" id="logo">
  </div>
  <div class="nav pb-5">
    <p class="my-0 ml-4 mt-3 text-white">Me</p>
    <ul class="menu ml-3">
      <li class="item">
        <a class="link" href="/dashboard/account">Account</a>
      </li>
    </ul>

    @canany(['see site overview', 'manage site settings', 'create users'])
    <p class="my-0 ml-4 mt-3 text-white">Site</p>
    <ul class="menu ml-3">
      @can('see site overview')
        <li class="item">
          <a class="link" href="/dashboard/overview">Overview</a>
        </li>
      @endcan
      @can('manage site settings')
      <li class="item">
        <a class="link" href="/dashboard/settings">Settings</a>
      </li>
      @endcan
      @can('create users')
      <li class="item">
        <a class="link" href="/dashboard/users">Users</a>
      </li>
      @endcan
    </ul>
    @endcanany

    @canany(['edit categories', 'edit faq', 'edit news', 'edit players', 'edit roles', 'edit sponsors'])
    <p class="mb-0 ml-4 mt-5 text-white">Content</p>
    <ul class="menu ml-3">
      @can('edit categories')
        <li class="item">
          <a class="link" href="/dashboard/categories">Categories</a>
        </li>
      @endcan
      @can('edit faq')
        <li class="item">
          <a class="link" href="/dashboard/faq">FAQ</a>
        </li>
      @endcan
      @can('edit news')
        <li class="item">
          <a class="link" href="/dashboard/news">News</a>
        </li>
      @endcan
      @can('edit players')
        <li class="item">
          <a class="link" href="/dashboard/players">Players</a>
        </li>
      @endcan
      @role('admin')
        <li class="item">
          <a class="link" href="/dashboard/roles">Roles</a>
        </li>
      @endrole
      @can('edit sponsors')
        <li class="item">
          <a class="link" href="/dashboard/sponsors">Sponsors</a>
        </li>
      @endcan
    </ul>
    @endcanany
    
  </div>
  <div class="main text-white">
    @if ($errors->any())
        <div class="p-3 bg-red m-1">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('dashboard')
  </div>
  <!-- <div class="footer"></div> -->
</div>

@endsection

@section('scripts')
<script src="/js/tablesort/tablesort.min.js" charset="utf-8"></script>
<script src="/js/app.js" charset="utf-8"></script>
@yield('dashboard-scripts')
@endsection

