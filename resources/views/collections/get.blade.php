@extends('layouts.front')
@section('content')
<div id="collections">
    <div class="container bg-gray">

		<div class="col-md-10 main_area mt-5 pt-5 margin-0-auto">
            <div class="row mt-3 col-md-12">
				<div class="header">			
				<p style="float: left;"><img src='/assets/images/collection_header_icon.png' alt='Setting' >Collections</p>
				</div>
			</div>

			<div class="row  mt-3">
				<div style="min-height:300px;" class="col-md-4">

					<div data-col-id="{{ $collection->id }}" data-col-name="{{ base64_encode($collection->name) }}" class="collection_item_block">
											
						<h4 style="font-weight: 600;font-size: 26px;line-height: 36px;letter-spacing: -0.015em;color: #000000;">
							{{ $collection->name }}
							@if(!$third_person)							
							<a  href="{{ URL::to('/') }}/user/collection/{{ $collection->id }}" data-col-id="{{ $collection->id }}" data-col-name="{{ base64_encode($collection->name) }}" class="editIcon float-right edit_collection_link">
							<img src='/assets/images/Icon-edit-new.png' alt='Edit' ></a>
							@endif
							</h4>
						<p data-id="col{{ $collection->id }}" class="collection_entries_count " style="margin:0px">Created by: <span style="color:#219BC4;padding-left: 8px;">{{ $user->full_name}}</span></p>
				
						<a href="#" data-type="text"  data-title="Copy this link to share" class="editable editable-click  float-right  text-decoration-none textcolor-blue btn-customs collection_share" data-placement="bottom" data-original-title="" title="" data-value="{{ URL::to('/') }}/collections/{{ $collection->id }}">Share</a>
					</div>
					
					
					<!-- <div class="add_collection_link_block add_collection_link_"> <a href="{{ URL::to('/') }}/user/collection/" style="text-decoration: none;color: #000">Create new collection</a></div> -->
				</div>	
				<div style="min-height:300px;padding-left: 45px;" class="collection_items_block col-md-8">			
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
									<a href="#" class="float-right text-decoration-none textcolor-blue btn-customs " style="color: #CA7073" data-toggle="dropdown">Delete from collection</a>  
										
										<div class="dropdown-menu dropdown-menu-right"  style="padding: 0px;">
											<p style="padding: 10px;">Are you sure you want to delete?</p>
											<div style="width: 90%;margin: 0 auto;padding-bottom: 10px;">
												<span class="delete_my_individual_collection" style="color: #CA7073;" collection_id="{{$collection_id}}" item_type="opportunity" item_id="{{$opc->id}}">Delete</span> <span style="float: right;color: #219BC4;">Back</span>
											</div>	
			
										</div> 
									@endif                 
										<a href="#"  data-type="checklist" data-source="#" data-title="Select collections" class="editable editable-click float-right text-decoration-none textcolor-blue btn-customs" data-placement="bottom" data-original-title="" title="">Send Open-to-work</a>
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
										<a href="#"   data-type="checklist" data-source="#" data-title="Select collections" class="editable editable-click float-right text-decoration-none textcolor-blue btn-customs" data-placement="bottom" data-original-title="" title="">Send opportunity</a>
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
				</div>		
			</div>
		</div>
	</div>
	
</div>
@include('popups.add_edit_collection')
@include('popups.view_user')
@include('popups.view_opportunity_card')
@include('popups.add_edit_opportunity_card')
@include('popups.invite_user_to_this_card')
@endsection