<?php 
use Illuminate\Support\Facades\Input;
?>
<!DOCTYPE html>
<html lang="en">
<head>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="build/datatables/css/dataTables.bootstrap.min.css">
 <script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="node_modules/sweetalert/dist/sweetalert.css">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="opacity: 0.6;">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <!-- {{ config('app.name', 'BIOSYNTH') }}  -->
                        BIOSYNTH
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse"> 
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->s_name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
        @yield('content')



   <!-- Scripts -->
   <script src="public/js/jquery-3.1.1.min.js"></script>
   <script src="public/js/bootstrap.min.js"></script>

    <script src="build/datatables/js/jquery.dataTables.min.js"></script>
    <script src="build/datatables/js/dataTables.bootstrap.min.js"></script>

    @yield('script2')

    @yield('pdfscript')


</body>
</html>
