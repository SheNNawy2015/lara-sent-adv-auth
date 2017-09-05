<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- csrf-token  -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>@yield('title')</title>



		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Custom styles for this template -->


	</head>

	<body>
		<div class="container">
			<div class="header clearfix">
				<nav>
					<ul class="nav nav-pills pull-right">
						@if(Sentinel::check())
						<li role="presentation">
							<a href="#" onclick="document.getElementById('logout-form').submit()">Logout
							</a>
						</li>

						<form action="/logout" method="POST" id="logout-form">
							{{ csrf_field() }}
						</form>
						@else
						<li role="presentation"><a href="/register">Register</a></li>
						<li role="presentation"><a href="/login">Login</a></li>
						@endif
					</ul>
				</nav>
				<h4 class="text-primary">
					@if (Sentinel::check())
						Hello, <strong class="text-muted">{{ Sentinel::getUser()->first_name }}</strong>
					@else
					<strong>{{ env('APP_NAME') }}</strong>
					@endif
				</h4>
			</div>
			<hr><br>
			@yield('content')
		</div> <!-- /container -->



		<!-- jQuery -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

		@yield('scripts')
	</body>
</html>
