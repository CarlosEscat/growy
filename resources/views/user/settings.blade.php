@extends('layouts.front')
@section('content')
<div id="setting">
    <div class="container bg-gray">

		<div class="col-md-6 main_area mt-5 pt-5 margin-0-auto">
            <div class="row mt-3 col-md-12">
				<div class="header">			
				<p style="float: left;"><img src='/assets/images/settings-icon.png' alt='Setting' >Settings</p>
				</div>
				
			</div>
		    <div class=" card mt-5 align-last">

				{!! Form::open(['url' => '/user/change_password', 'method' => 'POST']) !!}
                <div class="card-body card-body-custom">
				@if(count($errors->get('current_password')) > 0)
						<div class="alert alert-danger">
							{{ $errors->first('current_password') }}
						</div>
					@endif
					@if(count($errors->get('new_password')) > 0)
						<div class="alert alert-danger">
							{{ $errors->first('new_password') }}
						</div>
					@endif
					
					
					@if (session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif					
				<h2 class="pb-2">Email</h2>
                    <div class="form-group row">						
						<label class="col-md-3 control-label">Email address</label>
						<div class="col-md-9 controls">
							<div class="input-group">
								<input type="text" autocomplete="off" name="email" class="form-control" placeholder="Email" value="{{ old('email') !== null ? old('email') : $user->email }}">
								@if(count($errors->get('email')) > 0)
								<p class="inline_error">{{ $errors->first('email')}}</p>
								@endif
							</div>
						</div>
					</div>
					<h2 class="pb-2">Change your password</h2>
					<div class="form-group row">
						<label class="col-md-3 control-label">Current password:</label>
						<div class="col-md-9 controls">
							<div class="input-group">
							<input type="password" class="form-control" name="current_password" placeholder="Current Password" value="">
							</div>
						</div>
					</div>
                    <div class="form-group row">
                        <label class="col-md-3 control-label">New password:</label>
						<div class="col-md-9 controls">   
							<div class="controls">
								<div class="input-group">
									<input type="password" class="form-control" name="new_password" placeholder="New Password" value="">
								</div>
							</div>
						</div>

					</div>
					
                    <div class="form-group row">
                        <label class="col-md-3 control-label">Repeat password:</label>
						<div class="col-md-9 controls">   
							<div class="controls">
								<div class="input-group">
									<input type="password" class="form-control" name="new_password_confirmation" placeholder="Repeat Password" value="">
								</div>
							</div>
						</div>
					</div>
					<h2 class="pb-2">Account</h2>
                    <div class="form-group row">
						<div class="col-md-3">
							<button type="button" id="deleteAccount" class="settingsButton btn-delete-color">Delete account</button>
						</div>
					</div>	

                    <div class="form-group row">
						<div class="col-md-3">
							<button type="button" id="hideAccount" class="settingsButton btn-hide-color">Hide account</button>
						</div>
					
						<div class="col-md-9 controls">   
							<div class="controls">
								<div class="alert alert-secondary" role="alert">
								Hidden accounts won't appear in other users search results.
								</div>
							</div>
						</div>
					</div>	

                    <div class="form-group row">
						<div class="col-md-12 text-right">
						<button type="submit" style="color:#219BC4; padding-left:20px;cursor: pointer;background: #fff;border: 0px;" >Save</button>
							
						</div>
					</div>
				</div>
				{!! Form::close() !!}
            </div>
        </div>
		
	</div>
</div>

@endsection