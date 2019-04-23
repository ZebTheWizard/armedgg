@extends('layouts.dashboard')

@section('toolbar')
  <div class="h2 my-0 text-white">FAQ</div>
  <div class="">
    <label for="addfaqmodal" class="btn btn-blue py-4" @click="setFaq({answer: null, question: null})">Add FAQ</label>
  </div>
@endsection

@section('dashboard')

<section>
  <div class="container">
    <table id="roles" class="mt-3">
      <thead>
        <tr>
          <th data-sort-default class="text-left">ID</th>
          <th class="text-left">Question</th>
          <th class="text-left">Answer</th>
          <th data-sort-method='none' class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($faqs as $faq)
        <tr>
          <td class="pl-3">{{ $faq->id }}</td>
          <td>{{ $faq->question }}</td>
          <td>{{ $faq->answer }}</td>
          <td class="text-right pr-3">
              <label for="addfaqmodal" class="btn btn-blue py-3 px-4" @click="setFaq({{$faq}})"><i class="fal fa-pencil"></i></label>
              <label for="deletemodal" class="btn btn-red py-3 px-4" @click="setDelete({{$faq->id}})"><i class="fal fa-times"></i></label>          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>

@component('components.delete', ["model" => "faq"])@endcomponent

<form action="/dashboard/faq/create" method="post" autocomplete="off">
  <input type="checkbox" class="modal-check" id="addfaqmodal">

  <div class="modal">
    <label for="addfaqmodal" class="modal-background"></label>
    <div class="modal-header bg-white container">
      <div class="flex-wrap flex-sbc py-3">
        <div class="h4 m-0">Create FAQ</div>
        <button class="btn btn-blue py-4" type="submit" name="submit">Save FAQ</button>
      </div>
    </div>
    <div class="modal-body bg-white container">
      <section class="pt-2">
        <div class="container" id="root">
          @csrf

          <div class="col mb-3">
            <label for="name">Question</label>
            <input class="input" type="text" name="question" id="question" :value="faq.question" placeholder="Question"  required>
          </div>

          <div class="col mb-3">
            <label for="name">Answer</label>
            <textarea class="input" name="answer" id="answer" rows="5" placeholder="Answer" required>@{{faq.answer}}</textarea>
          </div>

        </div>
      </section>
    </div>
  </div>
</form>

@endsection