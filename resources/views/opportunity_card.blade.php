@extends('layouts.front')
@section('content') 

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div style="min-height:500px;" class="messages_page container page-content bg-white">
	<!-- Breadcrumb row -->
	<div style="margin-top:83px;" class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="{{ URL::to('/') }}">Home</a></li>
				<li class="active">{{ $opc->title }}</li>
				
			</ul>
		</div>
	</div>
	<div  class="public_opp_card_block">
		
		<div class="public_opp_card_block_top">
			<h3>{{ $opc->title }}</h3>
			<h4>{{ $opc->company }}</h4> 
			<a data-opt-id="" class="growyspace_btn public_send_message_card_owner" href="/messages/{{ $opc->user_id }}"><span><img src="/assets/images/send_message.png" /></span> Send message</a>
		</div>
		<div class="public_opp_card_block1">
			<p> <span style="margin-left:8px;" class="fa fa-map-marker"></span> <span class="">{{ isset($countries[$opc->country_code]) ? $countries[$opc->country_code] : '' }}, {{ $opc->city }}</span></p>
		</div>
		
		<div class="socoal_buttons_block">
			<div class="fb-share-button" data-href="http://growyspace.com/cards/{{ $opc->id }}" data-layout="button" data-size="small"><a target="_blank" href="http://growyspace.com/cards/{{ $opc->id }}" class="fb-xfbml-parse-ignore">Share</a></div>
			<script type="IN/Share" data-size="large" data-url="http://growyspace.com/cards/{{ $opc->id }}"></script>
		</div>
		
		
		<div class="public_opp_card_fields_block">
			<h4>Field</h4>
			<div class="view_opp_card_fields_wrapper">
				@foreach($opc_fields as $oc)
				<span class="public_opp_card_field">{{ $oc }}</span>
				@endforeach
				
			</div>
		</div>
		
		
		@if(is_file(base_path() . '/public/uploads/opc/'.$opc->id.'/'.$opc->company_logo_url))
			<img class="public_opp_card_compny_img" src="{{ URL::to('/') }}/uploads/opc/{{ $opc->id }}/{{ $opc->company_logo_url }}" />
		@endif
		<div class="public_opp_card_desc">
			<h4>Description</h4>
			<p>{!! nl2br($opc->description) !!}
			
			</p>
		</div>
	</div>
</div>
@endsection