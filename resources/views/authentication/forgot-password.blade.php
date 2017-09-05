@extends ('layouts.master')
	@section('title')
		Forgot password
	@endsection

	@section('content')
	
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Reset your password.</h3>
						</div>
						<div class="panel-body">
							<form action="/forgot-password" method="POST" role="form">
								{{ csrf_field() }}

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

