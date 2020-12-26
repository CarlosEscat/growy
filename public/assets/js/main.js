$(document).ready(function() {
	
	$('.public_send_message_card_owner').click(function(){
		if(window.is_logged_in == '0') {
			$.notify({
				// options
				message: 'Please login to send message' 
			},{
				// settings
				type: 'danger',
				placement: {
					align: 'center'
				},
				delay:1000,
				z_index:20000
			});
			
			return false;
		}
	});
	
	if($('.messages_page').length > 0) {
		messages_page_design_controller();
		
		$( window ).resize(function() {
			messages_page_design_controller();
		});
	}
	//search page
	if($('#explore').length > 0) {
		search_page_design_controller();
		
		$( window ).resize(function() {
			search_page_design_controller();
		});
	} 
	
	$(document).on('click','.growyspace-toggle',function(){
		var t_id = $(this).attr('gys-toggle-id');
		var t = $('[gys-toggle="'+t_id+'"]');
		
		if(t.hasClass('hidden')) {
			t.removeClass('hidden');
		} else {
			t.addClass('hidden');
		}
		
		return false;
	});
	
	$('.message_recipient_info_block').click(function(e) {
		var tmp1 = $(e.target).hasClass('messages_back_arrow');
		
		if(tmp1 === false) {
			var user_id = $(this).attr('data-user-id');
			window.location.href = '/user/' + user_id + '/view';
			return false;
		}
	});
	
	
	$(".search_filter_item_block_new input").on('keyup', function (e) {
		if (e.keyCode === 13) {
			$('.search').click();
		}
	});

	if(typeof is_logged_in != 'undefined' && is_logged_in == 1) {
		
		setInterval(function(){ 
			get_unread_mesages_info();
		}, 3000);
	}
	
	$('.forgot_password_btn').click(function(){
		var email = $('input[name=email]').val();
		$('.account_email').val(email);
		$('.open_forgot_password_popup').click();
		return false;
	});
	
	$('.request_reset_password').click(function(){
		var account_email = $('.account_email').val();
		
		if($.trim(account_email) == '') {
			$.notify({
				// options
				message: 'Please provide your account email to recover password' 
			},{
				// settings
				type: 'danger',
				placement: {
					align: 'center'
				},
				delay:1000,
				z_index:20000
			});
			
			return false;
		}
		
		if(!validateEmail(account_email)) {
			$.notify({
				// options
				message: 'Please provide a valid email address' 
			},{
				// settings
				type: 'danger',
				placement: {
					align: 'center'
				},
				delay:1000,
				z_index:20000
			});
			return false;
		}
		
		var this_ = $(this);
		var button_text = this_.html();
		this_.html('Processing...');
		this_.prop('disabled', true);
		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/forgot_password_request',
			dataType:'json',
			data:{
				account_email:account_email,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data){
				if(data.complete) {
					$.notify({
						// options
						message: 'You will receive a password regeneration email.' 
					},{
						// settings
						type: 'success',
						placement: {
							align: 'center'
						},
						delay:1000,
						z_index:20000
					});
				} else {
					$.notify({
						// options
						message: data.message 
					},{
						// settings
						type: 'danger',
						placement: {
							align: 'center'
						},
						delay:1000,
						z_index:20000
					});
				}
				
				$('.account_email').val('');
				this_.html(button_text);
				this_.prop('disabled', false);
			}
		});
		return false;
		
	
	});
	
	$('.open_forgot_password_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				
			}
		}
	});
	
	$( ".messages_block" ).scroll(function() {
		//console.log($(this).scrollTop());
		//console.log($(this)[0].scrollHeight);
		//console.log($(this).innerHeight());
		
		
	    if($(this).scrollTop() < 2) {
            var first_msg_id = $('.message_item_row:first-child').attr('data-msg-id');
			
			var message_to_id = $('.message_to_id').val();
			var last_msg_id = $('.message_item_row:last-child').attr('data-msg-id');
			load_messages(message_to_id,last_msg_id,first_msg_id);
        }
	});
	
	
	$('.profile_pic_wrapper').click(function() {
		$('.open_profile_image_popup').click();
		return false;
	});
	
	$('.my_pitch_update_link').click(function() {
		$('.open_update_my_pitch_popup').click();
		return false;
	});
	
	$(document).on('click','.invite_user_to_this_card',function(){
		window.opc_id = $(this).attr('data-opt-id');
		$('.invite_user_to_this_card_popup_wrapper').removeClass('hidden');
		return false;
	});
	
	$('.close_growyspace_popup').click(function(){
		$(this).parents('.invite_user_to_this_card_popup_wrapper').addClass('hidden');;
		return false;
	});
	$('#hideAccount').click(function(){
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/hide_account',
			dataType:'json',
			data:{
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					var messages_html = data.messages_html;
					$.notify({
						// options
						message: messages_html 
					},{
						// settings
						type: 'success',
						placement: {
							align: 'center'
						},
						delay:1000,
						z_index: 5031
					});
					
					setTimeout(function() {
						window.location.reload();
					}, 1000);
				}
			}
		});
		return false;
	});
	$('#deleteAccount').click(function(){
		$.confirm({
			title: 'Delete Collecion',
			content: 'Confirm deletion?',
			buttons: {
				confirm: function () {
					
					$.ajax({
						type:'POST',
						url:base_url + 'ajax/delete_account',
						dataType:'json',
						data:{
							_token: $('._token').val()
						},
						cache: false,
						success:function(data) {
							if (data.complete) {
								var messages_html = data.messages_html;
								$.notify({
									// options
									message: messages_html
								},{
									// settings
									type: 'success',
									placement: {
										align: 'center'
									},
									delay:1000
								});
								
								setTimeout(function() {
									window.location.reload();
								}, 1000);
							
							}
						}
					});
					
					
				},
				cancel: function () {
					
				}
			}
		});

		return false;
	});
	
	
	
	$(document).on('click','.msg_left_item ',function(){
		var user_id = $(this).attr('data-user-id');
		
		if(user_id > 0) {
			window.location.href = "/messages/" + user_id;
		} else {
			return false;
		}
		return false;
	});
	$('.message_input').keyup(function(e){
		if(e.keyCode == 13)
		{
			$('.send_message').click();
		}
	});
	$('.send_message').click(function() {
		var message = $('.message_input').val();
		
		if($.trim(message) == '') {
			$.notify({
				// options
				message: 'Please add message.' 
			},{
				// settings
				type: 'danger',
				placement: {
					align: 'center'
				},
				delay:1000
			});
			return false;
		}
		var to_id = $(this).attr('data-to-id');
		var last_msg_id = $('.message_item_row:last-child').attr('data-msg-id');
		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/send_message',
			dataType:'json',
			data:{
				to_id:to_id,
				last_msg_id:last_msg_id,
				message:message,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					var messages_html = data.messages_html;
					var con_html = data.con_html;
					$('.messages_block').append(messages_html);
					$('.message_input').val('');
					$('.messages_conversation_items_block').html(con_html);
					//scrollToBottom('messages_block');
					$(".messages_block").animate({ scrollTop: $('.messages_block').height() + 100000}, 500);
				
				}
			}
		});
				
		return false;
	});
	 
	if($('.messages_page').length > 0) {
		var message_to_id = $('.message_to_id').val();
		var last_msg_id = $('.message_item_row:last-child').attr('data-msg-id');
						
		load_messages(message_to_id,last_msg_id,null,1);
		
		setInterval(function(){ 
			var last_msg_id = $('.message_item_row:last-child').attr('data-msg-id');
			load_messages(message_to_id,last_msg_id,null,0);
		}, 35000);
		
		if(typeof window.default_msg != 'undefined' && $.trim(default_msg) != '') {
			$('.send_message').click();
		}
	}
	
	
	$(".message_search_user").autocomplete({
		source: function( request, response ) {
			$.ajax({
			  type:'POST',
			  url: base_url + "ajax/search_user",
			  dataType: "json",
			  data: {
				keyword: request.term,
				_token: $('._token').val()
			  },
			  success: function( data ) {
				response( data );
			  }
			});
		},
		minLength: 2,
	    select: function( event, ui ) {
			//console.log(ui);
			if(ui.item.id > 0) {
				if($('.invite_user_to_card_default_text').length > 0 && typeof window.opc_id != 'undefined') {
					var default_msg = $('.invite_user_to_card_default_text').val();
					window.location.href = "/messages/" + ui.item.id + '?msg=' + btoa('{CARD' + window.opc_id + '}' + default_msg); 
				} else {
					window.location.href = "/messages/" + ui.item.id;
				}
			} else {
				return false;
			}
			//log( "Selected: " + ui.item.value + " aka " + ui.item.id );
	    }
	});
	
	$('input[name=available]').change(function(){
		var available = 0;
		var available_label = "Not available";
		
		if($(this).is(':checked')) {
			available = 1;
			var available_label = "Available";
		}
		
		$('.available_label').text(available_label);
		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/update_availability',
			dataType:'json',
			data:{
				available:available,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					
				}
			}
		});
		
	});
	$(document).on('click','.collections_go_to_search_link',function(){
		window.location.href = "/search"
		return false;
	});
	
	$('.collection_item_block').click(function(e) {
		// var tmp1 = $(e.target).hasClass('dropdown-toggle');
		// var tmp2 = $(e.target).hasClass('dropdown-item');
		
		// if(tmp1 === false && tmp2 === false) {
			$('.collection_item_block').removeClass('active');
			var this_ = $(this);
			this_.addClass('active'); 
			var collection_id = this_.attr('data-col-id');
			
			$.ajax({
				type:'POST',
				url:base_url + 'ajax/get_collection_items',
				dataType:'json',
				data:{
					collection_id:collection_id,
					_token: $('._token').val()
				},
				cache: false,
				success:function(data) {
					if (data.complete) {
						// var items_count = parseInt(data.items_count) > 1 ? data.items_count + ' entries' : data.items_count + ' entry';
						var collection_items_html = data.collection_items_html;
						$('.collection_items_block').html(collection_items_html);
						// $('.collection_entries_count[data-id="col'+collection_id+'"]').text(items_count);
					}
				}
			});
			
			return false;
		// }
	});
	
	$('.delete_collection_link').click(function(){
		var this_ = $(this);
		var button_text = this_.text();
		var this_ = $(this);
		// var collection_block = this_.parents('.collection_item_block');
		var collection_id = this_.attr('data-col-id');
		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/delete_collection',
			dataType:'json',
			data:{
				collection_id:collection_id,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					
					$.notify({
						// options
						message: 'Collection deleted successfully.' 
					},{
						// settings
						type: 'success',
						placement: {
							align: 'center'
						},
						delay:1000
					});
					
					// collection_block.remove();
					
					setTimeout(function() {
						window.location.href = "/user/my-collection";
					}, 1000);
				
				}
			}
		});

		return false;
	});
	
	$('.add_edit_collection').click(function() {
		var this_ = $(this);
		var button_text = this_.text();
		var collection_name = $('.collection_name').val();
		var collection_id = $(this).attr('data-col-id');
		
		if($.trim(collection_name) == '') {
			$('.collection_msg').html('<div class="alert alert-danger" role="alert">Please add collection name<div>');
			return false;
		}

		var collection_edit_mode = 0;
		if(collection_id > 0) var collection_edit_mode = 1;
		this_.text('Processing...');
		this_.prop('disabled', true);
		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/add_collection',
			dataType:'json',
			data:{
				collection_id:collection_id,
				collection_name:collection_name,
				collection_edit_mode:collection_edit_mode,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					var collections_html = data.collections_html;
					$('.view_user_collections_block').html(collections_html);
					if(collection_edit_mode == 1) {
						var success_msg = 'Collection updated successfully.';
					} else {
						var success_msg = 'Collection created successfully.';
					}						
					$.notify({
						// options
						message: success_msg 
					},{
						// settings
						type: 'success',
						placement: {
							align: 'center'
						},
						delay:1000,
						z_index: 5031
					});
					
					setTimeout(function() {
						window.location.href = '/user/my-collection';
					}, 1000);
				} else {
					/*$.notify({
						// options
						message: 'Skill deleted successfully.' 
					},{
						// settings
						type: 'success',
						placement: {
							align: 'center'
						},
						delay:1000
					});*/
					alert(data.message);
				}
			}
		});
		
		return false;
	});
	
	$('.add_collection_link').click(function(){
		$('.collection_edit_mode').val(0);
		$('.collection_name').val('');
		$('.open_add_edit_collection').click();
		$('.add_collection_title').text('Add Collection');
		return false;
	});
	
	$('.edit_collection_link').click(function(e){
		// var collection_id = $(this).attr('data-col-id');
		// var collection_name_64 = $(this).attr('data-col-name');
		// var collection_name = atob(collection_name_64);
		// $('.collection_name').val(collection_name);
		// $('.collection_edit_mode').val(1);
		// $('.add_collection_title').text('Edit Collection');
		// $('.add_edit_collection').attr('data-col-id',collection_id);
		// $('.open_add_edit_collection').click();
		// return false;
		e.stopPropagation();
		e.preventDefault();
		var url = $(this).attr('href');
		location.href = url;

	});
	
	$(document).on('click','.add_to_my_collection',function() {
		var this_ = $(this);
		var button_text = this_.html();
		this_.html('Processing...');
		this_.prop('disabled', true);
		var collection_id = $(this).attr('collection_id');
		var action_type = $(this).attr('action_type');
		var item_type = $(this).attr('item_type');
		
		if(item_type == 'opc') {
			var collection_opc_id = $(this).attr('collection_opc_id');
			
			if(collection_opc_id) {
				window.opc_id = collection_opc_id;
			}
		} else if(item_type == 'user' ) {
			var collection_user_id = $(this).attr('collection_user_id');
			
			if(collection_user_id) {
				window.data_user_id = collection_user_id;
			}
		}
		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/add_to_my_collection',
			dataType:'json',
			data:{
				collection_user_id:window.data_user_id,
				collection_opc_id:window.opc_id,
				item_type:item_type,
								
				collection_id:collection_id,
				action_type:action_type,
				
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					var opp_card_block = this_.parents('.opp_card_block');
					var search_user_block = this_.parents('.search_user_block');
					var view_collections_block = this_.parents('.view_collections_block');
					
					if (view_collections_block.length > 0) {
						var collections_html = data.collections_html;
						view_collections_block.html(collections_html);
					} else if(opp_card_block.length > 0) {
						$.notify({
							// options
							message: 'The opportunity card removed from your collection successfully.' 
						},{
							// settings
							type: 'success',
							placement: {
								align: 'center'
							},
							delay:1000
						});
						$('.collection_item_block.active').click();
						//opp_card_block.remove();
						
					} else if(search_user_block.length > 0) {
						$.notify({
							// options
							message: 'The user removed from your collection successfully.' 
						},{
							// settings
							type: 'success',
							placement: {
								align: 'center'
							},
							delay:1000
						});
						
						//search_user_block.remove();
					} else {
					
						var collections_html = data.collections_html;
						
						if(item_type == 'user') {
							$('.view_user_collections_block').html(collections_html);
						} else if(item_type == 'opc'){
							$('.view_opc_collections_block').html(collections_html);
						}
					}
						
					if($('.collection_item_block.active').length > 0) {
						$('.collection_item_block.active').click();
					}
					
					this_.html(button_text);
					this_.prop('disabled', false);
				}
			}
		});
		
		
		
		return false;
	});
	$(document).on('click','.delete_my_individual_collection',function() {
		var this_ = $(this);
		var button_text = this_.html();
		this_.html('Processing...');
		this_.prop('disabled', true);
		var collection_id = $(this).attr('collection_id');
		var item_type = $(this).attr('item_type');
		var item_id = $(this).attr('item_id');
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/delete_my_individual_collection',
			dataType:'json',
			data:{								
				collection_id:collection_id,				
				item_type:item_type,				
				item_id:item_id,				
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					$.notify({
						// options
						message: 'The card was removed successfully.' 
					},{
						// settings
						type: 'success',
						placement: {
							align: 'center'
						},
						delay:1000
					});
					setTimeout(function() {
						window.location.reload();
					}, 1000);
				}
			}
		});	

		
		
		
		return false;
	});	
	$('.dropdown-submenu a.add_to_my_collection_link').on("click", function(e){
		$(this).next('ul').toggle();
		e.stopPropagation();
		e.preventDefault();
	});

	$('.dropdown-submenu a.add_to_my_collection_link_new').on("click", function(e){
		e.stopPropagation();
		e.preventDefault();
		var opc_id = $(this).attr('data-opt-id');
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/get_opc_collections',
			dataType:'json',
			data:{
				opc_id:opc_id,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					var collections_html = data.collections_html;
					console.log(collections_html);
					$('.dropdown-submenu a.add_to_my_collection_link_new').attr('data-content',collections_html);
						//popover
					$('.dropdown-submenu a.add_to_my_collection_link_new').popover();

				}else{
					$(this).attr('data-content', 'No Collection')
				}
			}	
				
		});
		

	});	

	$('.dropdown-submenu a.add_to_share_link_new').on("click", function(e){
		var opc_id = $(this).attr('data-opt-id');
		var collections_html = '<a href="https://www.linkedin.com/sharing/share-offsite/?url=http://growyspace.com/cards/'+opc_id+'" target="blank">LinkedIn</a>'
		$('.dropdown-submenu a.add_to_share_link_new').attr('data-content',collections_html);
		$('.dropdown-submenu a.add_to_share_link_new').popover();
		e.stopPropagation();
		e.preventDefault();

	});	

	$('.dropdown-submenu a.get_opc_collections').on("click", function(e){
		var opc_id = $(this).attr('data-opt-id');
		var next_ul = $(this).next('ul');
		if(!next_ul.is(':visible')) {
			$.ajax({
				type:'POST',
				url:base_url + 'ajax/get_opc_collections',
				dataType:'json',
				data:{
					opc_id:opc_id,
					_token: $('._token').val()
				},
				cache: false,
				success:function(data) {
					if (data.complete) {
						var collections_html = data.collections_html;
						next_ul.html(collections_html);
					}
				}	
					
			});
		}
				
		$(this).next('ul').toggle();
		e.stopPropagation();
		e.preventDefault();
	});
	
	$('.get_user_collections').click(function() {
		var user_id = $(this).attr('data-user-id');
		
		var toggle_id = $(this).attr('gys-toggle-id');
		var gys_toggle = $('[gys-toggle="' + toggle_id + '"]');
		var need_to_request = gys_toggle.hasClass('hidden') ? true : false;
		
		if(need_to_request) {
			$.ajax({
				type:'POST',
				url:base_url + 'ajax/get_user_collections',
				dataType:'json',
				data:{
					user_id:user_id,
					_token: $('._token').val()
				},
				cache: false,
				success:function(data) {
					if (data.complete) {
						var collections_html = data.collections_html;
						gys_toggle.find('.view_collections_block').html(collections_html);
						
					}
				}
			});
		}
	});
	
	// $(document).on('click','.search_user_block',function(e) {
	// 	var tmp1 = $(e.target).hasClass('dropdown-toggle');
	// 	var tmp2 = $(e.target).hasClass('dropdown-item');
	// 	var tmp3 = $(e.target).hasClass('growyspace_btn');
	// 	var tmp4 = $(e.target).hasClass('growyspace_btn_icon');
		
	// 	if(tmp1 === false && tmp2 === false && tmp3 === false && tmp4 === false) {
	// 		window.data_user_id = $(this).attr('data-user-id');
	// 		window.location.href='/user/' + data_user_id + '/view';
	// 		return false;
	// 	}
	// });
	
	$('.update_profession').click(function(){
		var this_ = $(this);
		var button_text = this_.html();
		this_.html('Processing...');
		this_.prop('disabled', true);
		var profession = $('input.profession').val();
		
		if($.trim(profession) == '') {
			$('.profession_msg').html('<div class="alert alert-danger" role="alert">Please add your profession<div>');
			return false;
		}
		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/update_profession',
			dataType:'json',
			data:{
				profession:profession,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					this_.html(button_text);
					this_.prop('disabled', false);
					//window.need_reload_true = 1;
					$('.profession_msg').html('<div class="alert alert-success" role="alert">Profession updated successfully</div>');
					
					setTimeout(function() {
						window.location.reload();
					}, 1000);
				}
			}
		});
		return false;
	});
	
	$('.update_my_pitch').click(function(){
		var this_ = $(this);
		var button_text = this_.html();
		this_.html('Processing...');
		this_.prop('disabled', true);
		var my_pitch = $('input.my_pitch').val();
		
		if($.trim(my_pitch) == '') {
			$('.my_pitch_msg').html('<div class="alert alert-danger" role="alert">Please your pitch text<div>');
			return false;
		}
		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/update_my_pitch',
			dataType:'json',
			data:{
				my_pitch:my_pitch,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					this_.html(button_text);
					this_.prop('disabled', false);
					//window.need_reload_true = 1;
					$('.my_pitch_msg').html('<div class="alert alert-success" role="alert">Pitch text updated successfully</div>');
				
					setTimeout(function() {
						window.location.reload();
					}, 1000);
				}
			}
		});
		return false;
	});
	
	$('.profession_update_link').click(function(){
		$('.open_update_profession_popup').click();
		return false;
	});
	$('input[name=type]').change(function(){
		$('.search').click();
		return false;
	});
	
	$('.search').click(function(){
		var url_parameters = {};
		var search = $('input[name=search]').val();
		var type = $('input[name=type]:checked').val();
		var search_country_code = $('.search_country_code').val();
		var search_city = $('.search_city').val();
		var search_opc_fields = $('.search_opc_fields').val();
		var search_from_salary = $('.search_from_salary').val();
		var search_to_salary = $('.search_to_salary').val();
		var search_from_hour = $('.search_from_hour').val();
		var search_to_hour = $('.search_to_hour').val();
		var search_education = $('.search_education').val();
		var search_profession = $('.search_profession').val();
		var search_skills = $('.search_skills').val();
		
		
		var search_availability = $(".search_availability:checked").map(function(){
		  return $(this).val();
		}).get().join(",");;
		
		if($.trim(type) == '') {
			type = 0;
		}
		
		url_parameters.type = type;
		
		if($.trim(search_profession) != '') {
			url_parameters.profession = search_profession;
		}
		
		if($.trim(search_education) != '') {
			url_parameters.education = search_education;
		}
		
		if(search_availability.length > 0) {
			url_parameters.available = search_availability;
		}
		
		if($.trim(search_country_code) != '') {
			url_parameters.country = search_country_code;
		}
		
		if($.trim(search_city) != '') {
			url_parameters.city = search_city;
		}
		
		if($.trim(search_opc_fields) != '') {
			url_parameters.opc_fields = search_opc_fields;
		}
		
		if($.trim(search_skills) != '') {
			url_parameters.skills = search_skills;
		}
		
		if($.trim(search_from_salary) != '') {
			url_parameters.from_salary = search_from_salary;
		}
		
		if($.trim(search_to_salary) != '') {
			url_parameters.to_salary = search_to_salary;
		}
		
		if($.trim(search_from_hour) != '') {
			url_parameters.from_hour = search_from_hour;
		}
		
		if($.trim(search_to_hour) != '') {
			url_parameters.to_hour = search_to_hour;
		}
		
		if($.trim(search) != '') {
			url_parameters.search = search;
		}
		
		var querystring = encodeQueryData(url_parameters);
		
		window.location.href = search_url + '?' + querystring;
		
		
		return false;
	});
	$('.experience_block').click(function(e){
		var tmp1 = $(e.target).hasClass('dropdown-toggle');
		var tmp2 = $(e.target).hasClass('dropdown-item');
		
		if(tmp1 === false && tmp2 === false) {
			window.experience_id = $(this).attr('data-exp-id');
			$('.open_view_experience_popup').click();
		}
	});
	
	$('.edu_block').click(function(e){
		var tmp1 = $(e.target).hasClass('dropdown-toggle');
		var tmp2 = $(e.target).hasClass('dropdown-item');
		
		if(tmp1 === false && tmp2 === false) {
			window.edu_id = $(this).attr('data-edu-id');
			$('.open_view_education_popup').click();
		}
	});
	
	// $(document).on('click','.opp_card_block',function(e) {
	// 	var tmp1 = $(e.target).hasClass('dropdown-toggle');
	// 	var tmp2 = $(e.target).hasClass('dropdown-item');
		
	// 	if(tmp1 === false && tmp2 === false) {
	// 		window.opc_id = $(this).attr('data-opt-id');
	// 		$('.open_view_opportunity_card_popup').click();
	// 	}
	// });
	
	$('.add_edit_experience').click(function(){
		var exp_company        = $('.exp_company').val();
		var exp_country_code        = $('.exp_country_code').val();
		var exp_city        = $('.exp_city').val();
		var exp_title        = $('.exp_title').val();
		var exp_from_month        = $('.exp_from_month').val();
		var exp_from_year        = $('.exp_from_year').val();
		var exp_to_month        = $('.exp_to_month').val();
		var exp_to_year        = $('.exp_to_year').val();
		var exp_currently_working        = $('.exp_currently_working').is(':checked') ? 1 : 0;
		var exp_description        = $('.exp_description').val();
		var exp_company_logo        = $('.exp_company_logo');
		
		if($.trim(exp_company) == '') {
			$('.exp_msg').html('<div class="alert alert-danger" role="alert">Please add a company<div>');
			return false;
		}
		
		if($.trim(exp_country_code) == '') {
			$('.exp_msg').html('<div class="alert alert-danger" role="alert">Please add a country<div>');
			return false;
		}
		
		if($.trim(exp_city) == '') {
			$('.exp_msg').html('<div class="alert alert-danger" role="alert">Please add a city<div>');
			return false;
		}
		
		if($.trim(exp_title) == '') {
			$('.exp_msg').html('<div class="alert alert-danger" role="alert">Please add a title<div>');
			return false;
		}
		
		if($.trim(exp_from_month) == '') {
			$('.exp_msg').html('<div class="alert alert-danger" role="alert">Please add a from month<div>');
			return false;
		}
		
		if($.trim(exp_from_year) == '') {
			$('.exp_msg').html('<div class="alert alert-danger" role="alert">Please add a from year<div>');
			return false;
		}
		
		if(exp_currently_working == 0) {
			if($.trim(exp_to_month) == '') {
				$('.exp_msg').html('<div class="alert alert-danger" role="alert">Please add a to month<div>');
				return false;
			}
			
			if($.trim(exp_to_year) == '') {
				$('.exp_msg').html('<div class="alert alert-danger" role="alert">Please add a to year<div>');
				return false;
			}
		}
		
		var this_ = $(this);
		var button_text = this_.html();
		this_.html('Processing...');
		this_.prop('disabled', true);
				
		var formData = new FormData();
		
		if ($.trim(exp_company_logo.val()) != '') {
			var uLogo    = exp_company_logo[0];
			var file = uLogo.files[0];
						
			if (file) {
				formData.append('exp_company_logo', file);
			}
		}

		formData.append('exp_company', exp_company);
		formData.append('exp_country_code',  exp_country_code);
		formData.append('exp_city', exp_city);
		formData.append('exp_title',  exp_title);
		formData.append('exp_from_month',  exp_from_month);
		formData.append('exp_from_year',  exp_from_year);
		formData.append('exp_currently_working',  exp_currently_working);
		formData.append('exp_to_month',  exp_to_month);
		formData.append('exp_to_year',  exp_to_year);
		formData.append('exp_description',  exp_description);
		
		if(typeof window.experience_edit_mode != 'undefined' && window.experience_edit_mode == 1) {
			formData.append('experience_edit_mode',  window.experience_edit_mode);
			formData.append('exp_id',  this_.attr('data-exp-id'));
		}

		formData.append('_token', $('._token').val());
		
		$.ajax({
			async: true,
			url: base_url + 'ajax/add_edit_experience',
			dataType: "json",
			type : "POST",
			data : formData,
			contentType : false,
			cache : false,
			processData : false,
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(evt) {
					if (evt.lengthComputable) {
						
					}
				}, false);
				return xhr;
			},
			success : function(data)
			{
				if (data.complete) {
					this_.html(button_text);
					this_.prop('disabled', false);
					
					if(window.experience_edit_mode == 0) {
						$('.exp_company').val('');
						$('.exp_country_code').val('');
						$('.exp_city').val('');
						$('.exp_title').val('');
						$('.exp_from_month').val('');
						$('.exp_from_year').val('');
						$('.exp_to_month').val('');
						$('.exp_to_year').val('');
						$('.exp_currently_working').prop('checked',false);
						$('.exp_description').val('');
					}
					
					//window.need_reload_true = 1;
					
					if(window.experience_edit_mode == 0) {
						$('.exp_msg').html('<div class="alert alert-success" role="alert">Experience added successfully</div>');
					} else {
						$('.exp_msg').html('<div class="alert alert-success" role="alert">Experience updated successfully</div>');
					}
					
					setTimeout(function() {
						window.location.reload();
					}, 1000);
				}
			},
			error: function(xhr, errStr) {

			}
		});
		
		return false;
	});
	$('.exp_currently_working').change(function(){
		if($(this).is(':checked')) {
			$('.exp_end_year_month_block').addClass('hidden');
			$('.exp_present_label_block').removeClass('hidden');
		} else {
			$('.exp_present_label_block').addClass('hidden');
			$('.exp_end_year_month_block').removeClass('hidden');
		}
		return false;
	}).change();
	
	$('.add_edit_education').click(function() {
		var education_school        = $('.education_school').val();
		var education_from_year     = $('.education_from_year ').val();
		var education_to_year       = $('.education_to_year').val();
		var education_description   = $('.education_description').val();
		var type_of_title           = $('.education_type_of_title').val();
		var title                   = $('.education_title').val();
		var education_country_code  = $('.education_country_code').val();
		var education_city          = $('.education_city').val();
		
		
		
		if($.trim(type_of_title) == '') {
			$('.education_msg').html('<div class="alert alert-danger" role="alert">Please add a type of title<div>');
			return false;
		}
		
		if($.trim(title) == '') {
			$('.education_msg').html('<div class="alert alert-danger" role="alert">Please add a title<div>');
			return false;
		}
		
		if($.trim(education_school) == '') {
			$('.education_msg').html('<div class="alert alert-danger" role="alert">Please add a school<div>');
			return false;
		}
		
		if($.trim(education_country_code) == '') {
			$('.education_msg').html('<div class="alert alert-danger" role="alert">Please add a country<div>');
			return false;
		}
		
		if($.trim(education_city) == '') {
			$('.education_msg').html('<div class="alert alert-danger" role="alert">Please add a city<div>');
			return false;
		}
		
		var this_ = $(this);
		var button_text = this_.html();
		this_.html('Processing...');
		this_.prop('disabled', true);
		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/add_edit_education',
			dataType:'json',
			data:{
				education_edit_mode:window.education_edit_mode,
				edu_id:this_.attr('data-edu-id'),
				school:education_school,
				country_code:education_country_code,
				city:education_city,
				from_year:education_from_year,
				to_year:education_to_year,
				description:education_description,
				type_of_title:type_of_title,
				title:title,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					this_.html(button_text);
					this_.prop('disabled', false);
					
					if(window.education_edit_mode == 1) {
						$('.education_msg').html('<div class="alert alert-success" role="alert">Education updated successfully</div>');
					} else {
						$('.education_school').val('');
						$('.education_from_year ').val('');
						$('.education_to_year').val('');
						$('.education_description').val('');
						$('.education_degree').val('');
						$('.education_msg').html('<div class="alert alert-success" role="alert">Education added successfully</div>');
					}
					//window.need_reload_true = 1;
					setTimeout(function() {
						window.location.reload();
					}, 1000);
				}
			}
		});
				
		return false;
		
		return false;
	});
	
	$('.update_skills').click(function() {
		var skills = $('.skills').val();
		
		if (skills.length == 0) {
			$('.skills_msg').html('<div class="alert alert-danger" role="alert">Please add at least one skill<div>');
			return false;
		}
		
		var this_ = $(this);
		var button_text = this_.html();
		this_.html('Processing...');
		this_.prop('disabled', true);
		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/update_skills',
			dataType:'json',
			data:{
				skills:skills,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					this_.html(button_text);
					this_.prop('disabled', false);
					$('.skills_msg').html('<div class="alert alert-success" role="alert">Skills updated successfully</div>');
					//window.need_reload_true = 1;
					
					setTimeout(function(){
						window.location.reload();
					}, 1000);
				}
			}
		});
				
		return false;
	});
	
	$('input[name=profile_image]').change(function() {
		var formData = new FormData();
		
		if ($.trim($(this).val()) != '') {
			var uLogo    = $(this)[0];
			var file = uLogo.files[0];
						
			if (file) {
				formData.append('profile_image', file);
			}
			
			formData.append('_token', $('._token').val());
			
			$.ajax({
				async: true,
				url: base_url + 'ajax/upload_profile_image',
				dataType: "json",
				type : "POST",
				data : formData,
				contentType : false,
				cache : false,
				processData : false,
				xhr: function() {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(evt) {
						if (evt.lengthComputable) {
							/*var percentComplete = evt.loaded / evt.total;
							percentComplete = parseInt(percentComplete * 100);
							$('.take_photo_progress_bar').removeClass('hidden');
							$('.take_photo_progress_bar div').css('width', percentComplete + '%').html(percentComplete + '%');
							if (percentComplete === 100) {

							}*/
						}
					}, false);
					return xhr;
				},
				success : function(data)
				{
					if (data.complete) {
						var profile_image_src = data.profile_image_src;
						
						if($.trim(profile_image_src) != '') {
							window.profile_image = profile_image_src;
							$('.popup_profile_image_block').html('<div class="profile_image_croper_block"></div>');
							init_croper();
							
						}
					}
				},
				error: function(xhr, errStr) {

				}
			});
		}
				
		return false;
	});
	
	
	$('.add_edit_opportunity_card').click(function(){
		var opc_fields = $('.opc_fields').val();
		var opc_title = $('.opc_title').val();
		var opc_company = $('.opc_company').val();
		
		var opc_salary = $('.opc_salary').val();
		var opc_hours = $('.opc_hours').val();
		
		var opc_country_code = $('.opc_country_code').val();
		var opc_city = $('.opc_city').val();
		var opc_description = $('.opc_description').val();
		var opc_company_logo = $('.opc_company_logo');
		var refer = 0;
		if($(this).attr('data-opt-id')) refer = $(this).attr('data-opt-id');
		if (opc_fields.length == 0) {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add at least one field<div>');
			return false;
		}
		
		if ($.trim(opc_title) == '') {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add a title.<div>');
			return false;
		}
		
		if ($.trim(opc_company) == '') {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add company.<div>');
			return false;
		}
		
		if ($.trim(opc_salary) == '') {
			//$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add salary.<div>');
			//return false;
		}
		
		if ($.trim(opc_hours) == '') {
			//$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add hours.<div>');
			//return false;
		}
				
		if ($.trim(opc_country_code) == '') {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please select a country<div>');
			return false;
		}
		
		if ($.trim(opc_city) == '') {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add a city<div>');
			return false;
		}
		
		if ($.trim(opc_description) == '') {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add a description<div>');
			return false;
		}
		
		var this_ = $(this);
		var button_text = this_.html();
		this_.html('Processing...');
		this_.prop('disabled', true);
		
		
		var value = $(this).val();
		var formData = new FormData();
		
		if ($.trim(opc_company_logo.val()) != '') {
			var uLogo    = opc_company_logo[0];
			var file = uLogo.files[0];
						
			if (file) {
				formData.append('opc_company_logo', file);
			}
		}

		formData.append('opc_fields', opc_fields);
		formData.append('opc_title',  opc_title);
		formData.append('opc_salary', opc_salary);
		formData.append('opc_hours',  opc_hours);
		formData.append('opc_company',  opc_company);
		formData.append('opc_city',  opc_city);
		formData.append('opc_description',  opc_description);
		formData.append('opc_country_code',  opc_country_code);
		formData.append('refer',  refer);
		
		var opc_edit_mode = this_.attr('data-opt-id');
		if(opc_edit_mode != 0) window.opc_edit_mode = 1;
		if(typeof window.opc_edit_mode != 'undefined' && window.opc_edit_mode == 1) {
			formData.append('opc_edit_mode',  window.opc_edit_mode);
			formData.append('opc_id',  this_.attr('data-opt-id'));
		}

		formData.append('_token', $('._token').val());
		
		$.ajax({
			async: true,
			url: base_url + 'ajax/add_edit_opportunity_card',
			dataType: "json",
			type : "POST",
			data : formData,
			contentType : false,
			cache : false,
			processData : false,
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(evt) {
					if (evt.lengthComputable) {
						/*var percentComplete = evt.loaded / evt.total;
						percentComplete = parseInt(percentComplete * 100);
						$('.take_photo_progress_bar').removeClass('hidden');
						$('.take_photo_progress_bar div').css('width', percentComplete + '%').html(percentComplete + '%');
						if (percentComplete === 100) {

						}*/
					}
				}, false);
				return xhr;
			},
			success : function(data)
			{
				if (data.complete) {
					if(typeof window.opc_edit_mode != 'undefined' && window.opc_edit_mode == 1) {
						$('.opc_error_msg').html('<div class="alert alert-success" role="alert">Card updated successfully</div>');

					} else {
						$('.opc_error_msg').html('<div class="alert alert-success" role="alert">Card added successfully</div>');
						$('.opc_title').val('');
						$('.opc_salary').val('');
						$('.opc_hours').val('');
						$('.opc_country_code').val('');
						$('.opc_city').val('');
						$('.opc_description').val('');
						$('.opc_company').val('');

					}					
					this_.text(button_text);
					this_.prop('disabled', false);
					//window.need_reload_true = 1;
					
					setTimeout(function(){
						var lastID = this_.attr('data-opt-id');
						if(data.last_inserted_id) lastID = data.last_inserted_id;
						window.location.href = '/cards/'+lastID;
					}, 1000);
				} else {
					$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">' + data.message + '<div>');
				}
			},
			error: function(xhr, errStr) {

			}
		});
		
		/*		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/add_edit_opportunity_card',
			dataType:'json',
			data:{
				opc_fields:opc_fields,
				opc_title:opc_title,
				opc_salary:opc_salary,
				opc_hours:opc_hours,
				opc_company:opc_company,
				opc_country_code:opc_country_code,
				opc_city:opc_city,
				opc_description:opc_description,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					$('.opc_error_msg').html('<div class="alert alert-success" role="alert">Card added syccessfully</div>');
					$('.opc_fields').val('');
					$('.opc_title').val('');
					$('.opc_salary').val('');
					$('.opc_hours').val('');
					$('.opc_country_code').val('');
					$('.opc_city').val('');
					$('.opc_description').val('');
					
					setTimeout(function(){
						window.location.reload();
					}, 1000);
				} else {
					$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">' + data.message + '<div>');
				}
				
				
			}
		});*/
		return false;
	});
	// open to work/ create/update

	$('.add_edit_opentowork_card').click(function(){
		var opc_roles = $('.opc_roles').val();
		var opc_fields = $('.opc_fields').val();
		var opc_title = $('.opc_title').val();
		var opc_email = $('.opc_email').val();
		var opc_phone = $('.opc_phone').val();
		
		var opc_salary = $('.opc_salary').val();
		var opc_hours = $('.opc_hours').val();
		
		var opc_country_code = $('.opc_country_code').val();
		var opc_city = $('.opc_city').val();
		var opc_description = $('.opc_description').val();
		// var opc_company_logo = $('.opc_company_logo');
		var refer = 0;
		if($(this).attr('data-opt-id')) refer = $(this).attr('data-opt-id');

		if (opc_roles.length == 0) {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add at least one role<div>');
			return false;
		}
		if (opc_fields.length == 0) {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add at least one field<div>');
			return false;
		}
		
		if ($.trim(opc_title) == '') {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add the name.<div>');
			return false;
		}
		
		if(!validateEmail(opc_email)) {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add the correct email<div>');
			return false;
		}
		
		// if (!validatePhone(opc_phone)) {
		if ($.trim(opc_phone) == '') {
			// $('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Input an Phone No.[+xx-xxxx-xxxx, +xx.xxxx.xxxx, +xx xxxx xxxx] and Submit<div>');
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add the phone number<div>');
			return false;
		}
		if ($.trim(opc_salary) == '') {
			//$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add salary.<div>');
			//return false;
		}
		
		if ($.trim(opc_hours) == '') {
			//$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add hours.<div>');
			//return false;
		}
				
		if ($.trim(opc_country_code) == '') {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please select a country<div>');
			return false;
		}
		
		if ($.trim(opc_city) == '') {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add a city<div>');
			return false;
		}
		
		if ($.trim(opc_description) == '') {
			$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">Please add the pitch<div>');
			return false;
		}
		
		var this_ = $(this);
		var button_text = this_.html();
		this_.html('Processing...');
		this_.prop('disabled', true);
		
		
		var value = $(this).val();
		var formData = new FormData();
		formData.append('opc_fields', opc_fields);
		formData.append('opc_roles', opc_roles);
		formData.append('opc_title',  opc_title);
		formData.append('opc_salary', opc_salary);
		formData.append('opc_hours',  opc_hours);
		formData.append('opc_email',  opc_email);
		formData.append('opc_city',  opc_city);
		formData.append('opc_description',  opc_description);
		formData.append('opc_country_code',  opc_country_code);
		formData.append('opc_phone',  opc_phone);
		formData.append('refer',  refer);
		
		var opc_edit_mode = this_.attr('data-opt-id');
		if(opc_edit_mode != 0) window.opc_edit_mode = 1;
		if(typeof window.opc_edit_mode != 'undefined' && window.opc_edit_mode == 1) {
			formData.append('opc_edit_mode',  window.opc_edit_mode);
			formData.append('opc_id',  this_.attr('data-opt-id'));
		}

		formData.append('_token', $('._token').val());
		
		$.ajax({
			async: true,
			url: base_url + 'ajax/add_edit_opentowork_card',
			dataType: "json",
			type : "POST",
			data : formData,
			contentType : false,
			cache : false,
			processData : false,
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(evt) {
					if (evt.lengthComputable) {
						/*var percentComplete = evt.loaded / evt.total;
						percentComplete = parseInt(percentComplete * 100);
						$('.take_photo_progress_bar').removeClass('hidden');
						$('.take_photo_progress_bar div').css('width', percentComplete + '%').html(percentComplete + '%');
						if (percentComplete === 100) {

						}*/
					}
				}, false);
				return xhr;
			},
			success : function(data)
			{
				if (data.complete) {
					if(typeof window.opc_edit_mode != 'undefined' && window.opc_edit_mode == 1) {
						$('.opc_error_msg').html('<div class="alert alert-success" role="alert">Card updated successfully</div>');

					} else {
						$('.opc_error_msg').html('<div class="alert alert-success" role="alert">Card added successfully</div>');
						$('.opc_title').val('');
						$('.opc_salary').val('');
						$('.opc_hours').val('');
						$('.opc_country_code').val('');
						$('.opc_city').val('');
						$('.opc_description').val('');
						$('.opc_phone').val('');
						$('.opc_roles').val('');
						$('.opc_email').val('');

					}					
					this_.text(button_text);
					this_.prop('disabled', false);
					//window.need_reload_true = 1;
					
					setTimeout(function(){
						var lastID = this_.attr('data-opt-id');
						if(data.last_inserted_id) lastID = data.last_inserted_id;
						window.location.href = '/opentowork/'+lastID;
					}, 1000);
				} else {
					$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">' + data.message + '<div>');
				}
			},
			error: function(xhr, errStr) {

			}
		});
		
		/*		
		$.ajax({
			type:'POST',
			url:base_url + 'ajax/add_edit_opportunity_card',
			dataType:'json',
			data:{
				opc_fields:opc_fields,
				opc_title:opc_title,
				opc_salary:opc_salary,
				opc_hours:opc_hours,
				opc_company:opc_company,
				opc_country_code:opc_country_code,
				opc_city:opc_city,
				opc_description:opc_description,
				_token: $('._token').val()
			},
			cache: false,
			success:function(data) {
				if (data.complete) {
					$('.opc_error_msg').html('<div class="alert alert-success" role="alert">Card added syccessfully</div>');
					$('.opc_fields').val('');
					$('.opc_title').val('');
					$('.opc_salary').val('');
					$('.opc_hours').val('');
					$('.opc_country_code').val('');
					$('.opc_city').val('');
					$('.opc_description').val('');
					
					setTimeout(function(){
						window.location.reload();
					}, 1000);
				} else {
					$('.opc_error_msg').html('<div class="alert alert-danger" role="alert">' + data.message + '<div>');
				}
				
				
			}
		});*/
		return false;
	});
	
	
	$('.opc_fields,.search_opc_fields,.search_skills,.opc_roles,.search_opc_opc_roles,.opc_explore').select2({
		tags: true
		//tokenSeparators: [',', ' ']
	});
	
	$('.skills').select2({
		tags: true
		//tokenSeparators: [',', ' ']
	});
	
	$('.change_password_link').click(function(){
		$('.change_password_fields_block').removeClass('hidden');
		return false;
	});
		
	$('.open_view_opportunity_card_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				$.ajax({
					type:'POST',
					url:base_url + 'ajax/get_opc_data',
					dataType:'json',
					data:{
						opc_id:window.opc_id,
						_token: $('._token').val()
					},
					cache: false,
					success:function(data) {
						if (data.complete) {
							var opc = data.opc_data;
							fields = opc.fields;
							var owner = data.owner;
							
							var collections_html = data.collections_html;
							$('.view_opc_collections_block').html(collections_html);
							
							
							var company = opc.company;
							var title = opc.title;
							var city = opc.city;
							var hours = opc.hours;
							var salary = opc.salary;
							var country_name = opc.country_name;
							var description = data.description_formatted;
							var company_logo_src = data.company_logo_src;
														
							var fields_array = JSON.parse(fields);
							var f_html = '';
							
							for(var i in fields_array) {
								f_html += '<span class="view_opp_card_field">' + fields_array[i] + '</span>';
							}
							
							if($.trim(company_logo_src) != '') {
								$('.view_opp_card_block2').html('<img style="max-width:200px;" src="' + company_logo_src + '" />');
							} else {
								$('.view_opp_card_block2').html('<img style="width:100%;" src="'+ base_url +'/assets/images/view_opp_card_company_logo.jpg" />');
							}
							
							if(owner) {
								$('.view_opp_card_actions_block .send_message_card_owner').addClass('hidden');
								$('.view_opp_card_actions_block .invite_user_to_this_card').removeClass('hidden');
								$('.view_opp_card_actions_block .edit_opportunity_card_link').removeClass('hidden');
								$('.view_opp_card_actions_block .delete_opportunity_card_link').removeClass('hidden');
							} else {
								var encoded_msg = '{CARD' + opc.id + '}' + 'Hey! I am interested in this opportunity';
								$('.view_opp_card_actions_block .send_message_card_owner').removeClass('hidden').attr('href','/messages/' + opc.user_id + '?msg=' + btoa(encoded_msg));
								$('.view_opp_card_actions_block .edit_opportunity_card_link').addClass('hidden');
								$('.view_opp_card_actions_block .delete_opportunity_card_link').addClass('hidden');
								$('.view_opp_card_actions_block .invite_user_to_this_card').addClass('hidden');
							}
							
							$('.view_opp_card_actions_block').removeClass('hidden');
							
							
							$('.view_opp_card_salary').html(salary + '€');
							$('.view_opp_card_hours').html(hours + 'h/w');
							$('.view_opp_card_location').html( city + ', ' + country_name);
							$('.view_opp_card_fields_wrapper').html(f_html);
							$('.view_opp_card_company').text(company);
							$('.view_opp_card_title').text(title);
							$('.view_opp_card_description_txt').html(description);
							
							$('.view_opp_card_actions_block .invite_user_to_this_card').attr('data-opt-id',opc.id);
							$('.view_opp_card_actions_block .edit_opportunity_card_link').attr('data-opt-id',opc.id);
							$('.view_opp_card_actions_block .delete_opportunity_card_link').attr('data-opt-id',opc.id);
							$('.view_opp_card_actions_block .go_to_card_page').attr('href','/cards/' + opc.id);
						}
					}
				});
			},
			close:function(){
				$('.view_opp_card_location').html('');
				$('.view_opp_card_fields_wrapper').html('');
				$('.view_opp_card_company').text('');
				$('.view_opp_card_title').text('');
				$('.view_opp_card_description_txt').text('');
			}
		}
	});
	
	$('.open_view_experience_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				$.ajax({
					type:'POST',
					url:base_url + 'ajax/get_experience_data',
					dataType:'json',
					data:{
						experience_id:window.experience_id,
						_token: $('._token').val()
					},
					cache: false,
					success:function(data) {
						if (data.complete) {
							var owner = data.owner;
							var experience = data.experience;
							var experience_id = experience.id;
							var company = experience.company;
							var city = experience.city;
							var title = experience.title;
							var from_date_f = experience.from_date_f;
							var to_date_f = experience.to_date_f;
							var country_name = experience.country_name;
							var company_logo_src = data.company_logo_src;
							
							if(owner) {
								$('.view_experience_actions_block').removeClass('hidden');
							} else {
								$('.view_experience_actions_block').addClass('hidden');
							}
							
							if($.trim(company_logo_src) != '') {
								$('.exp_company_logo_block_value').html('<img style="max-width:200px;" src="' + company_logo_src + '" />');
							} else {
								$('.exp_company_logo_block_value').html('');
							}
							
							if($.trim(to_date_f) == '') {
								to_date_f = 'Present';
							}
							
							var description = experience.description;
														
							$('.view_experience_actions_block .edit_experience_link').attr('data-exp-id',experience_id);
							$('.view_experience_actions_block .delete_experience_link').attr('data-exp-id',experience_id);
							$('.exp_company_value').text(company);
							$('.exp_title_value').text(title);
							//$('.exp_from_value').text(from_date_f);
							//$('.exp_to_value').text(to_date_f);
							$('.exp_period').text(from_date_f + ' to ' + to_date_f);
							
							$('.exp_description_value').text(description);
							$('.exp_location_value').text(city);
							$('.exp_country_value').text(city + ', ' + country_name);
							
							
						}
					}
				});
			}
		}
	});
	
	$('.open_view_education_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				$.ajax({
					type:'POST',
					url:base_url + 'ajax/get_edu_data',
					dataType:'json',
					data:{
						edu_id:window.edu_id,
						_token: $('._token').val()
					},
					cache: false,
					success:function(data) {
						if (data.complete) {
							var edu = data.edu;
							var owner = data.owner;
							var school = edu.school;
							var from_year = edu.from_year;
							var to_year = edu.to_year;
							var degree = edu.degree;
							var type_of_title = edu.type_of_title;
							var title = edu.title;
							var country_name = data.country_name;
							var city = edu.city;
							var description = edu.description;
							var edu_id = edu.id;
							var location = city + ', ' + country_name;
							
							if(owner) {
								$('.view_education_actions_block').removeClass('hidden');
							} else {
								$('.view_education_actions_block').addClass('hidden');
							}
							
							$('.view_education_actions_block .edit_education_link').attr('data-edu-id',edu_id);
							$('.view_education_actions_block .delete_education_link').attr('data-edu-id',edu_id);
							$('.education_year_value').text(from_year + ' - ' + to_year);
							$('.education_school_value').text(school);
							$('.education_type_of_title_value').text(type_of_title);
							$('.education_title_value').text(title);
							$('.education_location_value').text(location);
							$('.education_description_value').text(description);
						}
					}
				});
			}
		}
	});
	
	$('.open_add_edit_education_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				if(typeof window.education_edit_mode != "undefined" && window.education_edit_mode == 1) {
					$.ajax({
						type:'POST',
						url:base_url + 'ajax/get_edu_data',
						dataType:'json',
						data:{
							edu_id:window.edu_id,
							_token: $('._token').val()
						},
						cache: false,
						success:function(data) {
							if (data.complete) {
								var edu = data.edu;
								var owner = data.owner;
								var city = edu.city; 
								var country_code = edu.country_code; 
								var school = edu.school; 
								var from_year = edu.from_year; 
								var to_year = edu.to_year; 
								var edu_id = edu.id; 
								var description = edu.description;
								var type_of_title = edu.type_of_title;
								var title = edu.title;
								
								if(owner) {
									$('.view_education_actions_block').removeClass('hidden');
								} else {
									$('.view_education_actions_block').addClass('hidden');
								}
								
								$(".education_city").val(city);
								$(".education_country_code").val(country_code);
								$(".education_school").val(school);
								$(".education_from_year").val(from_year);
								$(".education_to_year").val(to_year);
								$(".education_title").val(title);
								$(".education_type_of_title").val(type_of_title);
								$(".education_description").val(description);
															
								$('.add_edit_education').text('Update Education').attr('data-edu-id',edu_id);
								$('.add_edit_education_title').text('Update Education');
							}
						}
					});
				}
			},
			close: function() {
				$('.education_msg').text('');
				$('.add_edit_education').text('Add Education').removeAttr('data-edu-id');
				$('.add_edit_education_title').text('Add Education');
				if(typeof need_reload_true != 'undefined' && need_reload_true == 1) {
					window.location.reload();
				}
			}
		}
	});
	
	$('.open_add_edit_skills_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				
				$.ajax({
					type:'POST',
					url:base_url + 'ajax/manage_skills',
					dataType:'json',
					data:{
						_token: $('._token').val()
					},
					cache: false,
					success:function(data) {
						if (data.complete) {
							var all_skills = data.all_skills;
							var user_skills = data.user_skills;
							
							var options_html = '';
								
							for(var i in all_skills) {
								var s = all_skills[i];
								options_html += '<option value="' + s + '">' + s + '</option>';
							}
							
							$(".skills").html(options_html);
							$(".skills").val(user_skills);
							$(".skills").trigger('change');;
							
						}
					}
				});
			},
			close: function() {
				$('.skills_msg').text('');
				
				if(typeof need_reload_true != 'undefined' && need_reload_true == 1) {
					window.location.reload();
				}
			}
		}
	});
	
	$('.open_add_edit_experience_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				if(typeof window.experience_edit_mode != "undefined" && window.experience_edit_mode == 1) {
					$.ajax({
						type:'POST',
						url:base_url + 'ajax/get_experience_data',
						dataType:'json',
						data:{
							experience_id:window.experience_id,
							_token: $('._token').val()
						},
						cache: false,
						success:function(data) {
							if (data.complete) {
								var owner = data.owner;
								var experience = data.experience;
								var title = experience.title; 
								var experience_id = experience.id; 
								var company = experience.company;
								var country_code = experience.country_code;
								var city  = experience.city;
								var from_year  = experience.from_year;
								var from_month  = experience.from_month;
								var currently_working  = experience.currently_working;
								var description = experience.description;
								var company_logo_src = data.company_logo_src;
								
								if($.trim(company_logo_src) != '') {
									$('.exp_company_logo_block').html('<img class="exp_company_logo" src="' + company_logo_src + '" />');
								} else {
									$('.exp_company_logo_block').html(''); 
								}

								if(owner) {
									$('.view_experience_actions_block').removeClass('hidden');
								} else {
									$('.view_experience_actions_block').addClass('hidden');
								}
								
								if(currently_working == 1) {
									$('.exp_currently_working').prop('checked',true);
									$('.exp_to_month').val(''); 
									$('.exp_to_year').val('');
								} else {
									var to_year  = experience.to_year;
									var to_month  = experience.to_month;
									$('.exp_to_year').val(to_year); 
									$('.exp_to_month').val(to_month); 
									$('.exp_currently_working').prop('checked',false);
								}
								
								$('.exp_currently_working').change();
								$('.exp_title').val(title); 
								$('.exp_company').val(company); 
								$('.exp_city').val(city); 
								$('.exp_country_code').val(country_code); 
								$('.exp_from_month').val(from_month); 
								$('.exp_from_year').val(from_year); 
								
								
								$('.exp_description').val(description); 
								$('.add_edit_experience').text('Update Experience').attr('data-exp-id',experience_id);
								$('.add_edit_experience_title').text('Update Experience');
							}
						}
					});
				}
			},
			close: function() {
				$('.exp_company').val('');
				$('.exp_country_code').val('');
				$('.exp_city').val('');
				$('.exp_title').val('');
				$('.exp_from_month').val('');
				$('.exp_from_year').val('');
				$('.exp_to_month').val('');
				$('.exp_to_year').val('');
				$('.exp_currently_working').prop('checked',false);
				$('.exp_currently_working').change();
				$('.exp_description').val('');
				$('.add_edit_experience').text('Add Experience').removeAttr('data-exp-id');
				$('.add_edit_experience_title').text('Add Experience');
				
				if(typeof need_reload_true != 'undefined') {
					window.location.reload();
				}
				
				
			}
		}
	})
	
	$('.open_update_profession_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				
			},
			close: function() {
				if(typeof need_reload_true != 'undefined') {
					window.location.reload();
				}
			}
		}
	});
	
	$('.open_view_user_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				$.ajax({
					type:'POST',
					url:base_url + 'ajax/get_user_data',
					dataType:'json',
					data:{
						data_user_id:window.data_user_id,
						_token: $('._token').val()
					},
					cache: false,
					success:function(data) {
						if (data.complete) {
							var owner = data.owner;
							var user = data.user;
							var my_pitch = user.my_pitch;
							
							var user_profile_url = data.user_profile_url;
							var send_a_message_url = '/messages/' + window.data_user_id;
							var collections_html = data.collections_html;
							
							if(owner) {
								$('.send_a_message_link_block').addClass('hidden');
							} else {
								$('.send_a_message_link_block').removeClass('hidden');
							}
							
							$('.send_a_message').attr('href',send_a_message_url);
							
							
							$('.go_to_user_profile').attr('href',user_profile_url);
							$('.view_user_collections_block').html(collections_html);
							$('.view_user_name').text(user.full_name);
							$('.view_user_profession').text(user.profession);
							$('.view_user_my_pitch').text(my_pitch);
							
							if($.trim(user.city) == '') {
								user.city = '';
							}
							
							$('.view_user_skills_block').html(data.skills_html);
							$('.view_user_experience_block').html(data.user_experiences_html);
							$('.view_user_location').text(user.city + ', ' + user.country_name);
						}
					}
				});
			}
		}
	});
	
	$('.open_add_edit_collection').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				
			}
		}
	});

	$('.open_update_my_pitch_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {

			},
			close :function() {
				if(typeof need_reload_true != 'undefined') {
					window.location.reload();
				}
			}
		}	
	});	
	
	$('.open_profile_image_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				init_croper();
			},
			close: function() {
				if(typeof need_reload_true != 'undefined') {
					window.location.reload();
				}
			}
		}	
	});		
		
	$('.open_add_edit_opportunity_card_popup').magnificPopup({
		type:'inline',
		midClick: true,
		preloader: true,
   	    callbacks: {
			open: function() {
				if(typeof window.opc_edit_mode != "undefined" && window.opc_edit_mode == 1) {
					$.ajax({
						type:'POST',
						url:base_url + 'ajax/get_opc_data',
						dataType:'json',
						data:{
							opc_id:window.opc_id,
							_token: $('._token').val()
						},
						cache: false,
						success:function(data) {
							if (data.complete) {
								var opc = data.opc_data;
								var all_opc_fields = data.all_opc_fields;
								var options_html = '';
								
								for(var i in all_opc_fields) {
									var f = all_opc_fields[i];
									options_html += '<option value="' + f + '">' + f + '</option>';
								}
								
								$(".opc_fields").html(options_html);
								var title = opc.title; 
								var fields = opc.fields; 
								var fields_array = JSON.parse(fields);
								var opc_id = opc.id; 
								var company = opc.company;
								var country_code = opc.country_code;
								var salary = opc.salary;
								var city  = opc.city ;
								var hours = opc.hours;
								var description = opc.description;
								var company_logo_src = data.company_logo_src;
								$(".opc_fields").val(fields_array);
								$(".opc_fields").trigger('change');;
								$('.opc_title').val(title); 
								$('.opc_company').val(company); 
								$('.opc_city').val(city); 
								$('.opc_salary').val(salary); 
								$('.opc_country_code').val(country_code); 
								$('.opc_hours').val(hours); 
								$('.opc_description').val(description); 
								
								if($.trim(company_logo_src) != '') {
									$('.opc_company_logo_block').html('<img class="opc_company_logo" src="' + company_logo_src + '" />');
								} else {
									$('.opc_company_logo_block').html(''); 
								}	

								$('.add_edit_opportunity_card').text('Update Opportunity Card').attr('data-opt-id',opc_id);
								$('.add_edit_opportunity_card_title').text('Update Opportunity Card');
							}
						}
					});
				} else {
					$.ajax({
						type:'POST',
						url:base_url + 'ajax/get_opc_all_fields',
						dataType:'json',
						data:{
							opc_id:window.opc_id,
							_token: $('._token').val()
						},
						cache: false,
						success:function(data) {
							if (data.complete) {
								var all_opc_fields = data.all_opc_fields;
								var options_html = '';
								
								for(var i in all_opc_fields) {
									var f = all_opc_fields[i];
									options_html += '<option value="' + f + '">' + f + '</option>';
								}
								
								$(".opc_fields").html(options_html);
							}
						}
					});
				}
			},
			close: function() {
				$('.add_edit_opportunity_card').text('Add Opportunity Card');
				$('.add_edit_opportunity_card_title').text('Add Opportunity Card');
				
				$('.opc_error_msg').html('');
				$('.opc_fields').val('');
				$('.opc_fields').trigger('change');
				$('.opc_title').val('');
				$('.opc_company').val('');
				$('.opc_salary').val('');
				$('.opc_hours').val('');
				$('.opc_country_code').val('');
				$('.opc_city').val('');
				$('.opc_description').val(''); 
				window.opc_edit_mode = 0;
				
				if(typeof need_reload_true != 'undefined') {
					window.location.reload();
				}
			}
		}
	});
	
	$('.add_education_link').click(function(){
		window.education_edit_mode = 0;
		$('.open_add_edit_education_popup').click();
		return false;
	});
	
	$('.edit_education_link').click(function(){
		window.education_edit_mode = 1;
		window.edu_id = $(this).attr('data-edu-id');
		$.magnificPopup.close();
		$('.open_add_edit_education_popup').click();
		return false;
	});
	
	$('.add_opportuniti_card_link').click(function(){
		window.opc_edit_mode = 0;
		$('.open_add_edit_opportunity_card_popup').click();
		return false;
	});
	
	$('.edit_opportunity_card_link').click(function(){
		alert();
		window.opc_edit_mode = 1;
		window.opc_id = $(this).attr('data-opt-id');
		$.magnificPopup.close();
		$('.open_add_edit_opportunity_card_popup').click();
		return false;
	});
	
	
	$('.add_my_experience_link').click(function() {
		window.experience_edit_mode = 0;
		$('.open_add_edit_experience_popup').click();
		return false;
	});
		
	$('.edit_experience_link').click(function() {
		window.experience_edit_mode = 1;
		window.experience_id = $(this).attr('data-exp-id');
		$.magnificPopup.close();
		$('.open_add_edit_experience_popup').click();
		return false;
	});
	
	$('.manage_skill_link').click(function(){
		$('.open_add_edit_skills_popup').click();
		return false;
	});
	
	$('.delete_opportunity_card_link').click(function(){
		var this_ = $(this);
		var opp_card_block = this_.parents('.opp_card_block');
		var opc_id = this_.attr('data-opt-id');
		var button_text = this_.html();
				
		$.confirm({
			title: 'Delete opportunity card',
			content: 'Confirm deletion?',
			buttons: {
				confirm: function () {
					
					$.ajax({
						type:'POST',
						url:base_url + 'ajax/delete_opc',
						dataType:'json',
						data:{
							opc_id:opc_id,
							_token: $('._token').val()
						},
						cache: false,
						success:function(data) {
							if (data.complete) {
								
								$.notify({
									// options
									message: 'Opportunity card deleted successfully.' 
								},{
									// settings
									type: 'success',
									placement: {
										align: 'center'
									},
									delay:1000
								});
								
								if(opp_card_block.length == 1) {
									opp_card_block.remove();
								} else {
									$.magnificPopup.close();
									
									setTimeout(function() {
										window.location = '/user/my_account';
									}, 1000);
								}
							}
						}
					});
					
					
				},
				cancel: function () {
					
				}
			}
		});
		return false;
	});
	$('.delete_opentowork_card_link').click(function(){
		var this_ = $(this);
		var opp_card_block = this_.parents('.opp_card_block');
		var opc_id = this_.attr('data-opt-id');
		var button_text = this_.html();
				
		$.confirm({
			title: 'Delete opportunity card',
			content: 'Confirm deletion?',
			buttons: {
				confirm: function () {
					
					$.ajax({
						type:'POST',
						url:base_url + 'ajax/delete_opentowork',
						dataType:'json',
						data:{
							opc_id:opc_id,
							_token: $('._token').val()
						},
						cache: false,
						success:function(data) {
							if (data.complete) {
								
								$.notify({
									// options
									message: 'Open-to-work was deleted successfully.' 
								},{
									// settings
									type: 'success',
									placement: {
										align: 'center'
									},
									delay:1000
								});
								
								if(opp_card_block.length == 1) {
									opp_card_block.remove();
								} else {
									$.magnificPopup.close();
									
									setTimeout(function() {
										window.location = '/user/my_account';
									}, 1000);
								}
							}
						}
					});
					
					
				},
				cancel: function () {
					
				}
			}
		});
		return false;
	});
	
	$('.delete_education_link').click(function() {
		var this_ = $(this);
		var edu_block = this_.parents('.edu_block');
		var edu_id = this_.attr('data-edu-id');
		var button_text = this_.html();
				
		$.confirm({
			title: 'Delete education',
			content: 'Confirm deletion?',
			buttons: {
				confirm: function () {
					
					$.ajax({
						type:'POST',
						url:base_url + 'ajax/delete_edu',
						dataType:'json',
						data:{
							edu_id:edu_id,
							_token: $('._token').val()
						},
						cache: false,
						success:function(data) {
							if (data.complete) {
								
								$.notify({
									// options
									message: 'Education deleted successfully.' 
								},{
									// settings
									type: 'success',
									placement: {
										align: 'center'
									},
									delay:1000
								});
								
								if(edu_block.length == 1) {
									edu_block.remove();
								} else {
									$.magnificPopup.close();
									
									setTimeout(function() {
										window.location.reload();
									}, 1000);
								}
								
							}
						}
					});
					
					
				},
				cancel: function () {
					
				}
			}
		});
		return false;
	});
	
	$('.delete_experience_link').click(function() {
		var this_ = $(this);
		var exp_block = this_.parents('.experience_block');
		var exp_id = this_.attr('data-exp-id');
		var button_text = this_.html();
				
		$.confirm({
			title: 'Confirm!',
			content: 'Are you sure?',
			buttons: {
				confirm: function () {
					
					$.ajax({
						type:'POST',
						url:base_url + 'ajax/delete_experience',
						dataType:'json',
						data:{
							exp_id:exp_id,
							_token: $('._token').val()
						},
						cache: false,
						success:function(data) {
							if (data.complete) {
								exp_block.remove();
								$.notify({
									// options
									message: 'Experience deleted successfully.' 
								},{
									// settings
									type: 'success',
									placement: {
										align: 'center'
									},
									delay:1000
								});
								
								if(exp_block.length == 1) {
									exp_block.remove();
								} else {
									$.magnificPopup.close();
									
									setTimeout(function() {
										window.location.reload();
									}, 1000);
								}
							}
						}
					});
					
					
				},
				cancel: function () {
					
				}
			}
		});
		return false;
	});
	
	$('.delete_user_skill').click(function(){
		
		
		var this_ = $(this);
		var skill_block = this_.parents('.user_skill_item_block');
		var skill = this_.attr('data-skill');
		var button_text = this_.html();
		
		$.confirm({
			title: 'Delete skill',
			content: 'Confirm deletion?',
			buttons: {
				confirm: function () {
					$.ajax({
						type:'POST',
						url:base_url + 'ajax/delete_user_skill',
						dataType:'json',
						data:{
							skill:skill,
							_token: $('._token').val()
						},
						cache: false,
						success:function(data) {
							if (data.complete) {
								skill_block.remove();
								$.notify({
									// options
									message: 'Skill deleted successfully.' 
								},{
									// settings
									type: 'success',
									placement: {
										align: 'center'
									},
									delay:1000
								});
							}
						}
					});
					
					
				},
				cancel: function () {
					
				}
			}
		});
		return false;
	});

	// sharing button
	$.fn.editable.defaults.mode = 'popup';
	$.fn.editable.defaults.params = function (params) {
        params._token = $('._token').val()
        return params;
    };
	$('#opportunity_share').editable({
		type: 'text',
		pk: 1,
		url: '/post',
		showbuttons: false,
		success: function(data) {
			console.log('success')
		}
	});
	$('.collection_share').editable({
		type: 'text',
		pk: 1,
		url: '/post',
		showbuttons: false,
		success: function(data) {
			console.log('success')
		}
	});

	//add to collection in the opportunity
	$('.opportunity_collection').editable({
		type: 'POST',
		url: base_url + 'ajax/add_to_my_opportunity_collection',

		display: function(value, sourceData) {
		
		}
	});	
	$('.opentowork_collection').editable({
		type: 'POST',
		url: base_url + 'ajax/add_to_my_opentowork_collection',

		display: function(value, sourceData) {
		
		}
	});	
	$('.user_collection').editable({
		type: 'POST',
		url: base_url + 'ajax/add_to_my_user_collection',

		display: function(value, sourceData) {
		
		}
	});	
	$('.endorse_list').editable({
		showbuttons: false
	});	



	//Find Matches
	$('#opportunity_findmatch').editable({
		type: 'text',
		pk: 2,
		url: '/post',
		source: [
			{value: 1, text: 'banana'},
			{value: 2, text: 'peach'},
			{value: 3, text: 'apple'},
			{value: 4, text: 'watermelon'},
			{value: 5, text: 'orange'}
		],
		
	});

});

function encodeQueryData(data) {
   const ret = [];
   for (let d in data)
     ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
   return ret.join('&');
}
function scrollToBottom(id){
  div_height = $("#"+id).height();
  div_offset = $("#"+id).offset().top;
  window_height = $(window).height();
  $('html,body').animate({
    scrollTop: div_offset-window_height+div_height
  },'slow');
}
function load_messages(message_to_id,last_msg_id,first_msg_id,scroll_bottom) {
	$('.messages_block').append('<div class="message_loader"></div>');
		
	$.ajax({
		type:'POST',
		url:base_url + 'ajax/load_messages',
		dataType:'json',
		data:{
			to_id:message_to_id,
			last_msg_id:last_msg_id,
			first_msg_id:first_msg_id,
			_token: $('._token').val()
		},
		cache: false,
		success:function(data) {
			if (data.complete) {
				$('.message_loader').remove();
				var older_messages_html = data.older_messages_html;
				
				if(older_messages_html != '') {
					$('.messages_block').prepend(older_messages_html);
				}
				
				var messages_html = data.messages_html;
				var con_html = data.con_html;
				
				if(messages_html != '') {
					$('.messages_block').append(messages_html);
					
					if(scroll_bottom == 1) {
						$(".messages_block").animate({ scrollTop: $('.messages_block').height() + 100000}, 500);
					}
				}
				
				$('.messages_conversation_items_block').html(con_html);
				setTimeout(function(){ 
					//var last_msg_id2 = $('.message_item_row:last-child').attr('data-msg-id');
					//load_messages(message_to_id,last_msg_id2);
				}, 10000);
				
			}
		}
	});
}
function init_croper() {
	if(!$('.profile_image_croper_block ').hasClass('croppie-container') && typeof profile_image != 'undefined') {
		
		if(typeof cropped_image_info != 'undefined') {
			var points = cropped_image_info.points;
			var zoom = cropped_image_info.zoom;
		} else {
			var points = [77,469,280,280];
			var zoom = 0.2;
		}
		
		var basic = $('.profile_image_croper_block').croppie({
			viewport: {
				width: 200,
				height: 200,
				 type: 'circle'
			}
		});
		basic.croppie('bind', {
			url: profile_image,
			points: points,
			zoom:zoom
		});
		//on button click
		
		$('.save_profile_image_cropped_data').unbind();
		$('.save_profile_image_cropped_data').click(function(event) {
			var this_ = $(this);
			var button_text = this_.html();
			this_.html('Processing...');
			this_.prop('disabled', true);
			
			basic.croppie('result', {
			  type: 'canvas',
			  size: 'viewport'
			}).then(function(response){
				
				$.ajax({
					type:'POST',
					url:base_url + 'ajax/save_croped_image',
					dataType:'json',
					data:{
						image:response,
						crop_data:crop_data,
						_token: $('._token').val()
					},
					cache: false,
					success:function(data) {
						//window.need_reload_true = true;
						this_.html(button_text);
						this_.prop('disabled', false);
						$.notify({
							// options
							message: 'Image saved successfully.' 
						},{
							// settings
							type: 'success',
							placement: {
								align: 'center'
							},
							delay:1000,
							z_index:20000
						});
						
						setTimeout(function() {
							window.location.reload();
						}, 1000);
					}
				});
			})
		});
				
		$('.profile_image_croper_block').on('update.croppie', function(ev, cropData) {
			
			var points = cropData.points;
			var zoom = cropData.zoom;
			var orientation = cropData.orientation;
			window.crop_data = {
				points:points,
				zoom:zoom,
				orientation:orientation,
				
			};
			
		});
	}
}
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePhone(phone)
{
	const re = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  return re.test(String(phone).toLowerCase());
}
function get_unread_mesages_info() {
	$.ajax({
		type:'POST',
		url:base_url + 'ajax/get_unread_mesages_info',
		dataType:'json',
		data:{
			_token: $('._token').val()
		},
		cache: false,
		success:function(data) {
			var unread_messages_count = parseInt(data.unread_messages_count);
			
			if(unread_messages_count > 0) {
				$('.not_read_messages_count2').text(unread_messages_count).removeClass('hidden');
				$('.not_read_messages_count').text(unread_messages_count).removeClass('hidden');
			} else {
				$('.not_read_messages_count2').text(unread_messages_count).addClass('hidden');
				$('.not_read_messages_count').text(unread_messages_count).addClass('hidden');
			}
		}
	});
}
function messages_page_design_controller() {
	if($( window ).width() < 600 && $('.messages_right').hasClass('load_messages_case')) {
		$('.msg_left').addClass('hidden');
	} else {
		$('.msg_left').removeClass('hidden');
	}

}
function search_page_design_controller() {
	if($( window ).width() < 600) {
		$('.search_pad').addClass('hidden');
	} else {
		$('.search_pad').removeClass('hidden');
	}

}

$('.opentowork_endorse').click(function(){
	var skill = $(this).attr('data-opt-skill');
	var user_id = $(this).attr('data-user-id');
	var logined = $(this).attr('data-logined');

	$.ajax({
		type:'POST',
		url:base_url + 'ajax/endorse_opentowork',
		dataType:'json',
		data:{
			_token: $('._token').val(),
			received_user: user_id,
			skill:skill,

		},
		cache: false,
		success:function(data) {
			$.notify({
				// options
				message: data.message 
			},{
				// settings
				type: 'success',
				placement: {
					align: 'center'
				},
				delay:1000,
				z_index:20000
			});
			setTimeout(function() {
				window.location.reload();
			}, 1000);
		}
	});
});

//getting the opportunity collections
// var getOpt_collections = function() {

// 	$.ajax({
// 		type:'POST',
// 		url:base_url + 'ajax/get_opc_collection_list',
// 		dataType:'json',
// 		data:{
// 			_token: $('._token').val()
// 		},
// 		cache: false,
// 		success:function(data) {
// 			data.result = [
// 				{value: 1, text: 'banana'},
// 				{value: 2, text: 'peach'},
// 				{value: 3, text: 'apple'},
// 				{value: 4, text: 'watermelon'},
// 				{value: 5, text: 'orange'}
// 			];
// 			return data.result;
// 		}	
			
// 	});

// };
