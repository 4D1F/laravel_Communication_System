@extends('backend.master')
@section('content')

<form action="{{route('user_update',$user->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('flash')
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" value="{{$user -> name}}" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" value="{{$user -> email}}" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        @if($user->image == null)
        <img class="rounded" src="{{asset('/uploads/profile/dummy.png')}}" height="150" width="auto" alt="" title="Dummy Pic" value>
        @else
        <img class="rounded" src="{{asset('/uploads/profile/'.$user->image)}}" height="150" width="auto" alt="" title="Profile Pic">
        @endif
        <input type="file" class="form-control" value="{{$user -> image}}" name="image" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Phone</label>
        <input type="tel" class="form-control" value="{{$user -> phone}}" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Address</label>
        <input type="text" class="form-control" value="{{$user -> address}}" name="address" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection('content')