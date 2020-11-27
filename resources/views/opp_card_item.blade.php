<div data-opt-id="{{ $opc->id }}" class="opp_card_block">
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
	<h3>{{ strlen($opc->title) > 18 ? substr($opc->title,0,18).'...' : $opc->title }}</h3>
	<h4>{{ strlen($opc->company) > 18 ? substr($opc->company,0,18).'...' : $opc->company }}</h4> 
	
	<div class="opp_card_block_bottom">
		<p><span class="fa fa-map-marker"></span> {{ (isset($countries[$opc->country_code]) ? $countries[$opc->country_code] : $opc->country_code).', '.$opc->city }}</p>
	</div>
</div>