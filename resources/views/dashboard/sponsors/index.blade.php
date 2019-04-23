@extends('layouts.dashboard')

@section('toolbar')
  <div class="h2 my-0 text-white">Sponsors</div>
  <div class="">
    <label for="addsponsormodal" class="btn btn-blue py-4" @click="setSponsor({ name: null, link: null, description:null })">Add Sponsor</label>
  </div>
@endsection

@section('dashboard')

<section>
  <div class="container">
    <table id="roles" class="mt-3">
      <thead>
        <tr>
          <th data-sort-default class="text-left">ID</th>
          <th class="text-left">Name</th>
          <th class="text-left">Link</th>
          <th class="text-left">Description</th>
          <th data-sort-method='none' class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sponsors as $sponsor)
        <tr>
          <td class="pl-3">{{ $sponsor->id }}</td>
          <td>{{ $sponsor->name }}</td>
          <td>{{ $sponsor->link }}</td>
          <td>{{ $sponsor->description }}</td>
          <td class="text-right pr-3">
              <label for="addsponsormodal" class="btn btn-blue py-3 px-4" @click="setSponsor({{$sponsor}})"><i class="fal fa-pencil"></i></label>
              <label for="deletemodal" class="btn btn-red py-3 px-4" @click="setDelete({{$sponsor->id}})"><i class="fal fa-times"></i></label>          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>

@component('components.delete', ["model" => "sponsors"])@endcomponent

<form action="/dashboard/sponsors/create" method="post" autocomplete="off" enctype="multipart/form-data">
  <input type="checkbox" class="modal-check" id="addsponsormodal">

  <div class="modal">
    <label for="addsponsormodal" class="modal-background"></label>
    <div class="modal-header bg-white container">
      <div class="flex-wrap flex-sbc py-3">
        <div class="h4 m-0">Create Sponsor</div>
        <button class="btn btn-blue py-4" type="submit" name="submit">Save Sponsor</button>
      </div>
    </div>
    <div class="modal-body bg-white container">
      <section class="pt-2">
        <div class="container" id="root">
          @csrf

          <div class="col mb-3">
            <label for="name">Name</label>
            <input class="input" type="text" name="name" id="name" :value="sponsor.name" placeholder="Name" required>
          </div>

          <div class="col mb-3">
            <label for="link">Link</label>
            <input class="input" type="text" name="link" id="link" :value="sponsor.link" placeholder="Link" required>
          </div>

          <div class="col mb-3">
            <label for="name">Brand Image</label>
            <input type="file" name="photo" id="photo" class="p-3" placeholder="Choose Image" required>
          </div>

          <div class="col mb-3">
            <label for="name">Description</label>
            <textarea class="input" name="description" id="description" rows="5" placeholder="Description" required>@{{sponsor.description}}</textarea>
          </div>

        </div>
      </section>
    </div>
  </div>
</form>

@endsection