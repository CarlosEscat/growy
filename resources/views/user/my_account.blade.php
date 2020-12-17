@extends('layouts.front')
@section('content')

<style>

  .background {
    text-align: center;
    height:  max-content;
    width: 100%;
    background: #E1E3DD;
    box-shadow: 
        inset 0px 11px 8px -10px #000000,
        inset 0px -11px 8px -10px #000000; 
    padding-top: 100px;
	}

	.my_profile {
		width: 333px;
		height: 74px;
		margin-left:5%;
		width: 333px;
		height: 74px;
		background: #FFFFFF;
		border-radius: 10px;
		box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	}
	
	.header_color {
		background: #B7B1D8;
		margin: auto;
		margin-top:2%;
		width: 60%;
		height: 54.39px;
		border-radius: 10px 10px 0px 0px;
	}

  .account_container {
		text-align: left;
    background:white;
    border-radius: 0px 0px 10px 10px;
    height: max-content;
    margin: auto;
    width: 60%;
  	box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
	}

	.edit_profyle {
		text-align:right;
		width:95%;
		bottom:0;
		height:50px;
		margin-top: 30px;
	}

	.button_create_opportunity {
		margin-top:5%;
		width: 310px;
		height: 44px;
		color:white;
		background: #3170AF;
		box-shadow: 0px 4px 4px rgba(50, 39, 95, 0.5);
		border-radius: 10px;
		border:0px;
	}

	.button_create_open {
		margin-top:5%;
		width: 310px;
		height: 44px;
		color:white;
		background: #65C5BF;
		box-shadow: 0px 4px 4px rgba(50, 39, 95, 0.5);
		border-radius: 10px;
		border:0px;
	}
	
</style>



<!-- Content -->
 <!-- <header class="space_lab_main_content bottom_header_block">
			

    
  </header> -->

	<div class='background'>
		@if($owner === true)
			<div class="my_profile">
				<h2 style="color:#332960;padding-top:4%;font-weight:600;"><img src="../assets/images/icon-profile1.png"/> My Profile</h2>
			</div>
		@endif

		<div class='header_color'></div> 

  	<div class='account_container'>
			@if($owner === false)
			<div class="user_profile_actions_block">
				<a class="growyspace_btn growyspace-toggle" gys-toggle-id='view_collections_block' href=""><span><img class="add_to_my_collection_icon" src="/assets/images/add_to_my_collection.png" /></span> Add to my collection</a>
				<a class="growyspace_btn" href="/messages/{{ $user->id }}"><span><img src="/assets/images/send_message.png" /></span> Send message</a>
				<div gys-toggle="view_collections_block" class="hidden collections_block">
					<ul class="view_user_collections_block">
						{!! $collections_html !!}
					</ul>
				</div>
				<button class="hidden btn btn-light dropdown-toggle" type="button" id="opt_view" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="sr-only"></span>
				</button>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="opt_view">
					<li><a data-user-id="" class="dropdown-item send_a_message" href="/messages/{{ $user->id }}"> Send a message</a></li>
					
					<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle add_to_my_collection_link" href="#">Add to my collection</a>
						<ul class="view_user_collections_block dropdown-menu">
							{!! $collections_html !!}
						</ul>
					</li>
				</div>
			</div>
			@endif

			<div style="position:relative;height:100%;" class="row1 container">
			@if($user->is_deleted == 1)
				<div class="canceleld_account_info_text alert alert-danger" role="alert">
					This account has been cancelled, please contact Support 
				</div>
			
			@endif
			<div style="display:flex;">
        <div>   
				@if($profile_image_src !== false)
			    <img class="profile_pic_wrapper profile_pic_wrapper_rounded" src="{{ $profile_image_src }}" />
				@else
				@if($owner === true)
					<img class="profile_pic_wrapper" src="{{ URL::to('/') }}/assets/images/profile_pic_wrapper.png" />
				@else
					<img class="profile_pic_wrapper" src="{{ URL::to('/') }}/assets/images/profile_pic_wrapper2.png" />
				@endif
				@endif
				</div>
				<div class="profile_name_profession_block">
				<h1 style="color:black;font-weight: 600;" class="text-whit">{{ $user->full_name }}</h1>
				<p style="color:black;"  class="profession_label">{{ $user->profession }} 
					@if($owner === true)
						<!-- <img class="profession_update_link" src="../assets/images/edit_icon.png"> -->
					@endif
				</p>
				<p><img class="profession_update_link" src="../assets/images/location.png">  {{ $user->city }}, {{ $country }}</p>
				</div>
			</div>

				<div style="text-align=left;" class="card-body">
					<h3 style="font-weight: 600;" class="card-title">Presentation letter</h3>
					<p class="card-text">{{ $user->my_pitch }} {!! $owner === true ? '<span style="cursor:pointer;" class="hidden my_pitch_update_link fa fa-pencil"></span>' :'' !!}
						@if($owner === true)
							<!-- <img class="my_pitch_update_link" src="/assets/images/edit_icon.png" /> -->
						@endif
					</p>
				</div>

				<div class="card-body">
					<h3 style="font-weight:600;" class="card-title">Experience</h3>
					
						@foreach($user_experiences as $ue)
							<div style="display: flex; justify-content: space-around" data-exp-id="{{ $ue->id }}" class="experience_bloc">
								@if($owner === true)
								<!-- <div class="dropdown experience_actions_block">
									<button class="btn btn-light dropdown-toggle" type="button" id="exp{{ $ue->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="sr-only"></span>
									</button>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="ue{{ $ue->id }}">
										<a data-exp-id="{{ $ue->id }}" class="dropdown-item edit_experience_link" href=""> Edit</a>
										<a data-exp-id="{{ $ue->id }}" class="dropdown-item delete_experience_link"> Delete</a>
									</div>
								</div>
								@endif
								@if(is_file(base_path() . '/public/uploads/exp/'.$ue->id.'/'.$ue->company_logo_url))
									<img class="hidden experience_compny_img" src="{{ URL::to('/') }}/uploads/exp/{{ $ue->id }}/{{ $ue->company_logo_url }}" />
								@else
									<img class="hidden experience_bag" src="{{ URL::to('/') }}/assets/images/bag.png" />
								@endif -->
								<div class="hidden experience_block_bottom"></div>
								 	<div>
										<h2>{{ strlen($ue->title) > 20 ? substr($ue->title,0,20).'...' : $ue->title }}</h2>
										<p><span class="fa fa-map-marker"></span> {{ (isset($countries[$ue->country_code]) ? $countries[$ue->country_code] : '' ) .' '.$ue->city }}</p>
									</div>
									<div>
										<h4>{{ strlen($ue->company) > 20 ? substr($ue->company,0,20).'...' : $ue->company }}</h4>
									
										<p>{{ date("m/Y", strtotime($ue->from_date)) }} to 
										@if($ue->currently_working == 1)
											Present
										@else	
											{{ date("m/Y", strtotime($ue->to_date)) }}
										@endif
										</p>
									</div>
							</div>
						@endforeach
					<!-- @if($owner === true)
					<div class="add_my_experience_link_block">
						<img class="add_my_experience_link" src="/assets/images/plus_icon.png" />
						<i class="hidden add_my_experience_link fa-4x fa fa-plus-circle" aria-hidden="true"></i>
					</div>
					@endif -->
				</div>

				<div class="card-body">
					<h3 style="font-weight:600;" class="card-title">Education</h3>
					@foreach($user_educations as $ue)
						<div style="display: flex; justify-content: space-around" data-edu-id="{{ $ue->id }}" class="edu_bloc">
							<!-- @if($owner === true)
							<div class="dropdown edu_actions_block">
								<button class="btn btn-light dropdown-toggle" type="button" id="edu{{ $ue->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="sr-only"></span>
								</button>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="edu{{ $ue->id }}">
									<a data-edu-id="{{ $ue->id }}" class="dropdown-item edit_education_link" href=""> Edit</a>
									<a data-edu-id="{{ $ue->id }}" class="dropdown-item delete_education_link"> Delete</a>
								</div>
							</div>
							@endif -->
							<img class="hidden edu_block_img" src="{{ URL::to('/') }}/assets/images/hat2.png" />		
							<div class="edu_block_bottom hidden"></div>
							<div>
								<h3 alt="{{ $ue->title }}" >{{ strlen($ue->title) > 20 ? substr($ue->title,0,20).'...' : $ue->title }}</h3>
								<p><span class="fa fa-map-marker"></span> {{ (isset($countries[$ue->country_code]) ? $countries[$ue->country_code] : '' ) .' '.$ue->city }}</p>
							</div>
							<div>
								<h4 alt="{{ $ue->school }}">{{ strlen($ue->school) > 20 ? substr($ue->school,0,20).'...' : $ue->school  }}</h4>
								<p>{{ $ue->from_year }} to {{ $ue->to_year }}</p>		
							</div>
							
							
						</div>
					@endforeach
					<!-- @if($owner === true)
					<div class="add_education_link_block">
						<img class="add_education_link" src="/assets/images/plus_icon.png" />
						<i class="hidden add_education_link fa-4x fa fa-plus-circle" aria-hidden="true"></i>
					</div>
					@endif -->
				</div>

				<div class="edit_profyle">
				<a style="color:#219BC4;font-size:20px;text-decoration:none;margin-right:5%;" href="">Add to collection </a>
				<a style="color:#219BC4;font-size:20px;text-decoration:none;" href="">  <img style="width: 32px;" class="add_education_link" src="../assets/images/Icon-edit-new.png" /> Edit</a>

				</div>
			

			</div>
			
	</div>
	<div style="text-align:right" >
				<button class="button_create_opportunity">Create new Opportunity</button>
	</div>
	<div style="text-align:right;" >
				<button class="button_create_open">Create new Open-to-work</button>
	</div>

</div>

@include('popups.view_opportunity_card')
@include('popups.add_edit_opportunity_card')
@include('popups.add_edit_slills')
@include('popups.add_edit_education')
@include('popups.view_education')
@include('popups.add_edit_experience')
@include('popups.view_experience')
@include('popups.update_profession')
@include('popups.update_my_pitch')
@include('popups.invite_user_to_this_card')
@if($owner === true)
	@include('popups.profile_image') 
@endif
@endsection