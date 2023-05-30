
<style>
    .box {
        width: 150px;
        height: 80%;
    }

    img {
        width: 30%;
        height: 30%;
    }
</style>

@extends('backend.master')
@section('content')
@include('chatbot')

<h2> Welcome Admin</h2>
<br>
<br>
<h4>Recent Negative Messages: </h4>
<br>
<br>
<div class="bd-example">
    <table class="table table-hover" id="invoice">
        <thead>
            <tr>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Message</th>
                <th scope="col">Sentiment</th>
                <th scope="col">Highlighted Keywords</th>
                <th scope="col" style="text-align: justify;">Attachment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $key => $msg)
            <tr>

                <td>{{$msg -> user_from ->name}}</td>
                <td>{{$msg -> user_to ->name}}</td>
                <td>{{$msg -> body}}</td>
                <td>{{$msg -> sentiment}}</td>
                <td>{{$msg -> highlight}}</td>
                <td style=" text-align: justify;">
                    <div class="box">
                        @if($msg -> attachment == null)
                        <img class="rounded-pill" src="{{asset('/uploads/no_file.png')}}" alt="" title="Attachment Unavailable">
                        @else

                        @php
                        $attch = json_decode($msg -> attachment);
                        $filename = $attch->new_name;
                        $ext = explode(".",$filename);
                        $ext = array_pop($ext);
                        @endphp

                        @if($ext == "rar" ||$ext == "zip" ||$ext == "txt" ||$ext == "pdf")

                        <a class="" href="/storage/attachments/{{$filename}}" title="{{$attch->old_name}}">
                            <p>{{$attch->old_name}}</p>
                        </a>

                        @else
                        <a class="" href="/storage/attachments/{{$filename}}" type="" target="_blank" rel="noopener noreferrer">
                            <img class="" src="{{asset('/storage/attachments/'.$filename)}}" alt="" title="Dummy Pic">
                        </a>

                        @endif
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="paginate">
        {{$messages->links()}}
    </div>
</div>

@endsection