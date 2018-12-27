@extends('layouts.dashboard')

@section('dashboard')

<div class="level">
  <div class="level-left">
    <div class="title">Editing Team</div>
  </div>
  <div class="level-right">
    @if(Auth::user()->isAdmin)
      <form class="is-marginless" action="/dashboard/team/create" method="post">
        @csrf
        <button type="submit" class="button is-info">
          Create Team <i class="fas fa-plus" style="margin-left: 0.5rem;"></i>
        </button>
      </form>
    @endif
  </div>
</div>


<form action="/dashboard/team/update" method="post">
  @csrf
  <input type="hidden" name="id" value="{{ $team->id }}">
  <div class="columns is-vcentered">
    <div class="column">
      <div class="field">
        <label for="name" class="label">Team Name</label>
        <div class="control">
          <input id="name"
                 name="name"
                 class="input form-control{{ $errors->has('name') ? ' is-danger' : '' }}"
                 type="text"
                 placeholder="Text Input"
                 value="{{ old('name') ? old('name') : $team->name }}"
                 required>
        </div>
        @if ($errors->has('name'))
            <p class="help is-danger">{{ $errors->first('name') }}</p>
        @endif
      </div>

      <div class="field">
        <label for="color" class="label">Team Color</label>
        <div class="control">
          <input id="color"
                 name="color"
                 class="input form-control{{ $errors->has('color') ? ' is-danger' : '' }}"
                 type="color"
                 placeholder="Hex Color (ex: #ff0000)"
                 value="{{ old('color') ? old('color') : $team->color }}"
                 required>
        </div>
        @if ($errors->has('color'))
            <p class="help is-danger">{{ $errors->first('color') }}</p>
        @endif
      </div>

      <div class="field">
        <label for="overview" class="label">About</label>
        <div class="control">
          <textarea id="overview"
            name="overview"
            rows="5"
            cols="80"
            class="textarea form-control{{ $errors->has('overview') ? ' is-danger' : '' }}"
            placeholder="A little something about the team..."
            required>{{ old('overview') ? old('overview') : $team->overview }}</textarea>
        </div>
        @if ($errors->has('overview'))
            <p class="help is-danger">{{ $errors->first('overview') }}</p>
        @endif
      </div>
    </div>
    <div class="column is-3">
      <div class="field">
        <label class="label">Logo <span class="has-text-danger"></span></label>
        <avatar-upload src="{{ $team->logo }}" url="/dashboard/team/logo" label="Upload Logo" :data="{ team_id: '{{ $team->id }}'}"></avatar-upload>
      </div>
    </div>
  </div>






    <button style="margin-top:1.5rem" type="submit" class="button is-medium is-info" name="submit">Update!</button>
  </div>
</form>

@endsection
