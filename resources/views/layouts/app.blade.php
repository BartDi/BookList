<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ isset($title) ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>
    <style>
        #admin, #book, #publisher{
            height:45px;
            width:120px;
            margin-left:20px
        }
        #search{
            margin-left:30%;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <div class="btn-group">
                        <button type="button" id="admin" onmouseover="showAdmin()" onmouseout="hideAmind()" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin
                        </button>
                        <div class="dropdown-menu hiddenAdmin" onmouseover="showAdmin()" onmouseout="hideAmind()">
                            <a class="dropdown-item" href='{{url("add")}}'>Add Book</a>
                            <a class="dropdown-item" href='{{url("add/author")}}'>Add Author</a>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" id="book" onmouseover="showBook()" onmouseout="hideBook()" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Books
                        </button>
                        <div class="dropdown-menu hiddenBook" onmouseover="showBook()" onmouseout="hideBook()">
                            <a class="dropdown-item" href='{{ url("/list") }}'>Book List</a>
                            <a class="dropdown-item" href='{{ url("/categories") }}'>Category</a>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" id="publisher" onmouseover="showPub()" onmouseout="hidePub()" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Publishers
                        </button>
                        <div class="dropdown-menu hiddenPub" onmouseover="showPub()" onmouseout="hidePub()">
                            <a class="dropdown-item" href='{{ url("/publishers") }}'>Publisher List</a>
                            <a class="dropdown-item" href='{{ url("/authors") }}'>Authors</a>
                        </div>
                    </div>

                    <form action='{{url("/search")}}' id="search" method="POST">
                        @csrf                                 
                        <input type="text" placeholder="search" name="search">
                        <input type="submit" value="search">
                    </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav justify-content-end">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    <div class="btn-group">
                        <a href='{{ url("basket") }}'>Basket</a>
                    </div>
                    <div class="btn-group" style="margin-left:20px">
                        <a href='{{ url("library") }}'>Library</a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
<script>
function showAdmin() {
    const admin = document.getElementsByClassName('hiddenAdmin');
    for(let i=0; i<admin.length; i++){
        admin[i].style.marginTop = "45px";
        admin[i].style.display = "block";
    }

}
function hideAmind(){
    const admin = document.getElementsByClassName("hiddenAdmin");
    for(let i=0; i<admin.length; i++){
        admin[i].style.display = "none";
    }

}

function showBook() {
    const admin = document.getElementsByClassName('hiddenBook');
    for(let i=0; i<admin.length; i++){
        admin[i].style.marginTop = "45px";
        admin[i].style.display = "block";
    }
}
function hideBook(){
    const admin = document.getElementsByClassName("hiddenBook");
    for(let i=0; i<admin.length; i++){
        admin[i].style.display = "none";
    }
}

function showPub() {
    const admin = document.getElementsByClassName('hiddenPub');
    for(let i=0; i<admin.length; i++){
        admin[i].style.marginTop = "45px";
        admin[i].style.display = "block";
    }
}
function hidePub(){
    const admin = document.getElementsByClassName("hiddenPub");
    for(let i=0; i<admin.length; i++){
        admin[i].style.display = "none";
    }
}
</script>
