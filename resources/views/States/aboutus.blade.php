<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>About Us</title>
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

		<style>
		.cent {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.font_f{
        font-family:sans-serif;
        font-variant:small-caps;
        font-size:25px;
        text-align:left;
        margin:2% 4%
    }  
.cont {
    position: relative;
    text-align: center;
    color: white;
}
		</style>
	</head>
<body>
	<div class="container-fluid">
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
                     
                        <li><a href="{{ route('LabourDetails.create') }}">Register Employee</a></li>
                        <li><a href="{{ route('WorkDetails.create') }}">Register Work Details</a></li>
                        <li><a href="{{ route('labourselect') }}">View Employee</a></li>
                        <li><a href="{{ route('workselect') }}">View Work Details</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('aboutus') }}">About Us</a></li>
                    </ul>
                    
                    </div>
                    
            </div>
        </nav>
	<div class="cont">
			<img src="image/l5.png" class="img-responsive"  style="width:100%;height:450px">
			<div class="cent">
			<h2 class="text-center font_f">About Us</h2><hr>
				<h3 class="font_f">If you're talented, it's like you have wings<br>
				Let today be the day of your first flight!!</h3>
			</div>
	</div>		
			<br>
			<div class="row">
			
				<div class="col-sm-4">
				<h3 class="font_f animate fInLeft">What is it all about?</h3> 	    	
					<img src="image/l6.jpg" class="img-responsive" style="height:150px;width:15.px">
				</div>
				<div class="col-sm-8">
				<br><br>
					<p class="animate fInRight">The objective was to create the most convenient platform to hire people consequently increasing employment in vulnerable groups. 
					We realized how fragmented the local services industry in the country really was and how difficult it could be for some people to get hired. Even, it was incredibly difficult to find the right professional for anything- whether one needed to find a housemaid or a home tutor. So we decided to solve this problem by leveraging technology.</p>

					<p class="animate fInRight">Through this technology we foresee that every business will have access to every worker and it will be only separated by search. The middle operators that have historically defined how the workforce is accessed will go away.</p>
				</div><div class="col-sm-2"></div>
			</div><br><br>
			<div class="row">
			
				<div class="col-sm-8"><br>
				<h3 class="font_f animate fInLeft">Our Mission</h3>
				<p class="animate fInRight">We strive to create a trusted and dynamic online platform that will help increasing employment of vulnerable groups such as people who work on daily wages, people with mobility problems, mothers and fathers with young children and people living in remote areas simultaneously helping them to lead a free and independent life.</p>
				</div>
				<div class="col-sm-4">
					<img src="image/l3.jpg" class="img-responsive" style="height:150px;width:15.px">
				</div><br><br>
			</div>
			<div class="row">
			<h3 class="font-f animate fInUp">Our team</h3>
			<div class="col-sm-4">
				<img src="image/l5.jpg" class="img-responsive">
			</div>
			<div class="col-sm-8">
				<br><br>
				<p class="animate fInRight">Our team, our key stakeholders are focused on building our community. We are a purpose-driven squad. Everything we do stems from our desire to empower talents around the world to do what they love. We possess the ability to keep it simple yet be creative and also the ability to hustle at work. Our challenge is to make something useful; to solve a problem bigger than ourselves.</p>
			</div>
		</div><br><br>
			<div class="row" style="background-color:black;color:#fff;padding:20px">
			<div class="col-sm-3">
			
			<center>	<a href="http://www.sacredbits.com/"><img src="image/logo.png" class="img-responsive"></a></center>
			</div>
			<div class="col-sm-3">
				<h3 class="text-center">Mail us at</h3>
				<p class="text-center">mail@sacredbits.com</p>

			</div>	
				<div class="col-sm-3">
						<h3 class="text-center">Contact Us</h3>
						<p class="text-center">+91 7424804214</p>

					</div>
					<div class="col-sm-3">
					<h3 class="text-center">Join our Whats app group</h3>
					<p class="text-center"><a href="{{ url("bit.ly/UnofficialJobs") }}" style="color:#fff">Click here<a></p>
					</div>				
			</div>				
		
	</div>
	<script src = "{{ asset('js/app.js') }}"></script>
	<script src = "{{ asset('js/jquery-3.3.1.min.js') }}"></script>
</body>
</html>