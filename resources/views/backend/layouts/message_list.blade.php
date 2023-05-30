@extends('backend.master')
@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

<form action="{{route('message_search')}}" method="post" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <td>
                <div>
                    <select class="form-select" id="sender" name="from_id" aria-label="Default select example">
                        <option selected>Select a teacher...</option>
                        @foreach($users as $user)
                        <option value="{{$user -> id}}" id="op{{$user -> id}}">{{$user -> name}}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td>
                <div>
                    <select class="form-select" id="receiver" name="to_id" aria-label="Default select example">
                        <option selected>Select a teacher...</option>
                        @foreach($users as $user)
                        <option value="{{$user -> id}}" id="opt{{$user -> id}}">{{$user -> name}}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td>
                <button type="submit"> Search </button>
            </td>
        </tr>
    </table>
</form>

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

<button class="btn btn-warning" id="download"> Download Report </button>


@section('js_content')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#sender').select2();
        $('#receiver').select2();
    });
    
    window.onload = function() {
        document.getElementById("download")
        .addEventListener("click", () => {
            const invoice = this.document.getElementById("invoice");
            console.log(invoice);
            console.log(window);
            let name = Math.floor(Date.now() / 1000);
            var opt = {
                filename: name + '.pdf',
                image: {
                    type: 'png',
                    quality: 1
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                }
            };
            html2pdf().from(invoice).set(opt).save();
            })
    }

</script>

@endsection
@endsection