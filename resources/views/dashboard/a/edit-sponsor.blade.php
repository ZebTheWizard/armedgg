@extends('layouts.dashboard')

@section('dashboard')

<div class="level">
  <div class="level-left">
    <div class="title">Editing Sponsor</div>
  </div>
  <div class="level-right">
    @if(Auth::user()->isAdmin)
      <form class="is-marginless" action="/dashboard/sponsor/create" method="post">
        @csrf
        <button type="submit" class="button is-info">
          Create Sponsor <i class="fas fa-plus" style="margin-left: 0.5rem;"></i>
        </button>
      </form>
    @endif
  </div>
</div>


<form action="/dashboard/sponsor/update" method="post">
  @csrf
  <input type="hidden" name="id" value="{{ $sponsor->id }}">
  <div class="columns is-vcentered">
    <div class="column">
      <div class="field">
        <label for="name" class="label">Sponsor Name</label>
        <div class="control">
          <input id="name"
                 name="name"
                 class="input form-control{{ $errors->has('name') ? ' is-danger' : '' }}"
                 type="text"
                 placeholder="Text Input"
                 value="{{ old('name') ? old('name') : $sponsor->name }}"
                 required>
        </div>
        @if ($errors->has('name'))
            <p class="help is-danger">{{ $errors->first('name') }}</p>
        @endif
      </div>



      <div class="field">
        <label for="about" class="label">Sponsor About</label>
        <div class="control">
          <textarea id="about"
            name="about"
            rows="5"
            cols="80"
            class="textarea form-control{{ $errors->has('about') ? ' is-danger' : '' }}"
            placeholder="Tell me about the sponsor. Try to sell the product..."
            required>{{ old('about') ? old('about') : $sponsor->about }}</textarea>
        </div>
        @if ($errors->has('about'))
            <p class="help is-danger">{{ $errors->first('about') }}</p>
        @endif
      </div>

      <div class="field">
        <label for="url" class="label">Sponsor Url</label>
        <div class="control">
          <input id="url"
                 name="url"
                 class="input form-control{{ $errors->has('url') ? ' is-danger' : '' }}"
                 type="text"
                 placeholder="Url Input"
                 value="{{ old('url') ? old('url') : $sponsor->url }}"
                 required>
        </div>
        @if ($errors->has('name'))
            <p class="help is-danger">{{ $errors->first('name') }}</p>
        @endif
      </div>


    </div>
    <div class="column is-3">
      <div class="field">
        <label class="label">Sponsor Image <span class="has-text-danger"></span></label>
        <avatar-upload src="{{ $sponsor->image }}" url="/dashboard/sponsor/image" label="Upload Image" :data="{ sponsor_id: '{{ $sponsor->id }}'}"></avatar-upload>
      </div>
    </div>
  </div>






    <button style="margin-top:1.5rem" type="submit" class="button is-medium is-info" name="submit">Update!</button>
  </div>
</form>


@endsection
