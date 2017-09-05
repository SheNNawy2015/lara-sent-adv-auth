@extends ('layouts.master')
	@section('title')
		Register
	@endsection

	@section('content')
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Register</h3>
						</div>
						<div class="panel-body">
							<form action="/register" method="POST" role="form">
								{{ csrf_field() }}
								<!-- First name -->
								<div class="form-group">
									<div class="input-group {{ ($errors->has('first_name'))? 'has-error': '' }}">
										<span class="input-group-addon">
											<i class="fa fa-user"></i>
										</span>
										<input type="text" class="form-control" name="first_name" placeholder="First name" required>
									</div>
								</div>
								@if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    </span>
                                @endif

								<!-- Last name -->
								<div class="form-group">
									<div class="input-group {{ ($errors->has('last_name'))? 'has-error': '' }}">
										<span class="input-group-addon">
											<i class="fa fa-user"></i>
										</span>
										<input type="text" class="form-control" name="last_name" placeholder="Last name" required>
									</div>
								</div>
								@if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    </span>
                                @endif

								<!-- Email -->
								<div class="form-group">
									<div class="input-group {{ ($errors->has('email'))? 'has-error': '' }}">
										<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
										</span>
										<input type="text" class="form-control" name="email" placeholder="example@example.com" required>
									</div>
								</div>
								@if ($errors->has('email'))
                                    <span class="help-block">
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </span>
                                @endif

								<!-- Location -->
								<div class="form-group">
									<div class="input-group {{ ($errors->has('location'))? 'has-error': '' }}">
										<span class="input-group-addon">
											<i class="fa fa-map-marker"></i>
										</span>
										<input type="text" class="form-control" name="location" placeholder="Location" required>
									</div>
								</div>
								@if ($errors->has('location'))
                                    <span class="help-block">
                                        <span class="text-danger">{{ $errors->first('location') }}</span>
                                    </span>
                                @endif

								<!-- Password -->
								<div class="form-group">
									<div class="input-group {{ ($errors->has('password'))? 'has-error': '' }}">
										<span class="input-group-addon">
											<i class="fa fa-lock"></i>
										</span>
										<input type="password" class="form-control" name="password"  placeholder="Password" required>
									</div>
								</div>
								@if ($errors->has('password'))
                                    <span class="help-block">
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    </span>
                                @endif
								
								<!-- Password confirmation -->
								<div class="form-group">
									<div class="input-group {{ ($errors->has('password_confirmation'))? 'has-error': '' }}">
										<span class="input-group-addon">
											<i class="fa fa-lock"></i>
										</span>
										<input type="password" class="form-control" name="password_confirmation"  placeholder="Password Confirmation" required>
									</div>
								</div>
								@if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    </span>
                                @endif

								<div class="form-group">
									<button type="submit" class="btn btn-primary pull-right">Register</button>
								</div>
							</form>
						</div>			
					</div>
				</div>
			</div>
	@endsection

