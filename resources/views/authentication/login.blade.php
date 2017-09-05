@extends ('layouts.master')
	@section('title')
		Login
	@endsection

	@section('content')
			@if(session()->has('activated'))
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Done, </strong> {{ session('activated') }}
					</div>
				</div>
			</div>
			@endif

			@if(session()->has('not_activated'))
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{ session('not_activated') }}
					</div>
				</div>
			</div>
			@endif

			@if(session()->has('reset'))
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{ session('reset') }}
					</div>
				</div>
			</div>
			@endif

			@if(session()->has('reset_done'))
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{ session('reset_done') }}
					</div>
				</div>
			</div>
			@endif

			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Login</h3>
						</div>
						<div class="panel-body">
							<form action="/login" method="POST" role="form" id="login-form">

								{{-- Error message --}}
								<div class="alert alert-danger" style="display: none;">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								</div>

								{{-- success message --}}
								<div class="alert alert-success" style="display: none;">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								</div>

								<!-- Email -->
								<div class="form-group">
									<div class="input-group email">
										<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
										</span>
										<input type="text" class="form-control" name="email" placeholder="example@example.com" required>
									</div>
								</div>
								<!-- Email validation error message -->
								<span class="help-block email-danger-container" style="display: none;">
                                    <span class="text-danger email-danger"></span>
                                </span>


								<!-- Password -->
								<div class="form-group">
									<div class="input-group password">
										<span class="input-group-addon">
											<i class="fa fa-lock"></i>
										</span>
										<input type="password" class="form-control" name="password"  placeholder="Password" required>
									</div>
								</div>
                                <!-- password validation error message -->
                                <span class="help-block pass-danger-container" style="display: none;">
                                    <span class="text-danger pass-danger"></span>
                                </span>

                                <!-- Remember me button -->
								<div class="form-group">
									Remember me
									<input type="checkbox" name="remember_me">
								</div>

                                <!-- forgot password link -->
                                <a href="/forgot-password">Forgot your password?</a>

								<!-- submit button -->	
								<div class="form-group">
									<button type="submit" class="btn btn-primary pull-right">Login</button>
								</div>
							</form>
						</div>			
					</div>
				</div>
			</div>
	@endsection

	@section('scripts')
		<script type="text/javascript">

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content') 
				}
			});

			$('#login-form').submit(function (e) {
				e.preventDefault();

				// by default the error messages should be hidden
				$('.email').removeClass('has-error');
				$('.email-danger-container').hide();
				$('.password').removeClass('has-error');
				$('.pass-danger-container').hide();
				$('.alert-danger').hide();

				// data passed with the request
				var postedData = {
					'email': 		$('input[name=email]').val(),
					'password': 	$('input[name=password]').val(),
					'remember_me': 	$('input[name=remember_me]').is(':checked')
				}


				$.ajax({
					url: 	'/login',
					method: 'POST',
					data: 	 postedData,

					success: function(response) {
						{
							$('button[type=submit]').addClass('disabled');
							$('.alert-success').text(response.success);
							$('.alert-success').show();
								
							setTimeout(function() {
								window.location.href = response.redirection;
							}, 2000)
						}
					},

					error: function(response) {
						console.log(response);

						if (response.responseJSON.hasOwnProperty('email')) {
							// showing email validation error message and style
							$('.email').addClass('has-error');
							$('.email-danger').text(response.responseJSON.email);
							$('.email-danger-container').show();
							
						}

						if (response.responseJSON.hasOwnProperty('password')) {
							// showing password validation error message and style
							$('.password').addClass('has-error');
							$('.pass-danger').text(response.responseJSON.password);
							$('.pass-danger-container').show();
						}

						if (response.responseJSON.hasOwnProperty('failed')) {
							// show failure login message
							$('.alert-danger').text(response.responseJSON.failed);
							$('.alert-danger').show();
						}
					}
				})
			});
		</script>
	@endsection
