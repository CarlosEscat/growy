@extends('layouts.front')
@section('content')
<!-- Content -->
<div class="space_lab_main_content page-content bg-white">
  
	<!-- Breadcrumb row -->
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="{{ URL::to('/') }}">Home</a></li>
				<li><a href="{{ URL::to('/') }}/user/my_account">My Account</a></li>
				<li>Settings</li>
			</ul>
		</div>
	</div>
	<!-- Breadcrumb row END -->
<div class="page-content bg-white">
    <!-- contact area -->
	<div class="section-full content-inner">
		<!-- Product -->
		<div class="container">	
	
	
	<div class="shop-form">
		<div class="row">
			
			<div class="col-md-8 col-lg-8 m-b30">
					@if (session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif
				{!! Form::open(['url' => '/user/change_contact_info', 'method' => 'POST']) !!}
					<div class="form-group {{ ((count($errors->get('full_name')) > 0) ? 'has-error' : '') }}">
						<label class="">Full Name <span class="red">*</span></label>
						<input type="text" autocomplete="off" class="form-control" name="full_name" placeholder="Full Name" value="{{ old('full_name') !== null ? old('full_name') : $user->full_name }}">
						@if(count($errors->get('full_name')) > 0)
							<p class="inline_error">{{ $errors->first('full_name')}}</p>
						@endif
					</div>
					
					<div class="form-group {{ ((count($errors->get('email')) > 0) ? 'has-error' : '') }}">
						<label class="">Email <span class="red">*</span></label>
						<input type="text" autocomplete="off" name="email" class="form-control" placeholder="Email" value="{{ old('email') !== null ? old('email') : $user->email }}">
						@if(count($errors->get('email')) > 0)
							<p class="inline_error">{{ $errors->first('email')}}</p>
						@endif
					</div>
					<div class="form-group {{ ((count($errors->get('profession')) > 0) ? 'has-error' : '') }}">
						<label class="">Profession <span class="red">*</span></label>
						<input type="text" autocomplete="off" name="profession" class="form-control" placeholder="Profession" value="{{ old('profession') !== null ? old('profession') : $user->profession }}">
						@if(count($errors->get('profession')) > 0)
							<p class="inline_error">{{ $errors->first('profession')}}</p>
						@endif
					</div>
					<br/>
					<h3>Location</h3>
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-sm-6 {{ ((count($errors->get('country_code')) > 0) ? 'has-error' : '') }}">
							<label class="turbo_form_label">Country <span class="red">*</span></label>
							<select class="form-control" name="country_code">
								<option value="">Select a Country</option>
								@foreach($countries as $country_code => $coutry_name)
									<option 
										@if(old('country_code') !==null && old('country_code') == $country_code)
											selected
										@elseif($user->country_code == $country_code)	
											selected
										@endif
									value="{{ $country_code }}">{{ $coutry_name }}</option>
								@endforeach
							</select>	
						</div>
						<div class="form-group col-lg-6 col-md-6 col-sm-6 {{ ((count($errors->get('city')) > 0) ? 'has-error' : '') }}">
							<label class="turbo_form_label">City <span class="red">*</span></label>
							<input type="text" autocomplete="off" class="form-control" name="city" placeholder="City" value="{{ old('city') !== null ? old('city') : $user->city }}">
						</div>
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update Account Info</button>
					</div>
				{!! Form::close() !!}
			</div>
			<div style="" class="change_password_link_block m-t30 col-md-8 col-lg-8 m-b30">
				<a style="color:blue;" class="change_password_link">Change Password</a>
			</div>
			<div style="clear:both;margin-top:30px;" class="{{ count($errors->get('current_password')) > 0 || count($errors->get('new_password')) > 0 ? '' : 'hidden' }} change_password_fields_block col-md-8 col-lg-8 m-b30 m-t30">
				{!! Form::open(['url' => '/user/change_password', 'method' => 'POST']) !!}
					<h3>Change your account password</h3>
					<br/>
										
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
					<div class="form-group">
						<label class="turbo_form_label">Current Password <span class="red">*</span></label>
						<input type="password" class="form-control" name="current_password" placeholder="Current Password" value="">
					</div>
					<div class="form-group">
						<label class="turbo_form_label">New Password <span class="red">*</span></label>
						<input type="password" class="form-control" name="new_password" placeholder="New Password" value="">
					</div>
					<div class="form-group">
						<label class="turbo_form_label">Repeat Password <span class="red">*</span></label>
						<input type="password" class="form-control" name="new_password_confirmation" placeholder="Repeat Password" value="">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Change Password</button>
					</div>
				{!! Form::close() !!}
			</div>
				
		</div>
	</div>
	</div>
	</div>
	</div>
	
	
	
	
</div>	
@endsection