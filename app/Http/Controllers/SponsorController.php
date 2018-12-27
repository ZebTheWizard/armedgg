<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sponsor;

class SponsorController extends Controller
{
    public function publicview()
    {
      return view('sponsors', [
        "sponsors" => Sponsor::where('name', '!=', 'Sponsor Name')
          ->where('about', '!=', 'About the sponsor')
          ->orderby('name', 'asc')
          ->get()
      ]);
    }

    public function image(Request $r) {
      $sponsor = Sponsor::find($r->sponsor_id);
      $sponsor->image = upload_image($r, [
        "path" => "/sponsor_images",
        "width" => 150,
        "square" => true,
        "quality" => 60
      ]);
      $sponsor->save();
      return $sponsor->logo;
    }

    public function view($value='')
    {
      return view('dashboard.a.manage-sponsor');
    }

    public function fetch($value='')
    {
      $sponsors = Sponsor::get();
      return response()->json($sponsors);
    }

    public function edit(Sponsor $sponsor)
    {
      return view('dashboard.a.edit-sponsor')->with('sponsor', $sponsor);
    }

    public function create(Request $r)
    {
      $sponsor = Sponsor::create([
        "name" => "Sponsor Name",
        "about" => "About the sponsor"
      ]);
      return redirect('/dashboard/sponsor/edit/' . $sponsor->id);
    }

    public function update(Request $r)
    {
      $sponsor = Sponsor::findOrFail($r->id);
      $sponsor->name = $r->name;
      $sponsor->about = $r->about;
      $sponsor->url = $r->url;
      $sponsor->save();
      return back();
    }

    public function delete(Request $r)
    {
      $sponsor = Sponsor::findOrFail($r->id)->delete();
      return redirect('/dashboard/a/manage-sponsors');
    }
}
