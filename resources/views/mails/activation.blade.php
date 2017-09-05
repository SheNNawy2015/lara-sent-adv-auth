<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="UTF-8">
		<title>Activation</title>
	</head>
	<body>

		<header>
			Hi, <strong>{{ $username }}</strong>.
		</header>

		<div class="message">
			<p> welcome to our website, activate your account now by clicking the following link,</p>
			<a href="{{env('APP_URL')}}/activate/{{$email}}/{{$code}}">Activate your account.</a>
		</div>
		<br><br>
		<footer>
			Thanks, <br>
			<strong>{{ env('APP_NAME') }}</strong>
		</footer>
	</body>
</html>