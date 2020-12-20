@extends('layouts.front')
@section('content')
<script>window.default_msg = '{{ $default_msg }}';</script>
<div id="collections">
	<div class="messages_page container  bg-gray">

		<div class="col-md-10 main_area mt-5 pt-5 margin-0-auto">
			<div class="row mt-3 col-md-12">
				<div class="header">			
				<p style="float: left;"><img src='/assets/images/message_icon1.png' alt='Setting' >Messages</p>
				</div>
			</div>

			<div style="margin-top:30px;margin-bottom:40px;" class="row"> 
				<!-- Header -->
				<div style="min-height:1000px;" class="msg_left col-md-4">
					<!-- <div class="messages_search_user_input_block">
						<input type="text" placeholder="Search User" class="message_search_user form-control" value="" />
						
					</div> -->
					<div class="messages_conversation_items_block">
						
					</div> 
					
				</div>
				<div style="min-height:300px;" class="{{ $user !== null ? 'load_messages_case' : '' }} messages_right col-md-8">
					@if($user !== null)
						<input type="hidden" class="message_to_id" value="{{ $user->id }}" />
						<div data-user-id="{{ $user->id }}" class="message_recipient_info_block">
							<a href="/messages"><img class="messages_back_arrow" src="/assets/images/arrow_back.png" /></a>
							<div class="message_recipient_info_name_profession_block">
								<p style="font-size: 26px;margin: 0px;">{{ $user->full_name }}</p>
								<p style="font-size: 20px;margin: 0px;">{{ $user->profession }}</p>
							</div>
							@if($user->profile_image(true) === false) 
								<img class="message_user_profile_image" src="/assets/images/profile_pic_wrapper2.png">
							@else 
								<img class="message_user_profile_image" src="{{ $user->profile_image() }}">
							@endif

							<a href="{{ URL::to('/') }}/user/{{ $user->id }}/view" style="position: absolute;right: 20px;bottom: 15px;color: #219BC4;text-decoration: none;">Go to Profile</a>
						</div>
						
						<div id="messages_block" style="position:relative;height:400px;overflow-y:scroll;padding: 12px;background:#fff;" class="messages_block">
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
							<input type="text" value="{{ $default_msg }}" class="message_input form-control" placeholder="Type a message..."  style="z-index:0;background: #FFFFFF; border: 0.5px solid #000000;box-sizing: border-box;height: 58px;">
							<img src="/assets/images/message_pin.png" data-to-id="{{ $user->id }}" class="send_message" style="    position: absolute; right: 20px;top: 6px;">
							</div>
						</div>
					@endif
				</div>
			</div>
		
		</div>
	</div>
</div>

@include('popups.view_opportunity_card')
@endsection