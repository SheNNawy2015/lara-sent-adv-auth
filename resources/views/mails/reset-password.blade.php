<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="UTF-8">
		<title>Reset password</title>
	</head>
	<body>

		<header>
			Hi, <strong>{{ $username }}</strong>.
		</header>

		<div class="message">
			<p>To reset your account password click the following link,</p>
			<a href="{{env('APP_URL')}}/reset/{{$email}}/{{$code}}">reset your account password.</a>
		</div>
		<br><br>
		<footer>
			Thanks, <br>
			<strong>{{ env('APP_NAME') }}</strong>
		</footer>
	</body>
</html>