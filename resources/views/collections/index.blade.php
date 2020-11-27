@extends('layouts.front')
@section('content')
<!-- Content -->
<div style="margin-top: 88px;height:100%;" class="container page-content bg-white">
  	<!-- Breadcrumb row -->
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="{{ URL::to('/') }}">Home</a></li>
				<li class="active">My Collection</li>
			
			</ul>
		</div>
	</div>
	<div style="margin-top:30px;margin-bottom:40px;" class="row"> 
	 <!-- Header -->
		<div style="min-height:300px;" class="col-md-4">
			@foreach($collections as $collection)
			<div data-col-id="{{ $collection->id }}" data-col-name="{{ base64_encode($collection->name) }}" class="collection_item_block">
				<div class="dropdown collection_actions_block">
					<button class="btn btn-light dropdown-toggle" type="button" id="col{{ $collection->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="sr-only"></span>
					</button>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="col{{ $collection->id }}">
						<a data-col-id="{{ $collection->id }}" data-col-name="{{ base64_encode($collection->name) }}" class="dropdown-item edit_collection_link" href=""> Edit</a>
						<a data-col-id="{{ $collection->id }}" class="dropdown-item delete_collection_link"> Delete</a>
					</div>
				</div>
			
				<h4>{{ $collection->name }}</h4>
				<p data-id="col{{ $collection->id }}" class="collection_entries_count ">{{ $collection->items_count() > 1 ? $collection->items_count().' entries' : $collection->items_count().' entry' }}</p>
			</div>
			@endforeach
			
			<div class="add_collection_link_block">
				<img class="add_collection_link" src="/assets/images/plus_icon.png" />
				<i class="hidden add_collection_link fa-4x fa fa-plus-circle" aria-hidden="true"></i>
				<p>Add new collection</p>
			</div>
		</div>
		<div style="min-height:300px;" class="collection_items_block col-md-8">
			
		</div>
    </div>
	
</div>
@include('popups.add_edit_collection')
@include('popups.view_user')
@include('popups.view_opportunity_card')
@include('popups.add_edit_opportunity_card')
@include('popups.invite_user_to_this_card')
@endsection