@extends('layouts.dashboard')
@section('toolbar')
  <div class="h2 my-0 text-white">Categories</div>
  <div class="">
    <label for="addcategorymodal" class="btn btn-blue py-4" @click="setCategory()">Add Category</label>
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
          <th class="text-left">Parent Category</th>
          <th data-sort-method='none' class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td class="pl-3">{{ $category->id }}</td>
          <td>{{ $category->name }}</td>
          <td>{{ renderCategoryDesc($category->parent) }}</td>
          <td class="text-right pr-3">
              <label for="addcategorymodal" class="btn btn-blue py-3 px-4" @click="setCategory({{$category}})"><i class="fal fa-pencil"></i></label>
              <label for="deletemodal" class="btn btn-red py-3 px-4" @click="setDelete({{$category->id}})"><i class="fal fa-times"></i></label>          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>


@component('components.delete', ["model" => "categories"])@endcomponent

<input type="checkbox" class="modal-check" id="addcategorymodal">
<div class="modal" >
  <label for="addcategorymodal" class="modal-background"></label>
  <div class="modal-body bg-white container">
      <section>
        <div class="container" id="root">
          <form action="/dashboard/categories/create" method="post">
            @csrf
            <div class="flex-wrap flex-sbc mb-3">
              <div class="h4 m-0">Create Category</div>
              <button type="submit" class="btn btn-blue py-4" name="submit">Save Category</button>
            </div>

            <div class="col mb-3">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="p-3"  placeholder="Name" :value="category.name" required>
            </div>

            <div class="col mb-3">
              <label for="">Parent Category</label>
              <ul class="text mb-0 pl-4">
                <li style="list-style: none">
                  <radio name="parent_id" value="" checked>None</radio>
                </li>
              </ul>
              @include('components.category', ["categories" => $categoriesForChoosing])
            </div>

          </form>
        </div>
      </section>
  </div>
</div>

@endsection