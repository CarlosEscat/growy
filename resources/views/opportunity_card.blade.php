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


<!-- Opportunity Start -->

<div id="opportunity">
    <div class="container bg-gray">
                

        <!-- card -->
        <div class="col-md-7 main_area mt-5 pt-5 margin-0-auto">
            <a  href="{{ URL::to('/') }}/user/my_account" class="left_back"><img src='/assets/images/back.png' alt='Back' ></a>
            <div class="m-t-5 card mt-5 align-last">
                <div class="card-header bgcolor-blue textcolor-white">
                    <h2>Opportunity
                    @if(!$third_person)
                    <a  href="{{ URL::to('/') }}/cards/{{$opc->id}}/edit" data-opt-id="{{ $opc->id }}" class="editIcon float-right edit_opportunity_card_link_new">
                        <img src='/assets/images/Icon-edit-new.png' alt='Edit' > <span>Edit</span>
                    </a>
                    @endif
                    </h2>

                </div>
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title font-weight-bold textcolor-black">{{ $opc->title }}</h4>
                    <!-- Data -->
                    <h6>{{ $opc->company }}</h6>
                    <p> <span class="fa fa-map-marker"></span> <span class="">{{ isset($countries[$opc->country_code]) ? $countries[$opc->country_code] : '' }}, {{ $opc->city }}</span></p>
                    <p class="mb-2 font-weight-bold">Description</p>
                    <!-- Text -->
                    <p class="card-text">{!! nl2br($opc->description) !!}</p>
                    
                    <p class="mb-2 font-weight-bold">Requested Skills</p>
                    <ul class="list-unstyled list-inline d-flex margin-0-auto mb-0">
                        @foreach($opc_fields as $oc)
                        <li class="list-inline-item mr-0 pr-2">
                            <div class="chip bgcolor-purple mr-0">{{ $oc }}</div>
                        </li>
                        @endforeach
                    </ul>
                    <!-- Button -->
                    <a href="{{ URL::to('/') }}/user/my_account" class="btn btn-flat float-right pl-1 mx-0 mb-0 text-decoration-none textcolor-blue">Go to user profile</a>                    
                    <span class="dropdown-submenu"><a href="#" data-opt-id="{{ $opc->id }}" class="btn btn-flat float-right pl-1 mx-0 mb-0 text-decoration-none textcolor-blue add_to_my_collection_link_new " data-toggle="popover" data-placement="bottom" data-content="" data-html="true" data-sanitize="false">Add to collection</a>
                    </span>
                                     
                    <!-- <span class="dropdown-submenu"><a href="#"  class="btn btn-flat float-right pl-1 mx-0 mb-0 text-decoration-none textcolor-blue add_to_my_collection_link">Share</a>
                        <ul class="view_user_collections_block dropdown-menu">
                            <div class="socoal_buttons_block">
                                <div class="fb-share-button" data-href="http://growyspace.com/cards/{{ $opc->id }}" data-layout="button" data-size="small"><a target="_blank" href="http://growyspace.com/cards/{{ $opc->id }}" class="fb-xfbml-parse-ignore">Share</a></div>
                                <script type="IN/Share" data-size="large" data-url="http://growyspace.com/cards/{{ $opc->id }}"></script>
                            </div>
						</ul>
                    </span>     -->
                    <span class="dropdown-submenu"><a href="#" data-opt-id="{{ $opc->id }}"  class="btn btn-flat float-right pl-1 mx-0 mb-0 text-decoration-none textcolor-blue add_to_share_link_new " data-toggle="popover" data-placement="bottom" data-content="" data-html="true" data-sanitize="false">Share</a>
                    </span>   

                    @if(!$third_person)
                        <a href="#" class="btn btn-flat float-right pl-1 mx-0 mb-0 text-decoration-none textcolor-blue">Find Matches</a>
                    @else
                        <a href="#" class="btn btn-flat float-right pl-1 mx-0 mb-0 text-decoration-none textcolor-blue">Send Opportunity</a>
                    @endif               

                </div>
            </div>
            <p class="pt-5 text-center">
                <a  href="{{ URL::to('/') }}/user/my_account"><img src='/assets/images/back.png' alt='Back' ></a>
            </p>
            
        </div>
        <!-- End of card -->


    </div>
</div>





@endsection