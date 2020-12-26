@extends('layouts.front')
@section('content')
<script>window.default_msg = '{{ $default_msg }}';</script>
<div id="messages">
	<div class="messages_page container  bg-gray">

		<div class="col-md-10 main_area mt-5 pt-5 margin-0-auto">
			<div class="row mt-3 col-md-12">
				<div class="header">			
				<p style="float: left;"><img src='/assets/images/message_icon1.png' alt='Setting' ><span class="icon_title">Messages</span></p>
				</div>
			</div>

			<div class="row msg_body"> 
				<!-- Header -->
				<div style="min-height:1000px;" class="msg_left col-md-4">
					<div class="messages_conversation_items_block">
						
					</div> 
					<div class="alert alert-light alert-dismissible fade show msg_note">
						<div class="msg_note_cont">Are you looking for other users to connect with? Go to <a href="/search">explore</a> to search for them.</div>
						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
				</div>
				<div style="min-height:300px;" class="{{ $user !== null ? 'load_messages_case' : '' }} messages_right col-md-8">
					@if($user !== null)
						<input type="hidden" class="message_to_id" value="{{ $user->id }}" />
						<a href="/messages" class="btn btn-primary change_chat" data-user-id="{{ $user->id }}" style="width: 100%;color: #fff;text-decoration:none;">Change Chat<img src="/assets/images/mobile_new_message.png" class="{{ $not_read_messages_count > 0 ? '' : 'hidden' }}" style="margin-top: -10px;margin-left: 10px;" /></a>
						<div data-user-id="{{ $user->id }}" class="message_recipient_info_block">
							<!-- <a href="/messages"><img class="messages_back_arrow" src="/assets/images/arrow_back.png" /></a> -->
							<div class="message_recipient_info_name_profession_block">
								<p class="msg_name">{{ $user->full_name }}</p>
								<p class="msg_profession">{{ $user->profession }}</p>
							</div>
							@if($user->profile_image(true) === false) 
								<img class="message_user_profile_image" src="/assets/images/profile_pic_wrapper2.png">
							@else 
								<img class="message_user_profile_image" src="{{ $user->profile_image() }}">
							@endif

							<a href="{{ URL::to('/') }}/user/{{ $user->id }}/view" class="msg_go_profile">Go to Profile</a>
						</div>
						
						<div id="messages_block" class="messages_block msg_block_custom">
							
						</div>
						<div class="messages_input_block">
							
							<div class="input-group mb-3">
							<input type="text" value="{{ $default_msg }}" class="message_input form-control msg_input_custom" placeholder="Type a message..." >
							<img src="/assets/images/message_pin.png" data-to-id="{{ $user->id }}" class="send_message msg_attach">
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