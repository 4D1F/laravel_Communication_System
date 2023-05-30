@extends('base')
@include('flash')

<title>Laravel</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<!-- Styles -->
<style>
    html,
    body {
        
        background-image: url("uploads/Land_STCS.png");
        background-repeat: no-repeat;
        background-size: cover;
        color: #636b6f;
        font-family: 'Raleway';
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 30px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links>a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>

<body>
    <div class="flex-center position-ref full-height">

        @if (Route::has('login') && Auth::check())

        

        @if (Auth::user()->role_id == 1)
        <div class="top-right links">
                <a href="{{ url('/dashboard') }}">Dashboard</a>
                <a href="{{ url('/chatify') }}">Messenger</a>
                <a href="{{ url('/logout') }}">Logout</a>
        </div>
        @elseif (Auth::user()->role_id == 2)
        <div class="top-right links">
                <a href="{{ url('/user/dashboard') }}">Dashboard</a>
                <a href="{{ url('/chatify') }}">Messenger</a>
                <a href="{{ url('/logout') }}">Logout</a>
        </div>
        @endif
        @elseif (Route::has('login') && !Auth::check())
        <div class="top-right links">
                <a href="{{ url('/user/login') }}">Login</a>
                <a href="{{ url('/user/create') }}">Register</a>
            </div>
        @endif

        <div class="content">
            
        </div>
    </div>
</body>