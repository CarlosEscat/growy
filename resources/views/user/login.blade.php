@extends('layouts.front')
@section('content')
<!-- Content -->
<div class="space_lab_main_content page-content bg-white">
  	<!-- Breadcrumb row -->
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="{{ URL::to('/') }}">Home</a></li>
				<li class="active">Login</li>
			</ul>
		</div>
	</div>
	<!-- Breadcrumb row END -->
	<div style="min-height:500px;overflow:hidden;height:500px;" class="page-content bg-white">
		<!-- contact area -->
		<div class="section-full content-inner">
			<!-- Product -->
			<div class="container">	
				<div class="shop-form">
					<div class="row">
						<div class="col-md-12 col-lg-12 m-b30">
							{!! Form::open(['url' => '/user/loggin', 'method' => 'POST']) !!}
								@if(session('registration_success')) 
									<div class="alert alert-success" role="alert">
										{{ session('registration_success') }}
									</div>
								@endif
								@if(count($errors->get('wrong_login_details')) > 0)
									<p class="inline_error">{{ $errors->first('wrong_login_details')}}</p>
								@endif
																
								<h4>Log in</h4>
								<div class="form-group">
									<label class="turbo_form_label">Email <span class="red">*</span></label>
									<input type="text" class="form-control" name="email" placeholder="Email" value="">
									@if(count($errors->get('email')) > 0)
										<p class="inline_error">{{ $errors->first('email')}}</p>
									@endif
								</div>
								<div class="form-group">
									<label class="turbo_form_label">Password <span class="red">*</span></label>
									<input type="password" class="form-control" name="password" placeholder="Password" value="">
									@if(count($errors->get('password')) > 0)
										<p class="inline_error">{{ $errors->first('password')}}</p>
									@endif
								</div>
								
								<div class="form-group">
									<input type="hidden" name="from_page" value="login" />
									<button type="submit" class="btn btn-primary">Login</button>
									<a class="forgot_password_btn">Forgot password ?</a>
								</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('forgot_password')
@endsection