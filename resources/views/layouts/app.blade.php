<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Local Rozgar</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

    
   
</head>
<body>

<script src = "{{ asset('js/jquery-3.3.1.min.js') }}"></script>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @guest
                    <a class="navbar-brand" href="{{ url('/') }}">
                    Local Rozgar
                    </a>
                    @else
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        Dashboard
                    </a>
                    @endguest
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->

                        <li><a href="{{ route('LabourDetails.create') }}">Register Employee</a></li>
                        <li><a href="{{ route('WorkDetails.create') }}">Register Work Details</a></li>
                        <li><a href="{{ route('labourselect') }}">View Employee</a></li>
                        <li><a href="{{ route('workselect') }}">View Work Details</a></li>
                        

                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('aboutus') }}">About Us</a></li>
                            
                        @else
                        <?php if(Auth::user()->usertypeid < 6){ ?>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        <?php } ?>
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    Places <span class="caret"></span>
                                </a>
                        
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('States.index') }}">View States</a></li>
                            <li><a href="{{ route('Cities.index') }}">View Cities</a></li>
                            <li><a href="{{ route('Areas.index') }}">View Areas</a></li>
                         </ul>
                         </li>   
                         <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    Types <span class="caret"></span>
                                </a>
                        
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('LabourTypes.index') }}">View Employee Types</a></li>
                            <li><a href="{{ route('WorkTypes.index') }}">View Work Types</a></li>
                            
                         </ul>
                         </li>
                         <?php if(Auth::user()->usertypeid < 6){ ?>
                            <li><a href="{{ route('selectrole') }}">View Users</a></li>
                            <?php } ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->fname }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="/create/{{ Auth::user()->id }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('changepassword-form').submit();">
                                            Change Password
                                        </a>

                                        <form id="changepassword-form" action="/create/{{ Auth::user()->id }}" method="GET" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        <footer class="page-footer">
        <div class="footer-copyright"><hr>
            <div class="container text-center">
          <strong>Developed By</strong> 
            <a class="grey-text text-lighten-4 right" href="{{ url("http://www.sacredbits.com") }}">SacredBits</a>
            © 2018  Copyright 
            </div>
          </div>
        </footer>
        
<script>
    $(document).ready(function() {
        $(".nav a").on("click", function(){
            $(".nav").find(".active").removeClass("active");
            $(this).parent().addClass("active");
        });
    });

</script>

    <script src="{{ asset('js/app.js') }}"></script>
    
</body>
</html>
