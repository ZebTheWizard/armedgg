<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-dark">
<head>
    @include('layouts.main-header')
</head>
<body style="margin: 0px">
    @if(!isset($includeNavigation))
      @include('layouts.navbar')
    @endif

    @yield('content')
    @if(!isset($includeFooter))
      @include('layouts.main-footer')
    @endif
    
    
    <script src="/js/main.js" charset="utf-8"></script>
    @yield('scripts')
    
</body>
</html>
