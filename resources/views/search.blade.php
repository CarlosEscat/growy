@extends('layouts.front')
@section('content')

<script>window.search_url = '{{ $search_url }}';</script>
<div class="container page-content bg-white">
  	<!-- Breadcrumb row -->
	<div style="margin-top:83px;" class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="{{ URL::to('/') }}">Home</a></li>
				<li>Search</li>
				@if($type != 0) 
				<li class="active">
					@if($type == 1)
						Users
					@else
						Opportunities
					@endif
				</li>
				@endif
			</ul>
		</div>
	</div>
	<div style="margin-top:30px;margin-bottom:40px;" class="row"> 
	 <!-- Header -->
		<div style="min-height:300px;" class="col-md-4">
			<div class="search_button_block">
				<button style="width:100%;" class="btn btn-primary search">Search</button>
			</div>
			<div class="search_filter_item_block">
				<h4>Search for</h4>
				<label>
					<input {{ $type == 1 ? 'checked' : '' }} type="radio" name="type" value="1" /> Users
				</label>
				<label>
					<input {{ $type == 2 ? 'checked' : '' }} type="radio" name="type" value="2" /> Opportunities
				</label>
			</div>
			@if($type == 1 || $type == 2)
			<div class="search_filter_item_block">
				<h4><span class="fa fa-map-marker"></span> Location</h4>
				<select style="width:47%;float:left;" class="search_country_code form-control">
					<option value="">Country</option>
					@foreach($countries as $c_code => $c)
						<option {{ $country == $c_code ? 'selected' : '' }} value="{{ $c_code }}">{{ $c }}</option>
					@endforeach
				</select>
				<input type="text" placeholder="City" style="width:47%;float:right;" class="search_city form-control" value="{{ $city }}" />
			</div>
			@endif
			@if($type == 2)
				@if(false)
				<div class="search_filter_item_block">
					<h4> Field</h4>
					<select style="width:100%;" multiple name="" class="search_opc_fields form-control">
						@foreach($all_opc_fields as $f)	
							<option {{ in_array($f,$opc_fields) ? 'selected' : '' }} value="{{ $f }}">{{ $f }}</option>
						@endforeach
					</select>
				</div>
				<div class="search_filter_item_block">
					<h4> Salary</h4>
					<select style="width:47%;float:left;" class="search_from_salary form-control">
						<option value="">From</option>
						@for($i = 0;$i<=10000;$i += 1000)
							
							<option {{ trim($from_salary) != '' && $from_salary == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
							@if($i == 0)
								<option {{ trim($from_salary) != '' && $from_salary == 1 ? 'selected' : '' }} value="1"><1000</option>
							@endif
						@endfor
					</select>
					<select style="width:47%;float:right;" class="search_to_salary form-control">
						<option value="">To</option>
						@for($i = 0;$i<=10000;$i += 1000)
							<option {{ trim($to_salary) != '' && $to_salary == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
							@if($i == 0)
								<option {{ trim($to_salary) != '' && $to_salary == 999 ? 'selected' : '' }} value="999"><1000</option>
							@endif
						@endfor
					</select>
				</div>
				<div class="search_filter_item_block">
					<h4> Hours per week</h4>
					<select style="width:47%;float:left;" class="search_from_hour form-control">
						<option value="">From</option>
						@for($i = 0;$i<=40;$i += 5)
							<option {{ trim($from_hour) != '' && $from_hour == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
						@endfor
					</select>
					<select style="width:47%;float:right;" class="search_to_hour form-control">
						<option value="">To</option>
						@for($i = 0;$i<=40;$i += 5)
							<option {{ trim($to_hour) != '' && $to_hour == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
						@endfor
					</select>
				</div>
				@endif
			@endif
			@if($type == 1)
				@if(false)
					<div class="search_filter_item_block">
						<h4> Profession</h4>
						<input type="text" placeholder="Type a profession" class="form-control search_profession" value="{{ $profession }}" />
					</div>
					<div class="search_filter_item_block">
						<h4> Education</h4>
						<input type="text" placeholder="Type a instituion or title" class="form-control search_education" value="{{ $education }}" />
					</div>
					<div class="search_filter_item_block">
						<h4> Availablity</h4>
						<label>
							<input type="checkbox" {{ in_array(1,$available) ? 'checked' : '' }} class="search_availability" name="availability[]" value="1" /> Avilable
						</label>
						<label>
							<input type="checkbox" {{ in_array(2,$available) ? 'checked' : '' }} class="search_availability" name="availability[]" value="2" /> Not available
						</label>
					</div>
					<div class="search_filter_item_block">
						<h4> Skillset</h4>
						<select placeholder="Skills" style="width:100%;" multiple name="" class="search_skills form-control">
							@foreach($all_skills as $s)	
								<option {{ in_array($s,$skills) ? 'selected' : '' }} value="{{ $s }}">{{ $s }}</option>
							@endforeach
						</select>
					</div>
				@endif
			@endif
			
		</div>
		<div style="min-height:300px;" class="col-md-8">
			@if($opportunity_cards !== null && $opportunity_cards->count() > 0)
				@foreach($opportunity_cards as $opc)
					<div data-opt-id="{{ $opc->id }}" class="opp_card_block">
						
						<div class="dropdown opp_card_actions_block">
							<button class="btn btn-light dropdown-toggle" type="button" id="opt{{ $opc->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only"></span>
							</button>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="opt{{ $opc->id }}">
								@if($opc->user_id == $user_id)
									<a data-opt-id="{{ $opc->id }}" class="dropdown-item invite_user_to_this_card" href="#"> Invite user</a>
									<a data-opt-id="{{ $opc->id }}" class="dropdown-item" href="/cards/{{ $opc->id }}"> Expand</a>
									<a data-opt-id="{{ $opc->id }}" class="dropdown-item edit_opportunity_card_link" href=""> Edit</a>
									<a data-opt-id="{{ $opc->id }}" class="dropdown-item delete_opportunity_card_link"> Delete</a>
								@else
									<li class="dropdown-submenu"><a data-opt-id="{{ $opc->id }}" class="dropdown-item dropdown-toggle get_opc_collections " href="#">Add to my collection</a>
										<ul class="view_collections_block dropdown-menu">
											
										</ul>
									</li>
									
								@endif
							</div>
						</div>
						
						
						<h3>{{ strlen($opc->title) > 22 ? substr($opc->title,0,22).'...' : $opc->title }}</h3>
						<h4>{{ strlen($opc->company) > 22 ? substr($opc->company,0,22).'...' : $opc->company }}</h4> 
						
						<div class="opp_card_block_bottom">
							<p><span class="fa fa-map-marker"></span> {{ (isset($countries[$opc->country_code]) ? $countries[$opc->country_code] : $opc->country_code).', '.$opc->city }}</p>
						</div>
					</div>
				@endforeach
			@endif
					
			@if($users !== null && $users->count() > 0) 
				@foreach($users as $u)
				<div data-user-id="{{ $u->id }}" class="search_user_block">
					@if(is_file(base_path() . '/public/uploads/profile/'.$u->id.'/'.$u->profile_image_cropped))
						<img class="search_profile_image" src="{{ URL::to('/') }}/{{ 'uploads/profile/'.$u->id.'/'.$u->profile_image_cropped }}" />
					@else
						<img class="search_no_profile_image" src="{{ URL::to('/') }}/assets/images/no_profile_image.jpg" />
					@endif
					<div class="search_user_info_block">
						<h3>{{ $u->full_name }}</h3>
						<h4>{{ $u->profession }}</h4>
						<p><span class="fa fa-map-marker"></span> {{ isset($countries[$u->country_code]) ? $countries[$u->country_code] : $u->country_code }}, {{ $u->city }}</p>
					</div>
					<div class="search_user_actions_block">
						<a data-opt-id="" class="growyspace_btn" href="/messages/{{ $u->id }}"><span><img class="growyspace_btn_icon" src="/assets/images/send_message.png" /></span></a>
						<a data-user-id="{{ $u->id }}" gys-toggle-id='view_collections_block_u{{ $u->id }}' class="get_user_collections growyspace-toggle growyspace_btn" href="#"><span><img class="growyspace_btn_icon" src="/assets/images/add_to_my_collection.png" /></span></a>
						<div gys-toggle="view_collections_block_u{{ $u->id }}" class="hidden collections_block">
							<ul class="view_collections_block">
								
							</ul>
						</div>
					</div>
					<div class="hidden search_user_location"></div>
				</div>
				@endforeach
			@endif
			
			@if($need_to_process_for_searching === true)
				@if(
					($users == null || ($users !== null && $users->count() == 0 )  ) &&
					($opportunity_cards == null || ($opportunity_cards !== null && $opportunity_cards->count() == 0 )  ) 
				)
					<h2>No search result</h2>
				@endif
			@endif
		</div>
    </div>
	
	
</div>

@include('popups.view_opportunity_card')
@include('popups.add_edit_opportunity_card')
@include('popups.view_user')
@include('popups.invite_user_to_this_card')

@endsection