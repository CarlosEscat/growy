@extends('layouts.front')
@section('content')
<script>window.default_msg = '{{ $default_msg }}';</script>
<div class="messages_page container page-content bg-white">
  	<!-- Breadcrumb row -->
	<div style="margin-top:83px;" class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="{{ URL::to('/') }}">Home</a></li>
				<li class="active">Messages</li>
				
			</ul>
		</div>
	</div>
	<div style="margin-top:30px;margin-bottom:40px;" class="row"> 
		<!-- Header -->
		<div style="min-height:300px;" class="messages_left col-md-4">
			<div class="messages_search_user_input_block">
				<input type="text" placeholder="Search User" class="message_search_user form-control" value="" />
				
			</div>
			<div class="messages_conversation_items_block">
				 
			</div> 
			
		</div>
		<div style="min-height:300px;" class="{{ $user !== null ? 'load_messages_case' : '' }} messages_right col-md-8">
			@if($user !== null)
				<input type="hidden" class="message_to_id" value="{{ $user->id }}" />
				<div data-user-id="{{ $user->id }}" class="message_recipient_info_block">
					<a href="/messages"><img class="messages_back_arrow" src="/assets/images/arrow_back.png" /></a>
					<div class="message_recipient_info_name_profession_block">
						<h2>{{ $user->full_name }}</h2>
						<h3>{{ $user->profession }}</h3>
					</div>
					@if($user->profile_image(true) === false) 
						<img class="message_user_profile_image" src="/assets/images/profile_pic_wrapper2.png">
					@else 
						<img class="message_user_profile_image" src="{{ $user->profile_image() }}">
					@endif
				</div>
				
				<div id="messages_block" style="margin-top: 18px;position:relative;height:400px;overflow-y:scroll;padding: 12px;" class="messages_block">
					<!--<div class="incoming_msg">
						<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
						<div class="received_msg">
							<div class="received_withd_msg">
							  <p>Test which is a new approach to have all
								solutions</p>
							<span class="time_date"> 11:01 AM    |    June 9</span></div>
						</div>
					</div>
					<div class="outgoing_msg">
						<div class="sent_msg">
							<p>Test which is a new approach to have all solutions</p>
							<span class="time_date"> 11:01 AM    |    June 9</span> 
						</div>
					</div>-->
				</div>
				<div class="messages_input_block">
					
					<div class="input-group mb-3">
					  <input type="text" value="{{ $default_msg }}" class="message_input form-control" placeholder="Send a message..."  style="z-index:0">
					  <div style="margin-left: 6px;" class="input-group-append">
						<i style="font-size:34px;color:#00A8E1;cursor:pointer;" data-to-id="{{ $user->id }}" class="send_message fa fa-paper-plane-o" aria-hidden="true"></i> 
					   </div>
					</div>
				</div>
			@endif
		</div>
    </div>
	
	
</div>

@include('popups.view_opportunity_card')
@endsection