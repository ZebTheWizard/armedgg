<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index() {
      return view('dashboard.categories.index')->with([
        "categories" => Category::get(),
        "categoriesForChoosing" => Category::whereNull('parent_id')->get()
      ]);
    }

    public function create(Request $request) {
      $category = Category::firstOrCreate([
        "name" => $request->name
      ]);
      $category->parent_id = $request->parent_id;
      $category->save();
      $category->path = renderCategoryDesc($category);
      $category->save();
      return back();
    }

    public function delete(Request $r) {
      try {
        $Category = Category::find($r->id);
        $Category->delete();
      } 
      catch (\Exception $e) {}
      finally {
        return back();
      }
    }
}
