@extends('base')

<body>
    <div class="container-fluid">
        <a href={{route('welcome')}} class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Go To Home</a>
    </div>

    <div>
        <form>
            <label for="userID" class="form-label">Example textarea</label>
            <textarea class="form-control" id="userID"></textarea>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>


</body>