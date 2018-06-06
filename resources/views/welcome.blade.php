<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <title>Local Rozgar</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>

          

            html, body {
                background-color: #fff;
                background-image:url("image/i4.jpg");
                background-repeat:no-repeat;
                color:#fff;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }


            .font_f{
        font-family:sans-serif;
        font-variant:small-caps;
        font-size:30px;
        text-align:left;
        margin:2% 4%
    }    

            .full-height {
                height: 100vh;
            }

            .nav .nav-navbar .navbar-right  ul li a{
                color:#000000;
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
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

           
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                    Local Rozgar
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="myNavbar">
                    <!-- Left Side Of Navbar -->
                    
                  
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <li><a href="{{ route('LabourDetails.create') }}">Register Employee</a></li>
                        <li><a href="{{ route('WorkDetails.create') }}">Register Work Details</a></li>
                        <li><a href="{{ route('labourselect') }}">View Employee</a></li>
                        <li><a href="{{ route('workselect') }}">View Work Details</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('aboutus') }}">About Us</a></li>
                    </ul>
                    @endauth
                    </div>
                    @endif
            </div>
        </nav><br><br>
        <div class="container">
        
        <div class="font_f">
              <h1 class="animated text-center fInLeft" style="font-size:70px;color:#000000">Local Rozgar</h1>
              <p class="animated fInRight text-center" style="font-size:40px;color:#000000"">A helping hand to local Employeer</p>
             
              <a class="btn btn-danger" href="{{ url("http://www.sacredbits.com") }}" style="margin-left:40%">Contact Us</a>
          </div>
           
            
         
          
    </div>
        <script src = "{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src = "{{ asset('js/app.js') }}"></script>

    </body>
</html>
