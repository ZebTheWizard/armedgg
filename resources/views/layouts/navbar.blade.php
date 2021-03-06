<?php

  function renderNav($config) {
    $res = "<ul class='navlinks m-0'>";
    foreach($config as $item) {
      $res .= item($item['link'], $item['name'], $item['list']);
    }
    $res .= "</ul>";
    return $res;
  }

  function renderNavMobile($config) {
    $res = "<ul class='navlinks m-0'>";
    foreach($config as $item) {
      $res .= itemMobile($item['link'], $item['name'], $item['list']);
    }
    $res .= "</ul>";
    return $res;
  }

  function item($link, $name, $list=[], $type="") {
    if (count($list) > 0) {
      $res = "<li class='flyout$type'>";
    } else {
      $res = "<li>";
    }

    $res .= navlink($link, $name);
    if (count($list) > 0) {
      $res .= "<ul class='flyout-content navlinks stacked'>";
    }
    foreach($list as $item) {
      $res .= item($item['link'], $item['name'], $item['list'], '-alt');
    }
    if (count($list) > 0) {
      $res .= "</ul>";
    }
    $res .= "<li>";
    return $res;
  }

  function itemMobile($link, $name, $list) {
    $res = navlink($link, $name);
    if (count($list) > 0) {
      foreach($list as $item) {
        $res .= itemMobile($item['link'], $item['name'], $item['list']);
      }
    }
    return $res;
  }

  function navlink($link, $name) {
    return "<a href='$link' class='d-block' style='font-size:1em;font-weight:normal'>$name</a>";
  }

?>

<nav class="fixed bg-black text-white" >
    <!-- <div id="read-progress"></div> -->
    <div class="px-4">
      <div class="row">
        <div class="col-5 flex-lc show-gt-tablet-portrait">

          {!! renderNav(\App\Navigation::fetch()->used) !!}


        </div>
        <div class="col-tablet-2 col-3 flex-cc flex-cc">
          <a href="/"><img src="/logo-white.png?v=1"class="mx-auto" style="max-width: 100%; height: auto;" width="60" id="logo"></a>
        </div>
        <div class="col flex-rc">
          @foreach(config('socials.local') as $social)
          <a href="{{ $social['link'] }}" class="px-2"><i class="{{ $social['icon'] }}" style="font-size:1em;font-weight:normal"></i></a>
          @endforeach

          <label for="navmenu" class="show-lt-tablet-landscape parent ml-3"><i class="far fa-bars fa-large"></i>
            <input type="checkbox" class="navcheck" id="navmenu">
            <div class="dropnav dropnav-small bg-black">
                {!! renderNavMobile(\App\Navigation::fetch()->used) !!}

            </div>
          </label>
        </div>
      </div>
    </div>

  </nav>