@extends('layouts.dashboard')

@section('dashboard')

<div class="level">
  <div class="level-left">
    <div class="title">My Player</div>
  </div>
  <div class="level-right">
    @if ($player->id)
      <a href="/p/{{ $player->id }}" class="button is-info">
        View Profile
      </a>
    @endif
  </div>
</div>
@if(!Auth::user()->player)
  <div class="has-text-danger">
    To appear on any roster you must fill out this form.
  </div>
@endif

<div class="sectionloader is-active">
  <div class="has-text-centered" style="margin-top: 3rem">
    <div class="loader-grid has-background-dark"></div>
    <div class="is-size-5" style="margin-top: 0.5rem">Loading...</div>
  </div>
</div>
<section class="hero is-white is-fullheight">
  <!-- <div class="hero-body"> -->
    <div style="padding-top: 2rem">
      <form method="post" action="/dashboard/player/update">
        @csrf


        <div class="columns is-vcentered">

          <div class="column">
            <div class="field">
              <label for="fname" class="label">First Name (optional)</label>
              <div class="control">
                <input id="fname"
                       name="fname"
                       class="input form-control{{ $errors->has('fname') ? ' is-danger' : '' }}"
                       type="text"
                       placeholder="Text Input"
                       value="{{ old('fname') ? old('fname') : $player->fname }}">
              </div>
              @if ($errors->has('fname'))
                  <p class="help is-danger">{{ $errors->first('fname') }}</p>
              @endif
            </div>

            <div class="field">
              <label for="lname" class="label">Last Name (optional)</label>
              <div class="control">
                <input id="lname"
                       name="lname"
                       class="input form-control{{ $errors->has('lname') ? ' is-danger' : '' }}"
                       type="text"
                       placeholder="Text Input"
                       value="{{ old('lname') ? old('lname') : $player->lname }}">
              </div>
              @if ($errors->has('lname'))
                  <p class="help is-danger">{{ $errors->first('lname') }}</p>
              @endif
            </div>

            <div class="field">
              <label for="nname" class="label">Nick Name <span class="has-text-danger">(required)</span></label>
              <div class="control">
                <input id="nname"
                       name="nname"
                       class="input form-control{{ $errors->has('nname') ? ' is-danger' : '' }}"
                       type="text"
                       placeholder="Text Input"
                       value="{{ old('nname') ? old('nname') : $player->nname }}">
              </div>
              @if ($errors->has('nname'))
                  <p class="help is-danger">{{ $errors->first('nname') }}</p>
              @endif
            </div>

            <div class="field">
              <label for="about" class="label">About (optional)</label>
              <div class="control">
                <textarea id="about"
                  name="about"
                  rows="5"
                  cols="80"
                  class="textarea form-control{{ $errors->has('about') ? ' is-danger' : '' }}"
                  placeholder="A little something about you...">{{ old('about') ? old('about') : $player->about }}</textarea>
              </div>
              @if ($errors->has('about'))
                  <p class="help is-danger">{{ $errors->first('about') }}</p>
              @endif
            </div>

          </div>
          <div class="column is-3">
            <div class="field">
              <label class="label">Avatar <span class="has-text-danger">(required)</span></label>
              <avatar-upload src="{{ $player->avatar }}" url="/dashboard/player/avatar"></avatar-upload>
            </div>
          </div>
        </div>

        <hr>
        <div class="columns is-multiline">
          <div class="column is-4">
            <prepend name="youtube_url"
                    original="youtube"
                    type="text"
                    value="{{ old('youtube') ? old('youtube') : $player->youtube }}"
                    placeholder="Channel ID"
                    error="{{ $errors->has('youtube_url') }}"
                    prepend="https://www.youtube.com/feeds/videos.xml?channel_id="
                    label="YouTube Channel ID (optional)">
                  <p class="help is-danger">Invalid YouTube channel_id.
                    <a href="https://www.youtube.com/account_advanced" class="has-text-link">Click here to find it.</a>
                  </p>
            </prepend>
          </div>
          <div class="column is-4">
            <prepend name="twitter_url"
                    original="twitter"
                    type="text"
                    value="{{ old('twitter') ? old('twitter') : $player->twitter }}"
                    placeholder="Username"
                    error="{{ $errors->has('twitter_url') }}"
                    prepend="https://twitter.com/"
                    label="Twitter Username (optional)">
                  <p class="help is-danger">Invalid Twitter username.</p>
            </prepend>
          </div>
          <div class="column is-4">
            <prepend name="twitch_url"
                    original="twitch"
                    type="text"
                    value="{{ old('twitch') ? old('twitch') : $player->twitch }}"
                    placeholder="Channel"
                    error="{{ $errors->has('twitch_url') }}"
                    prepend="https://twitchrss.appspot.com/vod/"
                    label="Twitch Channel (optional)">
                  <p class="help is-danger">Invalid Twitch channel.</p>
            </prepend>
          </div>
          <div class="column is-4">
            <prepend name="instagram_url"
                    original="instagram"
                    type="text"
                    value="{{ old('instagram') ? old('instagram') : $player->instagram }}"
                    placeholder="Username"
                    error="{{ $errors->has('instagram_url') }}"
                    prepend="https://instagram.com/"
                    label="Instagram Username (optional)">
                  <p class="help is-danger">Invalid Instagram account.</p>
            </prepend>
          </div>
          <div class="column is-4">
            <prepend name="facebook_url"
                    original="facebook"
                    type="text"
                    value="{{ old('facebook') ? old('facebook') : $player->facebook }}"
                    placeholder="Username"
                    error="{{ $errors->has('facebook_url') }}"
                    prepend="https://facebook.com/"
                    label="Facebook Username (optional)">
                  <p class="help is-danger">Invalid Facebook username.</p>
            </prepend>
          </div>
          <div class="column is-4">
            <prepend name="snapchat_url"
                    original="snapchat"
                    type="text"
                    value="{{ old('snapchat') ? old('snapchat') : $player->snapchat }}"
                    placeholder="Username"
                    error="{{ $errors->has('snapchat_url') }}"
                    prepend="https://snapchat.com/add/"
                    label="Snapchat Username (optional)">
                  <p class="help is-danger">Invalid Snapchat account.</p>
            </prepend>
          </div>
        </div>

        <tags name="othersocial"
                value="{{ old('othersocial') ? old('othersocial') : $player->othersocial }}"
                placeholder="comma separated links"
                error="{{ $errors->has('othersocial') }}"
                label="Other Social Media Links (optional)">
              <p class="help is-danger">Something went wrong</p>
        </tags>


        <hr>

        <button type="submit" class="button is-medium is-info" name="submit" id="playerEditSubmit">Update</button>
      </form>
    </div>
  <!-- </div> -->
</section>

@endsection
