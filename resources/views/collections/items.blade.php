@if($users->count() > 0)
	@foreach($users as $u)
		<div data-user-id="{{ $u->id }}" class="search_user_block">
			<div class="card align-last card-custom" style="background: #B7B1D8;width: 762px;padding: 0px;height: 56px;">
				<p style="font-size: 25px;padding-left: 18px;margin: 0px; margin-top: 10px;color: #fff;">{{$collection_name}}
					<span style="text-decoration: none;padding-right: 24px;float: right;">
						<img src="/assets/images/location2.png" alt="Edit" style="width: 15px;"> 
						<span style="font-weight: 500;font-size: 20px;line-height: 24px;letter-spacing: -0.015em;color: #FFFFFF;float: right;padding-top: 8px;padding-left: 8px;">{{$u->city}}, {{$countries[$u->country_code]}}</span>
					</span>
				</p>
				<div style="margin-top:10px;padding-left: 18px;padding-top: 18px;background: #FFFFFF;padding-bottom: 20px;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border-radius: 0px 0px 10px 10px;">
					@if(is_file(base_path() . '/public/uploads/profile/'.$u->id.'/'.$u->profile_image_cropped))
						<img style="width: 90px;float: left;margin-right: 18px;" src="{{ URL::to('/') }}/{{ 'uploads/profile/'.$u->id.'/'.$u->profile_image_cropped }}" />
					@else
						<img style="width: 90px;float: left;margin-right: 18px;" src="{{ URL::to('/') }}/assets/images/no_profile_image.png" />
					@endif
	
					
						<p style="font-size: 30px;margin: 0px;">{{ $u->full_name }}</p>
						<p style="font-size: 25px;margin: 0px;">{{ $u->profession }}</p>										
			

					<div style="padding-right: 18px; padding-top:27px;">
						@if(!$third_person)	
							<a href="#" class="float-right text-decoration-none textcolor-blue btn-customs " style="color: #CA7073" data-toggle="dropdown">Delete from collection</a>  
                                              	
							<div class="dropdown-menu dropdown-menu-right"  style="padding: 0px;">
								<p style="padding: 10px;">Are you sure you want to delete?</p>
								<div style="width: 90%;margin: 0 auto;padding-bottom: 10px;">
									<span class="delete_my_individual_collection" style="color: #CA7073;" collection_id="{{$collection_id}}" item_type="user" item_id="{{$u->id}}">Delete</span> <span style="float: right;color: #219BC4;">Back</span>
								</div>	

							</div>

						@endif                   
						<a href="{{ URL::to('/') }}/messages/{{ $u->id }}"  data-type="checklist" data-source="#" data-title="Select collections" class="editable editable-click float-right text-decoration-none textcolor-blue btn-customs" data-placement="bottom" data-original-title="" title="">Send a message</a>
						<a href="{{ URL::to('/') }}/user/{{$u->id}}/view"  data-type="text" data-title="Copy this link to share" class="editable editable-click float-right text-decoration-none textcolor-blue btn-customs" data-placement="bottom" data-original-title="" title="">Go to profile</a>                     
										
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endif
@if($opportunity_cards !== null && $opportunity_cards->count() > 0)
	@foreach($opportunity_cards as $opc)
		<div data-opt-id="{{ $opc->id }}" class="search_user_block">
			<div class="card align-last card-custom" style="background: #3170AF;width: 762px;padding: 0px;height: 56px;">
				<p style="font-size: 25px;padding-left: 18px;margin: 0px; margin-top: 10px;color: #fff;">{{$collection_name}}
					<span style="text-decoration: none;padding-right: 24px;float: right;">
						<img src="/assets/images/location2.png" alt="Edit" style="width: 15px;"> 
						<span style="font-weight: 500;font-size: 20px;line-height: 24px;letter-spacing: -0.015em;color: #FFFFFF;float: right;padding-top: 8px;padding-left: 8px;">{{$opc->city}}, {{$countries[$opc->country_code]}}</span>
					</span>
				</p>
				<div style="margin-top:10px;padding-left: 18px;padding-top: 18px;background: #FFFFFF;padding-bottom: 20px;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border-radius: 0px 0px 10px 10px;">
				
						<p style="margin: 0px;font-weight: 600;font-size: 30px;line-height: 36px;">{{ strlen($opc->title) > 150 ? substr($opc->title,0,150).'...' : $opc->title }}</p>
						<p style="margin: 0px;font-size: 18px;line-height: 30px;">{{ strlen($opc->company) > 150 ? substr($opc->company,0,150).'...' : $opc->company }}</p>										
					

					<div style="padding-right: 18px; padding-top:27px;">
						@if(!$third_person)	
							<div>
								<a href="#" class="float-right text-decoration-none textcolor-blue btn-customs " style="color: #CA7073" data-toggle="dropdown" >Delete from collection</a>  
											
								<div class="dropdown-menu dropdown-menu-right"  style="padding: 0px;">
									<p style="padding: 10px;">Are you sure you want to delete?</p>
									<div style="width: 90%;margin: 0 auto;padding-bottom: 10px;">
										<span class="delete_my_individual_collection" style="color: #CA7073;" collection_id="{{$collection_id}}" item_type="opportunity" item_id="{{$opc->id}}">Delete</span> <span style="float: right;color: #219BC4;">Back</span>
									</div>	

								</div>
							</div>
						@endif      
							<div>

								<a href="{{ URL::to('/') }}/opentowork/{{ $opc->id }}/refer" class=" float-right  text-decoration-none textcolor-blue btn-customs" data-toggle="dropdown" >Send Open-to-work</a>    
														
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
						
						<a href="{{ URL::to('/') }}/cards/{{$opc->id}}"  data-type="text" data-title="Copy this link to share" class="editable editable-click float-right text-decoration-none textcolor-blue btn-customs" data-placement="bottom" data-original-title="" title="">Read more</a>                     
										
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endif
@if($opentowork_cards !== null && $opentowork_cards->count() > 0)
	@foreach($opentowork_cards as $opc)
		<div data-opt-id="{{ $opc->id }}" class="search_user_block">
			<div class="card align-last card-custom" style="background: #65C5BF;width: 762px;padding: 0px;height: 56px;">
				<p style="font-size: 25px;padding-left: 18px;margin: 0px; margin-top: 10px;color: #fff;">{{$collection_name}}
					<span style="text-decoration: none;padding-right: 24px;float: right;">
						<img src="/assets/images/location2.png" alt="Edit" style="width: 15px;"> 
						<span style="font-weight: 500;font-size: 20px;line-height: 24px;letter-spacing: -0.015em;color: #FFFFFF;float: right;padding-top: 8px;padding-left: 8px;">{{$opc->city}}, {{$countries[$opc->country_code]}}</span>
					</span>
				</p>
				<div style="margin-top:10px;padding-left: 18px;padding-top: 18px;background: #FFFFFF;padding-bottom: 20px;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border-radius: 0px 0px 10px 10px;">
				
						<p style="margin: 0px;font-weight: 600;font-size: 30px;line-height: 36px;">{{ strlen($opc->title) > 150 ? substr($opc->title,0,150).'...' : $opc->title }}</p>
						<p style="margin: 0px;font-size: 18px;line-height: 30px;">{{ strlen($opc->company) > 150 ? substr($opc->company,0,150).'...' : $opc->company }}</p>										
					

					<div style="padding-right: 18px; padding-top:27px;">
						@if(!$third_person)	

							<a href="#" class="float-right text-decoration-none textcolor-blue btn-customs " style="color: #CA7073" data-toggle="dropdown">Delete from collection</a>  
										
							<div class="dropdown-menu dropdown-menu-right"  style="padding: 0px;">
								<p style="padding: 10px;">Are you sure you want to delete?</p>
								<div style="width: 90%;margin: 0 auto;padding-bottom: 10px;">
									<span class="delete_my_individual_collection" style="color: #CA7073;" collection_id="{{$collection_id}}" item_type="opentowork" item_id="{{$opc->id}}">Delete</span> <span style="float: right;color: #219BC4;">Back</span>
								</div>	

							</div>
						@endif                     
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

						<a href="{{ URL::to('/') }}/opentowork/{{$opc->id}}" data-type="text" data-title="Copy this link to share" class="editable editable-click float-right text-decoration-none textcolor-blue btn-customs" data-placement="bottom" data-original-title="" title="" >Read more</a>                     
										
					</div>
				</div>
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