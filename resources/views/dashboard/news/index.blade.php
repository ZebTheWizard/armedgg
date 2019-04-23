@extends('layouts.dashboard')

@section('toolbar')
  <div class="h2 my-0 text-white">News</div>
  <div class="">
    <label for="addnewsmodal" class="btn btn-blue py-4" @click="setNews({ title: null, text:null })">Add Article</label>
  </div>
@endsection

@section('dashboard')

<section>
  <div class="container">
    <table id="roles" class="mt-3">
      <thead>
        <tr>
          <th data-sort-default class="text-left">ID</th>
          <th class="text-left">Title</th>
          <th class="text-left">Views</th>
          <th class="text-left">Text</th>
          <th data-sort-method='none' class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($articles as $article)
        <tr>
          <td class="pl-3">{{ $article->id }}</td>
          <td>{{ $article->title }}</td>
          <td>{{ $article->views }}</td>
          <td>{{ substr($article->text, 0, 50) }}</td>
          <td class="text-right pr-3">
              <label for="addnewsmodal" class="btn btn-blue py-3 px-4" @click="setNews({{$article}})"><i class="fal fa-pencil"></i></label>
              <label for="deletemodal" class="btn btn-red py-3 px-4" @click="setDelete({{$article->id}})"><i class="fal fa-times"></i></label>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>

@component('components.delete', ["model" => "news"])@endcomponent

<form action="/dashboard/news/create" method="post" autocomplete="off" enctype="multipart/form-data">
  <input type="checkbox" class="modal-check" id="addnewsmodal">
  <div class="modal">
    <label for="addnewsmodal" class="modal-background"></label>
    <div class="modal-header bg-white container">
      <div class="flex-wrap flex-sbc py-3">
        <div class="h4 m-0">Create Article</div>
        <button class="btn btn-blue py-4" type="submit" name="submit">Save Article</button>
      </div>
    </div>
    <div class="modal-body bg-white container">
      <section class="pt-2">
        <div class="container" id="root">
          @csrf
          <input type="hidden" name="id" :value="news.id">
          <div class="col mb-3">
            <label for="title">Title</label>
            <input class="input" type="text" name="title" id="title" :value="news.title" placeholder="Title" required>
          </div>

          <div class="col mb-3">
            <label for="name">Article Image</label>
            <input type="file" name="photo" id="photo" class="p-3" placeholder="Choose Image">
          </div>

          <div class="col mb-3">
            <label for="text">Text</label>
            <textarea class="input" name="text" id="text" rows="5" placeholder="Text" required>@{{news.text}}</textarea>
          </div>

        </div>
      </section>
    </div>
  </div>
</form>



@endsection