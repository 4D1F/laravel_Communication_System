@extends('base')
@extends('backend.master')
@section('content')
<div class="bd-example">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#Sl</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Message</th>
                <th scope="col">Sentiment</th>
                <th scope="col">Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $key => $msg)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$msg -> from_id}}</td>
                <td>{{$msg -> to_id}}</td>
                <td>{{$msg -> body}}</td>
                <td>{{$msg -> sentiment}}</td>
                <td>
                <div class="box"> 
                    @if($msg -> attachment == null)
                    <img class="rounded-pill" src="{{asset('/uploads/profile/dummy.png')}}" alt="" title="Dummy Pic">
                    @else

                    @php
                    $pos = strlen($msg -> attachment) - strpos($msg -> attachment,'","');
                     $filename = substr($msg -> attachment, 13, -$pos);
                    @endphp

                    <a class="" href="/storage/attachments/{{$filename}}" type="" target="_blank" rel="noopener noreferrer"> 
                    <img class="" src="{{asset('/storage/attachments/'.$filename)}}" alt="" title="Dummy Pic">
                    </a>

                    @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection

<style>
    .box {
  width: 100px;
  height: 100%;
}
    img {
  width: 100%;
  height: 100%;
}
</style>