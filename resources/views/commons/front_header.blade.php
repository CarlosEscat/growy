<!DOCTYPE html>
<html lang="en">
<head>
 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	
   <title>{{ isset($meta_title) ? $meta_title : 'Growyspace' }}</title>
	
	@if(isset($opportunity_card_page) && $opportunity_card_page === true && $opc)
		<meta property="og:url"           content="http://growyspace.com/cards/{{ $opc-> id }}" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="{{ $opc->company.' '.$opc->title }}" />
		<meta property="og:description"   content="{{ $opc->description }}" />
		
		@if(is_file(base_path() . '/public/uploads/opc/'.$opc->id.'/'.$opc->company_logo_url))
			<meta property="og:image" content="{{ URL::to('/') }}/uploads/opc/{{ $opc->id }}/{{ $opc->company_logo_url }}" />
		@else
			<meta property="og:image" content="{{ URL::to('/') }}/assets/images/logo.png" />
		@endif
	@endif
	
	
	
	<link rel="icon" href="{{ URL::to('/') }}/assets/images/favico.png" type="image/x-icon" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Bootstrap core CSS -->
    <link href="{{ URL::to('/') }}/assets/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/assets/plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/assets/plugins/croppie/croppie.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	
	<link href="{{ URL::to('/') }}/assets/bootstrap4-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	
	<link href="{{ URL::to('/') }}/assets/css/main.css?{{ time() }}" rel="stylesheet">
	<script>window.base_url = '{{ URL::to('/') }}/';</script>
	<script>window.is_logged_in = '{{ Auth::guard("user")->check() ? 1 : 0 }}';</script>
	<script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
</head>

<body>

  <!-- Navigation -->
  <nav class="top_header_block fixed-top">
    <div class="container header_container">
		<div class="header_left {{ Auth::guard('user')->check() ? '' : 'logout_case_header_left' }}">
			<a href="{{ Auth::guard('user')->check() ? URL::to('/').'/user/my_account' : URL::to('/') }}"><img src="/assets/images/logo.png" /></a>
		</div>
		
		@if(Auth::guard('user')->check())
			<!-- Search form -->
			<form style="width:100%;" action="{{ URL::to('/') }}/search"> 
				<div class="search_input_block">
					<span class="fa fa-search search_icon"></span>
					<input type="text" class="search_input form-control" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="What are you looking for?">
					<input type="hidden" name="type" value="{{ isset($_GET['type']) ? $_GET['type'] : 0 }}" />
				</div>
			</form>
		@endif
    </div>
	@if(Auth::guard('user')->check())
	<div class="top_menu_block">
		<ul>
			<li>
				@if(is_file(base_path() . '/public/uploads/profile/'.Auth::guard('user')->user()->id.'/'.Auth::guard('user')->user()->profile_image_cropped))
			    
					<a href="{{ URL::to('/') }}/user/my_account"><img class="top_profile_image" src="/uploads/profile/{{ Auth::guard('user')->user()->id }}/{{ Auth::guard('user')->user()->profile_image_cropped }}" /></a>
				@else
					<a href="{{ URL::to('/') }}/user/my_account"><img src="/assets/images/no_profile.png" /></a>
				@endif
			</li>
			<li><a href="{{ URL::to('/') }}/messages"><img src="/assets/images/message.png" /><span class="{{ $not_read_messages_count > 0 ? '' : 'hidden' }} not_read_messages_count">{{ $not_read_messages_count }}</span></a></li>
			<li><a href="{{ URL::to('/') }}/user/my-collection"><img src="/assets/images/collection.png" /></a></li>
			<li><a href="{{ URL::to('/') }}/search"><img src="/assets/images/search_white.png" /></a></li>
			<li><a href="{{ URL::to('/') }}/user/my_account/settings"><img src="/assets/images/settings.png" /></a></li>
			<li><a href="{{ URL::to('/') }}/user/logout"><img src="/assets/images/logout.png" /></a></li>
			
		</ul>
	    <button class="hidden btn btn-primary dropdown-toggle btn-lg" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			{{ Auth::guard('user')->user()->full_name }}
			<span class="{{ $not_read_messages_count > 0 ? '' : 'hidden' }} not_read_messages_count2">{{ $not_read_messages_count }}</span>
		</button>
	  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<a class="dropdown-item" href="{{ URL::to('/') }}/user/my_account"><i class="fa fa fa-user"></i> My Profile</a>
		<a style="position:relative;" class="dropdown-item" href="{{ URL::to('/') }}/messages"><i class="fa fa-envelope" aria-hidden="true"></i><span class="{{ $not_read_messages_count > 0 ? '' : 'hidden' }} not_read_messages_count">{{ $not_read_messages_count }}</span> Messages</a>
		<a class="dropdown-item" href="{{ URL::to('/') }}/user/my-collection"><img class="collection_icon" src="/assets/images/collection_icon.png" /> My Collections</a>
		<a class="dropdown-item" href="{{ URL::to('/') }}/user/my_account/settings"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
		<a class="dropdown-item" href="{{ URL::to('/') }}/search"><img class="search_icon" src="/assets/images/search.png" /> Explore</a>
		<a class="dropdown-item" href="{{ URL::to('/') }}/user/logout"><i class="fa fa-sign-out"></i>  Logout</a>
	  </div>
	</div>
	@else
		// <div class="top_menu_logout_block top_menu_block">
		// 	<a class="btn btn-primary" href="/user/login">Login</a> <span class="white">or</span>
		// 	<a class="btn btn-primary" href="/user/register">Sign up</a>
		// </div>
		<div class='menu'> 
			<a href="{{ Auth::guard('user')->check() ? URL::to('/').'/user/my_account' : URL::to('/') }}">
				<img src='/assets/images/SmallLogo.png' alt='Small_Logo' class='logoSmall'>
			</a>
        <a class='signup' href="/user/register">Sign up</a>
        <a class='login' href="/user/login">Login</a>
      </div>
	@endif
  </nav>


