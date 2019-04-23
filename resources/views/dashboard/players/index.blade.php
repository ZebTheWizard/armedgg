@extends('layouts.dashboard')
@section('toolbar')
  <div class="h2 my-0 text-white">Players</div>
  <div class="">
    <label for="addplayermodal" class="btn btn-blue py-4" @click="setPlayer()">Add Player</label>
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
          <th class="text-left">Category</th>
          <th data-sort-method='none' class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($players as $player)
        <tr>
          <td class="pl-3">{{ $player->id }}</td>
          <td>{{ $player->name }}</td>
          <td>{{ renderCategoryDesc($player->category) }}</td>
          <td class="text-right pr-3">
            <label for="addplayermodal" class="btn btn-blue py-3 px-4" @click="setPlayer({{ $player }})">
              <i class="fal fa-pencil"></i>
            </label>
            <label for="deletemodal" class="btn btn-red py-3 px-4" @click="setDelete({{$player->id}})"><i class="fal fa-times"></i></label>          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>

@component('components.delete', ["model" => "players"])@endcomponent

<form action="/dashboard/players/create" method="post" enctype="multipart/form-data" autocomplete="off">
<input type="checkbox" class="modal-check" id="addplayermodal">

<div class="modal" >

  <label for="addplayermodal" class="modal-background"></label>
  <div class="modal-header bg-white container">
    <div class="flex-wrap flex-sbc py-3">
      <div class="h4 m-0">Create Player</div>
      <button type="submit" class="btn btn-blue py-4" name="submit">Save Player</button>
    </div>
  </div>
  <div class="modal-body bg-white container">
      <section class="pt-2">
        <div class="container" id="root">

            @csrf
            <input type="hidden" name="country_flag" id="country_flag" :value="player.country_flag">

            <div class="col mb-3">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="p-3" :value="player.name" placeholder="Name"  required>
            </div>

            <div class="col mb-3">
                <label for="snippet">Additional information</label>
                <input type="text" name="snippet" id="snippet" class="p-3" :value="player.snippet" placeholder="Additional information">
              </div>

            <div class="col mb-3">
              <label for="name">Avatar</label>
              <input type="file" name="photo" id="photo" class="p-3" placeholder="Choose Avatar" required>
            </div>

            <div class="col mb-3">
              <label for=""> Category </label>
              @include('components.category', ["categories" => $categories, "name" => "category", "checkprop" => "id"])
            </div>

            <div class="autocomplete mb-3">
              <input name="country_name" :value="player.country_name" type="text" class="p-3 autocomplete" id="country_name" placeholder="Country" data-fetch="https://restcountries.eu/rest/v2/all" data-template="/tl/country" data-result="result" data-lpignore="true" required>
              <div class="autocomplete-results" id="result"></div>
            </div>

            <div class="flex-wrap">
              <div class="col-6 mb-3">
                <label for="">Instagram</label>
                <input class="p-3" type="text" name="instagram" :value="player.instagram" placeholder="Instagram">
              </div>

              <div class="col-6 mb-3">
                <label for="">Twitch</label>
                <input class="p-3" type="text" name="twitch" :value="player.twitch" placeholder="Twitch">
              </div>

              <div class="col-6 mb-3">
                <label for="">Twitter</label>
                <input class="p-3" type="text" name="twitter" :value="player.twitter" placeholder="Twitter">
              </div>

              <div class="col-6 mb-3">
                <label for="">YouTube</label>
                <input class="p-3" type="text" name="youtube" :value="player.youtube" placeholder="YouTube">
              </div>
            </div>



        </div>
      </section>
  </div>

</div>
  </form>

@endsection

@section('dashboard-scripts')
<script>
    function addcountry(el) {
      document.getElementById('country_flag').value = el.dataset.flag
      document.getElementById('country_name').value = el.dataset.name
      document.getElementById('result').innerHTML = null
    }

    autocomplete('country_name', function (e, target, json) {
        var j = []
        json.forEach(country => {
            var c = Object.assign({}, country)
            var match = c.name.toLowerCase().indexOf(target.value.toLowerCase()) !== -1
            if (match) {
                // c.name = c.name.split(new RegExp(target.value, 'i')).join('<span class="auto-complete-match"> ' + target.value + '</span>')
                j.push(c)
            }
        })
        j.sort((a,b) => {
            if (a.name < b.name)
                return -1;
            if (a.name > b.name)
                return 1;
            return 0;
        })
        return j.slice(0,10)
    })
</script>
@endsection