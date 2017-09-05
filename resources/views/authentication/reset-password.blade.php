@extends ('layouts.master')
	@section('title')
		Reset password
	@endsection

	@section('content')
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">New password</h3>
					</div>
					<div class="panel-body">
						<form action="" method="POST" role="form">
							{{ csrf_field() }}

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
									<input type="password" class="form-control" name="password_confirmation"  placeholder="Password confirmation" required>
								</div>
							</div>
							@if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                </span>
                            @endif

							<!-- submit button -->	
							<div class="form-group">
								<button type="submit" class="btn btn-primary pull-right">Reset</button>
							</div>
						</form>
					</div>			
				</div>
			</div>
		</div>
	@endsection

