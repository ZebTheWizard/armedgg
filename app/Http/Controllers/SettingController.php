<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Config;
use App\Navigation;

class SettingController extends Controller
{
    public function index () {
      return view('dashboard.settings.index')->with([
        "availablelinks" => collect($this->getLinks()["available"]),
        "usedlinks" => collect($this->getLinks()["used"]),
      ]);
    }

    private function getLinks () {
      $nav = Navigation::fetch();
      $used = pluck_r("name", $nav->used);
      $available = pluck_r("name", $nav->available);

      $newCategories = Category::get()->map(function ($cat) use($used, $available) {

        if($cat->parent) $link = "/roster/" . $cat->parent->name . "/" . $cat->name;
        else $link = "/roster/" . $cat->name;

        $res = [
          "name" => $cat->name,
          "desc" => renderCategoryDesc($cat),
          "link" => $link,
          "list" => [],
        ];
        if (!collect(array_merge($used, $available))->contains($res['name'])) {
          return $res;
        }
      })->filter(function ($item) {
        return !empty($item);
      })->toArray();

      $nav->available = array_merge($nav->available, $newCategories);
      $nav->save();

      // return array_merge($nav->available, $newCategories);
      return $nav;
    }

    public function getLinksJSON() {
      // $nav = Navigation::fetch();
      return response()->json($this->getLinks());
      // Config::set("navigation.test", "fdsa");
      // $res = config('navigation.test');
      // return view('test');
    }

    public function saveNavigation (Request $request) {
      // dd();
      $nav = Navigation::fetch();
      $nav->used = $request->used;
      $nav->available = $request->available;
      $nav->save();
      return response()->json($request->all());
    }
}
