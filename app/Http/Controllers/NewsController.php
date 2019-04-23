<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NewsController extends Controller
{
    
    public function index()
    {
        return view('dashboard.news.index', [
            "articles" => News::get()
        ]);
    }

    public function create(Request $request) {
        $update = [
          "title" => $request->title,
          "text" => $request->text,
          "user_id" => Auth::id(),
          'slug' => Str::slug($request->title),
        ];
        if ($request->photo) {
          $update['image'] = upload_image($request, [
            "path" => "/news_images",
            "width" => 400,
            "height" => 225,
            "square" => false,
            "quality" => 60
          ]);
        }
    
        News::updateOrCreate([
          "title" => $request->old_title,
        ], $update);
    
        return back();
      }

    public function publicview(Request $r) {
        return view('news', [
            "articles" => News::where('title', 'like', "%{$r->q}%")
                            ->limit(10)
                            ->orderBy('created_at', 'desc')
                            ->get(),
            "query" => $r->q,
        ]);
    }

    public function articleview($slug){
        $article = News::where('slug', $slug)->first();
        $article->increment('views');
        return view('article', [
            "article" => $article,
        ]);
    }

    public function delete(Request $r) {
      $article = News::find($r->id);
      $article->delete();
      return back();
    }

}
