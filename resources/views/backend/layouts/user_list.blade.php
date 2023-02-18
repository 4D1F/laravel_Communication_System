@extends('backend.master')
@section('content')
<div class="bd-example">
  <table class="table table-hover">
      <thead>
    <tr>
      <th scope="col">#Sl</th>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Image</th>
      <th scope="col">Address</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $key => $user)
    <!-- @if($user -> role_id == 2) -->
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td>{{$user -> id}}</td>
      <td>{{$user -> name}}</td>
      <td>{{$user -> email}}</td>
      <td>+880<!---->{{$user -> phone}}</td>
      <td>
        @if($user -> image == null)
        <img class="rounded-pill" src="{{asset('/uploads/profile/dummy.png')}}" height="50" width="50" alt="" title="Dummy Pic">
        @else
        <img class="rounded-pill" src="{{asset('/uploads/profile/'.$user->image)}}" height="50" width="50" alt="" title="Profile Pic">
        @endif
      </td>
      <td>{{$user -> address}}</td>
      <td><a class="btn btn-outline-light btn-info" href="{{route('user_edit',$user->id)}}" type="submit">Edit</a>
      <a class="btn btn-outline-light btn-danger " href="{{route('user_delete',$user->id)}}" type="submit">Delete</a></td>
    </tr>
    <!-- @endif -->
    @endforeach
  </tbody>

  </table>
</div>
@endsection

<style>

  img.rounded {
    object-fit: contain;
    border-radius: 0%;
    height: 50px;
    width: 50px;
      }
  </style>