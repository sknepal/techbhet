<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>TechBhet - @yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('/js/bootbox.min.js') }}"></script>
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
 {!!   Feed::link(url('feeds'), 'atom', 'Site Feed', 'en') !!}


</head>

<body>

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">TechBhet</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                {{--<li class="active"><a href="/">Home</a></li>--}}
                <li><a href="/">Home</a></li>
                <li><a href="/events/create">Add an event</a></li>
                {{--<li><a href="#about">About</a></li>--}}
                {{--<li><a href="#contact">Contact</a></li>--}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
                    <li><a href="/auth/login">Login</a></li>
                    <li><a href="/auth/register">Register</a></li>
                @else
                    <li><a href="/auth/logout">Logout</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

<div class="row">
    <div class="col-md-3">
        @section('sidebar')
            {!! Form::open(array('action'=>'EventsController@search', 'method'=>'GET')) !!}
                {!! Form::text('key', null, array('class' => 'form-control', 'placeholder'=>'Search for events...')) !!}
        <br>
            Search within a category:
            <select name="cat" class="form-control">
                <option value="">All categories</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" name="cat">{{$category->name}}</option>
                @endforeach
            </select>
        <br>
            {!! Form::submit('Submit', $attributes = ['class'=>'btn btn-primary']); !!}
        <br>
            {!! Form::close() !!}

        <br>
            <div class="list-group">
                @foreach($categories as $category)
                    <a href="/categories/{{$category->id}}" class="list-group-item">{{$category->name}}</a>
                @endforeach
            </div>
            <input class="btn btn-primary" type="submit" value="Subscribe" id="subscribe">
            <script>
            $('#subscribe').on('click', function (e) {
                bootbox.dialog({
                    title: "Subscribe",
                    message: '<select id="category"> <option value="TheLacunaBlog">Meetups</option> <option value="hackathons">Hackathons</option> <option value="Workshops">Workshops</option></select> ' +
                    '<p><input id="email" type="text" class="txt1" size="30" value="Enter email address" onfocus="this.value = null;" name="email"/>',
                    buttons: {
                        success: {
                            label: "Subscribe",
                            className: "btn-success",
                            callback: function () {
                                var name = $('#category').val();
                                var email = $('#email').val();
//                                console.log(name);
//                                console.log(email);
                                window.open("http://feedburner.google.com/fb/a/mailverify?uri=" + name + "&email=" + email);
                                return false;
                            }
                        }
                    }
                });
            });
        </script>

        @show


    </div>
    <div class="col-md-9">
        @if(Session::has('message'))
            <div class='alert alert-info'>
                {!! Session::get('message') !!}
            </div>
            @endif
        {{--@if($errors)--}}
        @foreach($errors->all() as $error)
                <div class='alert alert-danger'>
                    {{$error}}
                </div>
            @endforeach
            {{--@endif--}}
            @yield('content')
    </div>
</div>

</div><!-- /.container -->



</body>
</html>