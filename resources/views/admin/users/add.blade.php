@extends('layouts.admin')
@section('content')
	<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{ URL::to('/growyspace-admin/dashboard/') }}">Home</a>
			<span class="divider"><i class="fa fa-angle-right"></i></span>
		</li>
		<li class="active">Add User</li>
	</ul>
</div>

<!-- END Breadcrumb -->
<div class="box-content">
	{!! Form::open(['url' => '/growyspace-admin/users/' , 'method' => 'POST', 'route' => ['users.store']]) !!}
	<div class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-3 col-lg-2 control-label">User Name</label>
			<div class="col-sm-9 col-lg-10 controls">
				<input type="text" placeholder="User Name" name="user_name" value="{{ old('user_name') !== null ? old('user_name') : '' }}" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 col-lg-2 control-label">Password</label>
			<div class="col-sm-9 col-lg-10 controls">
				<input type="password" placeholder="Password" name="password" value="" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 col-lg-2 control-label">Repead Password</label>
			<div class="col-sm-9 col-lg-10 controls">
				<input type="password" placeholder="Repead Password" name="password_confirmation" value="" class="form-control">
			</div>
		</div>
		
		
		<div class="form-group">
			<label class="col-sm-3 col-lg-2 control-label"></label>
			<div class="col-sm-9 col-lg-10 controls">
				<button type="submit" class="btn btn-primary">Create User</button>
			</div>
		</div>
		
	</div>
	{!! Form::close() !!}
</div>

@endsection
