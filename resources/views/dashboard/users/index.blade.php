@extends('layouts.dashboard')

@section('toolbar')
  <div class="h2 my-0 text-white">Users</div>
  <div class="">
    <label for="addusermodal" class="btn btn-blue py-4" @click="setUser({name: null, email: null, role: null})">Add User</label>
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
          <th class="text-left">Email</th>
          <th data-sort-method='none' class="text-left">Role</th>
          <th data-sort-method='none' class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td class="pl-3">{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            {{ $user->getRoleNames()[0] }}
          </td>
          <td class="text-right pr-3">
            @if($user->id > 1)
              <label for="addusermodal" class="btn btn-blue py-3 px-4" @click="setUser({name: '{{$user->name}}', email: '{{$user->email}}', role: '{{$user->getRoleNames()[0]}}'})">
                <i class="fal fa-pencil"></i>
              </label>
              <label for="deletemodal" class="btn btn-red py-3 px-4" @click="setDelete({{$user->id}})"><i class="fal fa-times"></i></label>            @endif
          </td>
        </tr>
        @endforeach


      </tbody>
    </table>

  </div>
</section>

@component('components.delete', ["model" => "users"])@endcomponent

<input type="checkbox" class="modal-check" id="addusermodal">
<div class="modal" >
  <label for="addusermodal" class="modal-background"></label>
  <div class="modal-body bg-white container">
      <section>
        <div class="container" id="root">
          <form action="/dashboard/users/create" method="post">
            @csrf
            <div class="flex-wrap flex-sbc mb-3">
              <div class="h4 m-0">Create User</div>
              <button type="submit" class="btn btn-blue py-4" name="submit">Save User</button>
            </div>

            <div class="col mb-3">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="p-3"  placeholder="Name"  :value="user.name" required>
            </div>

            <div class="col mb-3">
              <label for="email">Email Address</label>
              <input type="email" name="email" id="email" class="p-3"  placeholder="Email"  :value="user.email" required>
            </div>

            <div class="col mb-3">
              <label for=""> Role </label>
              <select class="col-12" name="role" style="height: 40px" required>
                <option value="" :selected="user.role == null" disabled>Choose Role</option>
                @foreach($roles as $role)
                  @if($role->name !== "admin")
                    <option value="{{ $role->name }}" :selected="user.role == '{{$role->name}}'">{{ $role->name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </form>
        </div>
      </section>
  </div>
</div>

@if(Session::has('password'))
  <input type="checkbox" class="modal-check" id="confirmpasswordmodal" checked>
  <div class="modal">
    <label for="confirmpasswordmodal" class="modal-background"></label>
    <div class="modal-body bg-white container">
      <section>
        <div class="container text">
          The password for <strong>{{ Session::get('newuser')->name }}</strong> has been randomly generated. Copy the password immediately. Once this window is closed, the password will be lost and the user will have to be edited to generate a new password.
          <hr>
          <div class="p-3 bg-black text-white">
            {{ Session::get('password') }}
          </div>
        </div>
      </section>
    </div>
  </div>
@endif

@endsection

@section('dashboard-scripts')
<script type="text/javascript" id="rolescript">
  new Tablesort(document.getElementById('roles', {
  descending: true
}));
</script>
@endsection