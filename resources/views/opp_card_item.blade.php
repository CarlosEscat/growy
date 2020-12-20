<div data-opt-id="{{ $opc->id }}" class="opp_card_block msg_block">
	@if(false && $opc->user_id == $user_id)
	<div class="dropdown opp_card_actions_block">
		<button class="btn btn-light dropdown-toggle" type="button" id="opt{{ $opc->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="sr-only"></span>
		</button>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="opt{{ $opc->id }}">
			<a class="dropdown-item" href="#"> Invite user to this card</a>
			<a data-opt-id="{{ $opc->id }}" class="dropdown-item edit_opportunity_card_link" href=""> Edit</a>
			<a data-opt-id="{{ $opc->id }}" class="dropdown-item delete_opportunity_card_link"> Delete</a>
		</div>
	</div>
	@endif
	@if($url == 'collections')
		<img src="/assets/images/collection_header_icon.png" alt="sunil" style="float: left;width: 57px;margin: 13px 0px 0px 12px;">
		<div style="font-size: 20px;font-weight: 600;margin: 0px;padding-top: 16px;padding-left: 14px;width: 80%;float: left;">
			<p>{{$name}}</p>
			<p>Created by: <span>{{$user}}</span></p>
		</div>
		<a href="{{ URL::to('/') }}/{{$url}}/{{ $opc->id }}" style="text-decoration: none;color: #58C0FA;font-weight: 500;font-size: 20px;position: absolute;bottom: 12px;right: 12px;">Go to Collection</a>

	@else
		<p style="font-size: 20px;font-weight: 600; margin: 0px;padding-top: 20px;padding-left: 14px;">{{$name}}</p>
		@if($url == 'user')
			<p style="font-size: 18px;margin: 0px;padding-top: 18px;padding-left: 14px;">{{ strlen($opc->full_name) > 50 ? substr($opc->full_name,0,50).'...' : $opc->full_name }}</p>
		@else
			<p style="font-size: 18px;margin: 0px;padding-top: 18px;padding-left: 14px;">{{ strlen($opc->title) > 50 ? substr($opc->title,0,50).'...' : $opc->title }}</p>
		@endif
		
		<p class="location_icon" style="margin:0px;font-size: 18px;padding-left: 14px;"><img src="/assets/images/{{ $msg_state == 'inbox' ? 'location.png' : 'location2.png' }}" alt="Location" > <span class="">{{ $opc->city }}, {{ isset($countries[$opc->country_code]) ? $countries[$opc->country_code] : '' }} </span></p>
		<a href="{{ URL::to('/') }}/{{$url}}/{{ $opc->id }}{{ $url == 'user' ? '/view' : '' }}" style="text-decoration: none;color: #58C0FA;font-weight: 500;font-size: 20px;position: absolute;bottom: 12px;right: 12px;">Go to {{$name}}</a>

	@endif


</div>