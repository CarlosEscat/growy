@extends('layouts.front')
@section('content')

<!-- Page Content -->
  <div class="container growyspace_home_page">
	<div style="margin-top:83px;" class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li class="active">Home</li>
				<li class="active"></li>
				
			</ul>
		</div>
	</div>

    <div class="row">
      
	    <div class="col-md-12 mb-5">
			<div class="growyspace_card card h-100">
				<div class="card-body allign_center">
					<h1 class="card-title">Growyspace</h1>
					<p class="card-text">Your growth is our goal</p>
					<p class="mb-0"><a style="color:#707070;text-decoration:underline;" href="{{ URL::to('/') }}/page/about-us/3.htm">About us</a></p>
				</div>
			</div>
        </div>
	  
     
	  <div class="col-md-12 mb-5">
        <div class="growyspace_card card h-100">
			<div class="card-body">
				<div style="width:50%;float:left;">
					<h2 class="card-title">Create your profile</h2>
					<p class="card-text">Easily create, customise and showcase your professional identity.</p>
				</div>
				
				<img style="float:right;display:block;" src="/assets/images/home_icon1.jpg" />
				
			</div>
        </div>
      </div>
	  <div class="col-md-12 mb-5">
        <div class="growyspace_card card h-100">
			<div class="card-body">
			<img style="float:left;display:block;" src="/assets/images/home_icon2.jpg" />
				<div style="width:40%;float:right;">
					<h2 class="card-title">Create new opportunities</h2>
					<p class="card-text">Easily create and place new opportunity cards</p>
				</div>
			</div>
        </div>
      </div>
	  <div class="col-md-12 mb-5">
        <div class="growyspace_card card h-100">
			<div class="card-body">
				<div style="width:40%;float:left;">
					<h4 class="card-title">Explore for opportunities or users</h4>
					<p class="card-text">Through our search engine, search for available opportunity cards, or other users.</p>
				</div>
				<img style="float:right;display:block;" src="/assets/images/home_icon3.jpg" />				
			</div>
        </div>
      </div>
	   <div class="col-md-12 mb-5">
        <div class="growyspace_card card h-100">
			<div class="card-body">
			<img style="float:left;display:block;" src="/assets/images/home_icon4.jpg" />
				<div style="width:40%;float:right;">
					<h2 class="card-title">Connect</h2>
					<p class="card-text">Reach out to other users through our built-in-house chat function.</p>
				</div>
			</div>
        </div>
      </div>
	  <div class="col-md-12 mb-5">
        <div class="growyspace_card card h-100">
			<div class="card-body">
				<div style="width:40%;float:left;">
					<h4 class="card-title">Create your collection</h4>
					<p class="card-text">Create, manage, and customize a collection on which you will be able to save(for future reference) available opportunity cards, or other user profiles, the same way you would do with a personal portfolio.</p>
				</div>
				<img style="float:right;display:block;" src="/assets/images/home_icon5.jpg" />				
			</div>
        </div>
      </div>
	  <div class="col-md-12 mb-5">
        <div class="growyspace_card card h-100">
			<div class="card-body allign_center">
				<h4 class="card-title">Sound interesting? Great!</h4>
				<p class="card-text"> Sign-up now and try our new demo.</p>
				<p class="mb-0"><a class="btn btn-primary growyspace_btn_primary" href="{{ URL::to('/') }}/user/register">Sign up</a></p>
				<p><span>or</span> <a href="{{ URL::to('/') }}/user/login">Login</a></p>
			</div>
        </div>
      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->




@endsection