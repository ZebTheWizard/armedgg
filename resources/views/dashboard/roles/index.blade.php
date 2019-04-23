@extends('layouts.dashboard')

@section('toolbar')
  <div class="h2 my-0 text-white">Roles</div>
  <div class="">
    <label for="addrolemodal" class="btn btn-blue py-4" @click="setRole('', [])">Add Role</label>
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
          <th data-sort-method='none' class="text-left">Permissions</th>
          <th data-sort-method='none' class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($roles as $role)
        <tr>
          <td class="pl-3">{{ $role->id }}</td>
          <td>{{ $role->name }}</td>
          <td>
            <br>
            @foreach($role->getPermissionNames() as $perm)
            <li class="my-1">{{$perm}}</li>
            @endforeach
            <br>
          </td>
          <td class="text-right pr-3">
            @if ($role->id > 1)
              <label for="addrolemodal" class="btn btn-blue py-3 px-4" @click="setRole('{{ $role->name }}', {{ $role->permissions->pluck('id') }})">
                <i class="fal fa-pencil"></i>
              </label>
              <label for="deletemodal" class="btn btn-red py-3 px-4" @click="setDelete({{$role->id}})"><i class="fal fa-times"></i></label>            @endif
          </td>
        </tr>
        @endforeach

        <!-- <tr>
          <td class="pl-3">3</td>
          <td>Moderator</td>
          <td>Edit news</td>
          <td class="text-right pr-3">
            <button class="btn btn-red py-3 px-4"><i class="fal fa-times"></i></button>
          </td>
        </tr>
        <tr>
          <td class="pl-3">2</td>
          <td>User</td>
          <td></td>
          <td class="text-right pr-3">
            <button class="btn btn-red py-3 px-4"><i class="fal fa-times"></i></button>
          </td>
        </tr> -->

      </tbody>
    </table>

  </div>
</section>

@component('components.delete', ["model" => "roles"])@endcomponent

<input type="checkbox" class="modal-check" id="addrolemodal">
<div class="modal" >
  <label for="addrolemodal" class="modal-background"></label>
  <div class="modal-body bg-white container">

      <section>
        <div class="container" id="root">


          <form action="/dashboard/roles/create" method="post">
            @csrf
            <div class="flex-wrap flex-sbc">
              <div class="h4 m-0">Create Role</div>
              <button type="submit" class="btn btn-blue py-4" name="submit">Save Role</button>
            </div>
            <div class="col mt-3 mb-3">
              <input type="text" name="name" id="name" class="p-3"  placeholder="Role name..."  :value="role.name" required>
            </div>

            <div class="col mb-3 flex-wrap">
              @foreach($permissions as $perm)
              <div class="flex-sbc col-4 p-3">
                <div class="h6 m-0">{{ $perm->name }}</div>
                <div class="">
                  <input class="tgl tgl-ios" id="perm{{$perm->id}}" type="checkbox" name="perm:{{ $perm->id }}" :checked="role.permissions.includes({{ $perm->id }})"/>
                  <label class="tgl-btn" for="perm{{$perm->id}}"></label>
                </div>
              </div>
              @endforeach
            </div>


          </form>
        </div>
      </section>

  </div>
</div>


@endsection

@section('dashboard-scripts')
<script type="text/javascript" id="rolescript">
  new Tablesort(document.getElementById('roles', {
  descending: true
}));
</script>
@endsection