@extends('layouts.front')
@section('content')
<!-- Content -->
 <header class="space_lab_main_content bottom_header_block">
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
           
			@if($profile_image_src !== false)
			    <img class="profile_pic_wrapper profile_pic_wrapper_rounded" src="{{ $profile_image_src }}" />
			@else
				@if($owner === true)
					<img class="profile_pic_wrapper" src="{{ URL::to('/') }}/assets/images/profile_pic_wrapper.png" />
				@else
					<img class="profile_pic_wrapper" src="{{ URL::to('/') }}/assets/images/profile_pic_wrapper2.png" />
				@endif
			@endif
			<div class="profile_name_profession_block">
				<h1 class="text-white">{{ $user->full_name }}</h1>
				<p class="profession_label">{{ $user->profession }} 
					@if($owner === true)
						<img class="profession_update_link" src="/assets/images/edit_icon.png">
					@endif
				</p>
			</div>
       
      
    </div>
  </header>
<div class="container page-content bg-white">
  	<!-- Breadcrumb row -->
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="{{ URL::to('/') }}">Home</a></li>
				<li>My Account</li>
				<li class="active">{{ $user->full_name }}</li>
			</ul>
		</div>
	</div>
	<div class="row"> 
	 <!-- Header -->
		<div class="col-md-12 mb-5">
			<div class="card h-100 spacelab_spec_border_bottom">
				<div style="padding: 10px 10px 0px 10px;" class="card-body">
					<p style="float:left;margin-bottom:0;" class="card-text"><span class="fa fa-map-marker"></span> {{ $user->city }}, {{ $country }}</p>
					<!-- Material switch -->
					<div style="visibility:hidden;float:right;" class="switch">
					  <label>
						<span class="available_label">{{ $user->available == 1 ? 'Available' : 'Not available' }}</span>
						<input type="checkbox" name="available" {{ $owner === true ? '' : 'disabled' }}  {{ $user->available == 1 ? 'checked' : '' }} value="1">
						<span class="lever"></span> 
					  </label>
					</div>
				</div>
			</div>
		</div>
    </div>
	<div class="row"> 
	 <!-- Header -->
		<div class="col-md-12 mb-5">
			<div class="card h-100 spacelab_spec_border_bottom">
				<div class="card-body">
					<h4 class="card-title">My pitch</h4>
					<p class="card-text">{{ $user->my_pitch }} {!! $owner === true ? '<span style="cursor:pointer;" class="hidden my_pitch_update_link fa fa-pencil"></span>' :'' !!}
						@if($owner === true)
							<img class="my_pitch_update_link" src="/assets/images/edit_icon.png" />
						@endif
					</p>
				</div>
			</div>
		</div>
    </div>
	<div class="row"> 
	 <!-- Header -->
		<div class="col-md-12 mb-5">
			<div class="card h-100">
				<div class="card-body">
					<h3 class="card-title">Opportunity cards</h3>
					@foreach($opportunity_cards as $opc)
						<div data-opt-id="{{ $opc->id }}" class="opp_card_block">
							
							<div class="dropdown opp_card_actions_block">
								<button class="btn btn-light dropdown-toggle" type="button" id="opt{{ $opc->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="sr-only"></span>
								</button>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="opt{{ $opc->id }}">
									@if($owner === true)
									<a data-opt-id="{{ $opc->id }}" class="dropdown-item invite_user_to_this_card" href="#"> Invite user to this card</a>
									<a href="{{ URL::to('/') }}/cards/{{$opc->id}}/edit" data-opt-id="{{ $opc->id }}" class="dropdown-item edit_opportunity_card_link_new" href=""> Edit</a>
									<a data-opt-id="{{ $opc->id }}" class="dropdown-item delete_opportunity_card_link"> Delete</a>
									@endif
									<a data-opt-id="{{ $opc->id }}" href="/cards/{{ $opc->id }}" class="dropdown-item">Expand</a>
								</div>
							</div>
							
						
							@if(is_file(base_path() . '/public/uploads/opc/'.$opc->id.'/'.$opc->company_logo_url))
								<img class="hidden opp_card_compny_img" src="{{ URL::to('/') }}/uploads/opc/{{ $opc->id }}/{{ $opc->company_logo_url }}" />
							@endif
								<h3>{{ strlen($opc->title) > 18 ? substr($opc->title,0,18).'...' : $opc->title }}</h3>
								<h4>{{ strlen($opc->company) > 18 ? substr($opc->company,0,18).'...' : $opc->company }}</h4> 
							
							<div class="opp_card_block_bottom">
								<p><span class="fa fa-map-marker"></span> {{ (isset($countries[$opc->country_code]) ? $countries[$opc->country_code] : $opc->country_code).', '.$opc->city }}</p>
							</div>
						</div>
					@endforeach
					@if($owner === true)
					<div class="add_opportuniti_card_link_block">
						<a href="{{ URL::to('/') }}/cards"><img  src="/assets/images/plus_icon_green.png" />
						<i class="hidden add_opportuniti_card_link fa-4x fa fa-plus-circle" aria-hidden="true"></i>
						</a>
					</div>
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-12 mb-5">
			<div class="card h-100">
				<div class="card-body">
					<h3 class="card-title">My experience</h3>
					
						@foreach($user_experiences as $ue)
							<div data-exp-id="{{ $ue->id }}" class="experience_block">
								@if($owner === true)
								<div class="dropdown experience_actions_block">
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
								@endif
								<div class="hidden experience_block_bottom"></div>
									<h2>{{ strlen($ue->title) > 20 ? substr($ue->title,0,20).'...' : $ue->title }}</h2>
									<h3>{{ strlen($ue->company) > 20 ? substr($ue->company,0,20).'...' : $ue->company }}</h3>
									<p><span class="fa fa-map-marker"></span> {{ (isset($countries[$ue->country_code]) ? $countries[$ue->country_code] : '' ) .' '.$ue->city }}</p>
									
									<p>{{ date("m/Y", strtotime($ue->from_date)) }} to 
									@if($ue->currently_working == 1)
										Present
									@else	
										{{ date("m/Y", strtotime($ue->to_date)) }}
									@endif
									</p>
							</div>
						@endforeach
					@if($owner === true)
					<div class="add_my_experience_link_block">
						<img class="add_my_experience_link" src="/assets/images/plus_icon.png" />
						<i class="hidden add_my_experience_link fa-4x fa fa-plus-circle" aria-hidden="true"></i>
					</div>
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-12 mb-5">
			<div class="card h-100">
				<div class="card-body">
					<h3 class="card-title">Skills</h3>
					@foreach($user_skills as $skill)
						<span class="user_skill_item_block"><span class="user_skill_item">{{ $skill }}</span> 
						@if($owner === true)
						<img data-skill="{{ $skill }}" class="delete_user_skill" src="/assets/images/close_icon.png?{{ time() }}" /> 
						@endif
						{!! $owner === true ? '<i data-skill="'.$skill.'" class="hidden delete_user_skill fa fa-times-circle-o" aria-hidden="true"></i>' : '' !!}</span>
					@endforeach
					@if($owner === true)
					<span class="manage_skill_link_block"> 
						<img class="manage_skill_link" src="/assets/images/plus_icon.png" />
						<i class="hidden manage_skill_link fa-4x fa fa-plus-circle" aria-hidden="true"></i>
					</span>
					
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-12 mb-5">
			<div class="card h-100">
				<div class="card-body">
					<h3 class="card-title">Education</h3>
					@foreach($user_educations as $ue)
						<div data-edu-id="{{ $ue->id }}" class="edu_block">
							@if($owner === true)
							<div class="dropdown edu_actions_block">
								<button class="btn btn-light dropdown-toggle" type="button" id="edu{{ $ue->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="sr-only"></span>
								</button>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="edu{{ $ue->id }}">
									<a data-edu-id="{{ $ue->id }}" class="dropdown-item edit_education_link" href=""> Edit</a>
									<a data-edu-id="{{ $ue->id }}" class="dropdown-item delete_education_link"> Delete</a>
								</div>
							</div>
							@endif
							<img class="hidden edu_block_img" src="{{ URL::to('/') }}/assets/images/hat2.png" />		
							<div class="edu_block_bottom hidden"></div>
							<h3 alt="{{ $ue->title }}" >{{ strlen($ue->title) > 20 ? substr($ue->title,0,20).'...' : $ue->title }}</h3>
							<h4 alt="{{ $ue->school }}">{{ strlen($ue->school) > 20 ? substr($ue->school,0,20).'...' : $ue->school  }}</h4>
							<p><span class="fa fa-map-marker"></span> {{ (isset($countries[$ue->country_code]) ? $countries[$ue->country_code] : '' ) .' '.$ue->city }}</p>
							<p>{{ $ue->from_year }} to {{ $ue->to_year }}</p>		
						</div>
					@endforeach
					@if($owner === true)
					<div class="add_education_link_block">
						<img class="add_education_link" src="/assets/images/plus_icon.png" />
						<i class="hidden add_education_link fa-4x fa fa-plus-circle" aria-hidden="true"></i>
					</div>
					@endif
				</div>
			</div>
		</div>
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