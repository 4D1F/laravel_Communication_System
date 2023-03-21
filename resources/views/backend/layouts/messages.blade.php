@extends('backend.master')
@section('content')

@include('chatbot')

<style>
    img {
        max-width: 100%;
    }

    .inbox_people {
        background: #f8f8f8 none repeat scroll 0 0;
        float: left;
        overflow: hidden;
        width: 40%;
        border-right: 1px solid #c4c4c4;
        height: 700px;
    }

    .inbox_msg {
        border: 1px solid #c4c4c4;
        overflow: hidden;
        height: 700px;
    }

    .top_spac {
        margin: 20px 0 0;
    }


    .recent_heading {
        float: left;
        width: 40%;
    }

    .srch_bar {
        display: inline-block;
        text-align: right;
        width: 60%;
    }

    .headind_srch {
        padding: 10px 29px 10px 20px;
        overflow: hidden;
        border-bottom: 1px solid #c4c4c4;
    }

    .recent_heading h4 {
        color: #05728f;
        font-size: 21px;
        margin: auto;
    }

    .srch_bar input {
        border: 1px solid #cdcdcd;
        border-width: 0 0 1px 0;
        width: 80%;
        padding: 2px 0 4px 6px;
        background: none;
    }

    .srch_bar .input-group-addon button {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        padding: 0;
        color: #707070;
        font-size: 18px;
    }

    .srch_bar .input-group-addon {
        margin: 0 0 0 -27px;
    }

    .chat_ib h5 {
        font-size: 15px;
        color: #464646;
        margin: 0 0 8px 0;
    }

    .chat_ib h5 span {
        font-size: 13px;
        float: right;
    }

    .chat_ib p {
        font-size: 14px;
        color: #989898;
        margin: auto
    }

    .chat_img {
        float: left;
        width: 11%;
    }

    .chat_ib {
        float: left;
        padding: 0 0 0 15px;
        width: 88%;
    }

    .chat_people {
        overflow: hidden;
        clear: both;
    }

    .chat_list {
        border-bottom: 1px solid #c4c4c4;
        margin: 0;
        padding: 18px 16px 10px;
    }

    .inbox_chat {
        height: 800px;
        overflow-y: scroll;

    }

    .active_chat {
        background: #ebebeb;
    }

    .incoming_msg_img {
        display: inline-block;
        width: 6%;
    }

    .received_msg {
        display: inline-block;
        padding: 0 0 0 10px;
        vertical-align: top;
        width: 92%;
    }

    .received_withd_msg p {
        background: #ebebeb none repeat scroll 0 0;
        border-radius: 3px;
        color: #646464;
        font-size: 14px;
        margin: 0;
        padding: 5px 10px 5px 12px;
        width: 100%;
    }

    .time_date {
        color: #747474;
        display: block;
        font-size: 12px;
        margin: 8px 0 0;
    }

    .received_withd_msg {
        width: 57%;
    }

    .mesgs {
        float: left;
        padding: 30px 15px 0 25px;
        width: 60%;
        background-color: #fff;
    }

    .sent_msg p {
        background: #05728f none repeat scroll 0 0;
        border-radius: 3px;
        font-size: 14px;
        margin: 0;
        color: #fff;
        padding: 5px 10px 5px 12px;
        width: 100%;
    }

    .outgoing_msg {
        overflow: hidden;
        margin: 26px 0 26px;
    }

    .sent_msg {
        float: right;
        width: 46%;
    }

    .input_msg_write input {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        color: #4c4c4c;
        font-size: 15px;
        min-height: 48px;
        width: 100%;
    }

    .type_msg {
        border-top: 1px solid #c4c4c4;
        position: relative;
    }

    .msg_send_btn {
        background: #05728f none repeat scroll 0 0;
        border: medium none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        height: 33px;
        position: absolute;
        right: 0;
        top: 11px;
        width: 33px;
    }

    .messaging {
        padding: 0 0 50px 0;
    }

    .msg_history {
        height: 700px;
        overflow-y: auto;
    }

    .conversation {
        cursor: pointer;
    }
</style>

<div class="container">
    <h3 class=" text-center">Messaging</h3>

    {{-- <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Choose Teacher
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Choose...</a></li>
            @foreach($users as $user)
            <li><a class="dropdown-item" href="#">{{$user -> name}}</a></li>
        </ul>
        @endforeach
</div>
--}}

<div class="messaging">
    <div class="inbox_msg">
        <div class="inbox_people">
            {{--<form action=" "  method="post" enctype="multipart/form-data">--}}
            <select class="form-select" id="select_teach" aria-label="Default select example">
                <option selected>Select a teacher...</option>
                @foreach($users as $user)
                <option value="{{$user -> id}}" id="op{{$user -> id}}">{{$user -> name}}</option>
                @endforeach
            </select>
            {{--</form>--}}
            <div class="headind_srch">
                <div class="recent_heading">
                    <h4>Recent</h4>
                </div>
                <div class="srch_bar">
                    <div class="stylish-input-group">
                        <input type="text" class="search-bar" placeholder="Search">
                        <a href="" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="inbox_chat" id="chat_list">
                <div>
                    <strong>Please Setect Name From Selector.</strong>
                </div>
            </div>
        </div>

        <div class="mesgs">
            <div class="msg_history" id="convo">
                <p>Select a Conversation</p>
            </div>
        </div>
    </div>
</div>
</div>



@section('js_content')

<script>
    $(document).ready(function() {
        $("#select_teach").change(function(e) {
            e.preventDefault();
            let val = $(this).val();
            let url = "{{route('get_user',[':id'])}}";
            url = url.replace(':id', val);
            $('#chat_list').html('');

            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    $.each(data.megs, function(index, value) {
                        if (value != null) {
                            if (value != "") {

                                $('#chat_list').append('\
                                    <div class="chat_list active_chat conversation" data-to_id="' + value.to_id + '">\
                                    <div class="chat_people">\
                                        <div class="chat_img"> <img class="rounded-pill" src="/uploads/profile/' + value.image + '" height="50" width="50" alt="'+value.name+'"> </div>\
                                        <div class="chat_ib">\
                                        <h5> ' + value.name + ' <span class="chat_date">' + value.created_at + '</span></h5>\
                                        <p>' + value.body + '</p>\
                                        </div>\
                                        </div>\
                                        </div>\
                                ');
                            }
                        }
                    });
                }
            });
        });

        $("#chat_list").on('click', '.conversation', function(e) {
            e.preventDefault();
            let from_id = $('#select_teach').val();
            let to_id = $(this).attr('data-to_id');
            let url = "{{route('get_convo',[':from_id',':to_id'])}}";
            url = url.replace(':from_id', from_id);
            url = url.replace(':to_id', to_id);
            $('#convo').html('');

            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    $.each(data.convos, function(index, value) {
                        if (value != null) {
                            if (value != "") {
                                if (value.from_id == from_id) {
                                    $('#convo').append('\
                                        <div class="outgoing_msg">\
                                            <div class="sent_msg" id="sent_msg">\
                                                <p>' + value.body + '</p>\
                                                <span class="time_date"> '+ value.created_at +' </span>\
                                            </div>\
                                        </div>\
                                    ');
                                } else if (value.from_id == to_id) {
                                    $('#convo').append('\
                                        <div class="incoming_msg" id="received_msg">\
                                            <div class="incoming_msg_img"> <img class="rounded-pill" src="/uploads/profile/' + value.image + '" height="30" width="30" alt="'+value.name+'"> </div>\
                                            <div class="received_msg">\
                                                <div class="received_withd_msg">\
                                                    <p>' + value.body + '</p>\
                                                    <span class="time_date"> '+ value.created_at + '</span>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    ');
                                }
                            }
                        }
                    });
                }
            });
        });

    });
</script>



@endsection

@endsection