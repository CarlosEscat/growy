@extends('layouts.front')
@section('content')

<script>window.search_url = '{{ $search_url }}';</script>
<div id="explore">
    <div class="container bg-gray">
		<div class="col-md-10 main_area mt-5 pt-5 margin-0-auto pb-5">
            <div class="row mt-3 col-md-12">
				<div class="header">			
				<p style="float: left;"><img src='/assets/images/search_icon.png' alt='Explore' >Explore</p>
				</div>
			</div>
			<div class="row mt-3 col-md-10 margin-0-auto search_pad">
				<div class="col-md-6 p-0 search_filter_item_block_new">
					<img src='/assets/images/search_icon.png' alt='Explore' class="keyword_img">
					<input type="text" name="search" style="border-radius: 5px 0px 0px 5px;height: 44px;" class="form-control search-slt search_input " value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="Search for opportunities, open-to-work cards or users">
				</div>
				<div class="col-md-4 p-0">
					<div class="input-group">
						<select style="width:100%;" multiple class="opc_explore form-control search_city">
							<option value="{{ $city !='' ? $city : '' }}" {{ $city !='' ? 'selected' : '' }}>{{ $city !='' ? $city : '' }}</option>
						</select>
					</div>
				</div>
				<div class="col-md-2 p-0">
					
                    <button type="button" class="btn wrn-btn search search_btn" >Search</button>
                </div>
			</div>

			<div class="col-md-10 row  mt-3 margin-0-auto search_body">
				<div class="col-md-4 left_filter_area">
					<h4>Filter</h4>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" {{ $type == 2 ? 'checked' : '' }} name="type"  value="2">Opportunity
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" {{ $type == 3 ? 'checked' : '' }} name="type" value="3">Open-to-work
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" {{ $type == 1 ? 'checked' : '' }} name="type" value="1">Users
						</label>
					</div>
				</div>	
				<div  class="col-md-8 filter_result">			
				@if($users !== null && $users->count() > 0) 
					@foreach($users as $u)
					<div data-user-id="{{ $u->id }}" class="search_user_block filter_oppbox">
						<div class="card align-last card-custom search_user_rlt_card">
							<p class="search_opt_rlt_card_label">User
								<span class="search_opt_card">
									<img src="/assets/images/location2.png" alt="Location" > 
									<span class="search_opp_city">{{ isset($countries[$u->country_code]) ? $countries[$u->country_code] : $u->country_code }}, {{ $u->city }}</span>
								</span>
							</p>
							<div class="search_opt_card_body">	
									
								@if(is_file(base_path() . '/public/uploads/profile/'.$u->id.'/'.$u->profile_image_cropped))
									<img  style="width: 90px;float: left;margin-right: 18px;" src="{{ URL::to('/') }}/{{ 'uploads/profile/'.$u->id.'/'.$u->profile_image_cropped }}" />
								@else
									<img  style="width: 90px;float: left;margin-right: 18px;" src="{{ URL::to('/') }}/assets/images/no_profile_image.jpg" />
								@endif	
									<p class="search_opt_body_title">{{ $u->full_name }}</p>
									<p style="font-size: 25px;margin: 0px;">{{ $u->profession }}</p>	

								<div class="other_urls">
									
								@if($u->id == $user_id)
									<a href="#" class="text-decoration-none float-right textcolor-blue btn-customs " style="color: #CA7073">Edit</a>  
								@else
									<div>
										<a href="#" data-pk="{{ $u->id }}" data-type="checklist" data-source="{{ URL::to('/') }}/ajax/get_user_collection_list/{{$u->id}}"  data-title="Select collections" class="user_collection editable editable-click float-right  text-decoration-none textcolor-blue btn-customs" data-placement="bottom"   data-original-title="" title="" style="color: #219BC4">Add to collection</a>
									</div>
								@endif
																							
									<a href="/messages/{{ $u->id }}" data-type="checklist"  data-title="Select collections" class="editable editable-click text-decoration-none textcolor-blue float-right btn-customs" data-placement="bottom" data-original-title="" title="">Send a message</a>
									<a href="/user/{{ $u->id }}/view" data-type="text"  class="editable editable-click float-right text-decoration-none textcolor-blue btn-customs" data-placement="bottom" data-original-title="" title="">Go to profile</a>                     
										
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>					
					@endforeach
				@endif

				@if($opportunity_cards !== null && $opportunity_cards->count() > 0)
					@foreach($opportunity_cards as $opc)
					<div data-opt-id="{{ $opc->id }}" class="search_user_block filter_oppbox">
						<div class="card align-last card-custom search_opt_rlt_card">
							<p class="search_opt_rlt_card_label">Oppportunity
								<span class="search_opt_card">
									<img src="/assets/images/location2.png" alt="Location"> 
									<span class="search_opp_city">{{ (isset($countries[$opc->country_code]) ? $countries[$opc->country_code] : $opc->country_code).', '.$opc->city }}</span>
								</span>
							</p>
							<div class="search_opt_card_body">
							
									<p class="search_opt_body_title">{{ strlen($opc->title) > 150 ? substr($opc->title,0,150).'...' : $opc->title }}</p>
									<p class="search_opt_body_company">{{ strlen($opc->company) > 150 ? substr($opc->company,0,150).'...' : $opc->company }}</p>										
								

								<div class="other_urls">
									<div>
										<a href="#" data-pk="{{ $opc->id }}" data-type="checklist" data-source="{{ URL::to('/') }}/ajax/get_opc_collection_list/{{$opc->id}}"  data-title="Select collections" class="opportunity_collection editable editable-click float-right  text-decoration-none textcolor-blue btn-customs" data-placement="bottom"   data-original-title="" title="">Add to collection</a>
									</div>
									<div>                     
										<a href="{{ URL::to('/') }}/opentowork/{{ $opc->id }}/refer" class="text-decoration-none textcolor-blue float-right btn-customs" data-toggle="dropdown">Send Open-to-work</a>    
													
										<div class="dropdown-menu dropdown-menu-right"  style="padding: 0px;">
										@if(count($opt_list) > 0) 
											<ul style="margin: 0px;padding: 0px;">
												@foreach ($opt_list as $item)
													<li class="send_opentowork"><a href="{{ URL::to('/') }}/opentowork/{{ $item->id }}">{{$item->title}}</a></li>
												@endforeach
													<li class="send_opentowork"><a href="{{ URL::to('/') }}/opentowork/{{ $opc->id }}/refer">Create New one</a></li>
											</ul>
										@else
											<li class="send_opentowork"><a href="{{ URL::to('/') }}/opentowork/{{ $opc->id }}/refer">Create New one</a></li>
										@endif
										</div>
									</div>

									<a href="{{ URL::to('/') }}/cards/{{$opc->id}}"  data-type="text" class="editable editable-click float-right text-decoration-none textcolor-blue btn-customs" data-placement="bottom" data-original-title="" title="">Read more</a>                     
									<div class="clearfix"></div>				
								</div>
							</div>
						</div>
					</div>					
					@endforeach
				@endif
				@if($opentowork_cards !== null && $opentowork_cards->count() > 0)
					@foreach($opentowork_cards as $opc)
					<div data-opt-id="{{ $opc->id }}" class="search_user_block filter_optbox">
						<div class="card align-last card-custom search_opp_rlt_card">
							<p class="search_opt_rlt_card_label">Open-to-work
								<span class="search_opt_card">
									<img src="/assets/images/location2.png" alt="Edit" style="width: 15px;"> 
									<span class="search_opp_city">{{ (isset($countries[$opc->country_code]) ? $countries[$opc->country_code] : $opc->country_code).', '.$opc->city }}</span>
								</span>
							</p>
							<div class="search_opt_card_body">
							
									<p class="search_opt_body_title">{{ strlen($opc->title) > 150 ? substr($opc->title,0,150).'...' : $opc->title }}</p>
									<p class="search_opt_body_company">Areas of interest</p>			
		
								<ul class="list-unstyled list-inline margin-0-auto mb-0 request_skills">

									@foreach(json_decode($opc->roles,true) as $oc)
									<li class="list-inline-item mr-0 pr-2" style="margin:0px">
										<div class="chip bgcolor-purple mr-0 chip-custom">{{ $oc }}</div>
									</li>
									@endforeach
								</ul>						
								

								<div style="padding-right: 18px; padding-top:27px;">
									<div>
									<a href="#" data-pk="{{ $opc->id }}" data-type="checklist" data-source="{{ URL::to('/') }}/ajax/get_opentowork_collection_list/{{$opc->id}}"  data-title="Select collections" class="opentowork_collection editable editable-click  float-right  text-decoration-none textcolor-blue btn-customs" data-placement="bottom"   data-original-title="" title="">Add to collection</a>
									</div>
									<div>
										<a href="{{ URL::to('/') }}/opentowork/{{ $opc->id }}/refer" class=" float-right  text-decoration-none textcolor-blue btn-customs" data-toggle="dropdown">Send Opportunity</a>
										<div class="dropdown-menu dropdown-menu-right"  style="padding: 0px;">
										@if(count($opc_list) > 0) 
											<ul style="margin: 0px;padding: 0px;">
												@foreach ($opc_list as $item)
													<li class="send_opentowork"><a href="{{ URL::to('/') }}/cards/{{ $item->id }}">{{$item->title}}</a></li>
												@endforeach
													<li class="send_opentowork"><a href="{{ URL::to('/') }}/cards/{{ $opc->id }}/refer">Create New one</a></li>
											</ul>
										@else
											<li class="send_opentowork"><a href="{{ URL::to('/') }}/cards/{{ $opc->id }}/refer">Create New one</a></li>
										@endif
										</div>
									</div>

									<a href="{{ URL::to('/') }}/cards/{{$opc->id}}"  data-type="text" data-title="Copy this link to share" class="editable editable-click float-right text-decoration-none textcolor-blue btn-customs" data-placement="bottom" data-original-title="" title="">Read more</a>                     
													
								</div>
							</div>
						</div>
					</div>					
					@endforeach
				@endif
				@if($need_to_process_for_searching === true)
					@if(
						($users == null || ($users !== null && $users->count() == 0 )  ) &&
						($opportunity_cards == null || ($opportunity_cards !== null && $opportunity_cards->count() == 0 )  ) 
						&& ($opentowork_cards == null || ($opentowork_cards !== null && $opentowork_cards->count() == 0 )  ) 
					)
						<h2>No search result</h2>
					@endif
				@endif

				</div>
			</div>
			<!-- <div class="alert alert-info text-center" style="width: 55%; margin: 0 auto;position: absolute;bottom: 30px;left: 20%;right: 20%;"> -->
			<div class="alert alert-info text-center" style="">
			Are you looking to create an opportunity or a open-to-work card? Visit your <a href="/user/my_account" style="text-decoration:none; color:#219BC4">profile</a> to create one.
			</div>
		</div>
	</div>
</div>

@include('popups.view_opportunity_card')
@include('popups.add_edit_opportunity_card')
@include('popups.view_user')
@include('popups.invite_user_to_this_card')

@endsection