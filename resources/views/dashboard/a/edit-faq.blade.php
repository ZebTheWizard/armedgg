@extends('layouts.dashboard')

@section('dashboard')

<div class="level">
  <div class="level-left">
    <div class="title">Editing FAQ</div>
  </div>
  <div class="level-right">
    @if(Auth::user()->isAdmin)
      <form class="is-marginless" action="/dashboard/faq/create" method="post">
        @csrf
        <button type="submit" class="button is-info">
          Create FAQ <i class="fas fa-plus" style="margin-left: 0.5rem;"></i>
        </button>
      </form>
    @endif
  </div>
</div>


<form action="/dashboard/faq/update" method="post">
  @csrf
  <input type="hidden" name="id" value="{{ $faq->id }}">
  <div class="columns is-vcentered">
    <div class="column">
      <div class="field">
        <label for="question" class="label">FAQ Question</label>
        <div class="control">
          <input id="question"
                 name="question"
                 class="input form-control{{ $errors->has('question') ? ' is-danger' : '' }}"
                 type="text"
                 placeholder="Text Input"
                 value="{{ old('question') ? old('question') : $faq->question }}"
                 required>
        </div>
        @if ($errors->has('question'))
            <p class="help is-danger">{{ $errors->first('question') }}</p>
        @endif
      </div>



      <div class="field">
        <label for="answer" class="label">FAQ Answer</label>
        <div class="control">
          <textarea id="answer"
            name="answer"
            rows="5"
            cols="80"
            class="textarea form-control{{ $errors->has('answer') ? ' is-danger' : '' }}"
            placeholder="What is the answer to the question?..."
            required>{{ old('answer') ? old('answer') : $faq->answer }}</textarea>
        </div>
        @if ($errors->has('answer'))
            <p class="help is-danger">{{ $errors->first('answer') }}</p>
        @endif
      </div>
    </div>
  </div>






    <button style="margin-top:1.5rem" type="submit" class="button is-medium is-info" name="submit">Update!</button>
  </div>
</form>


@endsection
