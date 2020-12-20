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
					@foreach($collections as $collection)
					<div data-col-id="{{ $collection->id }}" data-col-name="{{ base64_encode($collection->name) }}" class="collection_item_block">
											
						<h4 style="font-weight: 600;font-size: 26px;line-height: 36px;letter-spacing: -0.015em;color: #000000;">
							{{ $collection->name }}

							<a  href="{{ URL::to('/') }}/user/collection/{{ $collection->id }}" data-col-id="{{ $collection->id }}" data-col-name="{{ base64_encode($collection->name) }}" class="editIcon float-right edit_collection_link">
							<img src='/assets/images/Icon-edit-new.png' alt='Edit' ></a></h4>
						<p data-id="col{{ $collection->id }}" class="collection_entries_count " style="margin:0px">Created by: <span style="color:#219BC4;padding-left: 8px;">{{ $username}}</span></p>
				
						<a href="#" data-type="text"  data-title="Copy this link to share" class="editable editable-click  float-right  text-decoration-none textcolor-blue btn-customs collection_share" data-placement="bottom" data-original-title="" title="" data-value="{{ URL::to('/') }}/collections/{{ $collection->id }}">Share</a>
					</div>
					@endforeach
					
					<div class="add_collection_link_block add_collection_link_"> <a href="{{ URL::to('/') }}/user/collection/" style="text-decoration: none;color: #000">Create new collection</a></div>
				</div>	
				<div style="min-height:300px;padding-left: 45px;" class="collection_items_block col-md-8">			
	
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