<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;

class FaqController extends Controller
{
    public function index() {
      $faqs = Faq::get();
      return view('dashboard.faq.index', [
        "faqs" => $faqs
      ]);
    }

    public function create(Request $r) {
      $faq = new Faq([
        "question" => $r->question,
        "answer" => $r->answer
      ]);
      $faq->save();
      return back();
    }
    public function publicview()
    {
      return view('faq', [
        "faqs" => Faq::get()
      ]);
    }

    public function delete(Request $r) {
      $Faq = Faq::find($r->id);
      $Faq->delete();
      return back();
    }

    // public function view($value='')
    // {
    //   return view('dashboard.a.manage-faq');
    // }

    // public function fetch($value='')
    // {
    //   $faqs = Faq::get();
    //   return response()->json($faqs);
    // }

    // public function edit(Faq $faq)
    // {
    //   return view('dashboard.a.edit-faq')->with('faq', $faq);
    // }

    // public function create(Request $r)
    // {
    //   $faq = Faq::create([
    //     "question" => "Frequently Asked Question",
    //     "answer" => "An answer",
    //     "rank" => 0
    //   ]);
    //   return redirect('/dashboard/faq/edit/' . $faq->id);
    // }

    // public function update(Request $r)
    // {
    //   $faq = Faq::findOrFail($r->id);
    //   $faq->question = $r->question;
    //   $faq->answer = $r->answer;
    //   $faq->save();
    //   return back();
    // }

    // public function delete(Request $r)
    // {
    //   $faq = Faq::findOrFail($r->id)->delete();
    //   return redirect('/dashboard/a/manage-faqs');
    // }
}
