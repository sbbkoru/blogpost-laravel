<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Proje 1 - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>
<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-secondary border-bottom shadow-sm mb-3">
    <h5 class="my-0 mr-md-auto font-weight-normal">Laravel App</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{route('home.index')}}">Home</a>
        <a class="p-2 text-dark" href="{{route('home.price')}}">Price</a>
        <a class="p-2 text-dark" href="{{route('posts.index')}}">Blog Posts</a>
        <a class="p-2 text-dark" href="{{route('posts.create')}}">Add</a>

        @guest
                @if (Route::has('register'))
                    <a class="p-2 text-dark" href="{{route('register')}}">Register</a>
                @endif
                    <a class="p-2 text-dark" href="{{route('login')}}">Login</a>
            @else
            <a class="p-2 text-dark" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout ({{ Auth::user()->name }})</a>

            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest
    </nav>
</div>
<div class="container">
    @if (session('status'))
        <div style="background: green;color: white;">{{session('status')}}</div>
    @endif
   @yield('content')
   </div>
</body>
</html>


