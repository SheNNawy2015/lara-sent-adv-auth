@extends('layouts.master');

@section('title')
	Mailing users
@endsection

@section('content')
	@if(session('mail_success'))
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Seccess</strong> {{ session('mail_success') }}
			</div>
		</div>
	</div>

	@endif
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Sending mails</h3>
				</div>
				<div class="panel-body">
					<form method="POST" action="/mailing">
						{{ csrf_field() }}
						<div class="form-group">
							<button type="submit" class="btn btn-primary pull-right">Send</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection