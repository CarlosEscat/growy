@if($users->count() > 0)
	@foreach($users as $u)
		<div data-user-id="{{ $u->id }}" class="search_user_block">
			<div class="hidden dropdown opp_card_actions_block">
				<button class="btn btn-light dropdown-toggle" type="button" id="u{{ $u->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="sr-only"></span>
				</button>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="u{{ $u->id }}">
					@if($u->id != $user_id)
						<li><a data-user-id="" class="dropdown-item send_a_message" href="/messages/{{ $u->id }}"> Send a message</a></li>
					@endif
					<li><a href="#" action_type="remove" collection_user_id = "{{ $u->id }}" item_type="user" collection_id="{{ $collection_id }}" class="dropdown-item add_to_my_collection">Remove from my collection</a></li>
				</div>
			</div>
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
				@if($u->id != $user_id)
				<a data-opt-id="" class="growyspace_btn" href="/messages/{{ $u->id }}"><span><img class="growyspace_btn_icon" src="/assets/images/send_message.png" /></span></a>
				@endif
				<a action_type="remove" collection_user_id = "{{ $u->id }}" item_type="user" collection_id="{{ $collection_id }}" class="add_to_my_collection growyspace_btn" href=""><span><img class="growyspace_btn_icon" src="/assets/images/remove_from_collection.png" /></span></a>
			</div>
			<div class="hidden search_user_location">
			</div>
		</div>
	@endforeach
@endif
@if($opportunity_cards !== null && $opportunity_cards->count() > 0)
	@foreach($opportunity_cards as $opc)
		<div data-opt-id="{{ $opc->id }}" class="opp_card_block">
			
			<div class="dropdown opp_card_actions_block">
				<button class="btn btn-light dropdown-toggle" type="button" id="opt{{ $opc->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="sr-only"></span>
				</button>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="opt{{ $opc->id }}">
					<li><a class="hidden dropdown-item" href="#"> Invite user to this card</a></li>
					<li><a href="#" action_type="remove" collection_opc_id = "{{ $opc->id }}" item_type="opc" collection_id="{{ $collection_id }}" class="dropdown-item add_to_my_collection">Remove from my collection</a></li>
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
@if($users->count() == 0 && $opportunity_cards->count() == 0) 
	<h2>No items</h2>
@endif

<div class="hidden collections_go_to_search_link_block">
	<img class="collections_go_to_search_link" src="/assets/images/plus_icon.png" />
	<i class="hidden collections_go_to_search_link fa-4x fa fa-plus-circle" aria-hidden="true"></i>
</div>