@extends('layouts.front')
@section('content') 

<!-- Open to work Start -->

<div id="opentowork">
    <div class="container bg-gray">                

        <!-- card -->
        <div class="col-md-7 main_area mt-5 pt-5 margin-0-auto">
            <a  href="{{ URL::to('/') }}/user/my_account" class="left_back"><img src='/assets/images/back.png' alt='Back' ></a>
            <div class="m-t-5 card mt-5 align-last">
                <div class="card-header bgcolor-sky textcolor-white">
                    <h2>Open-to-work
                    @if(!$third_person)
                    <a  href="{{ URL::to('/') }}/opentowork/{{$opc->id}}/edit" data-opt-id="{{ $opc->id }}" class="editIcon float-right edit_opportunity_card_link_new">
                        <img src='/assets/images/Icon-edit-new.png' alt='Edit' > <span>Edit</span>
                    </a>
                    @endif
                    </h2>

                </div>
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title font-weight-bold textcolor-black">{{ $opc->title }}</h4>
                    <!-- Data -->
                    <h6>{{ $opc->email }}</h6>
                    <p><span class="">{{ $opc->phone }}</span></p>
                    <p> <span class="fa fa-map-marker"></span> <span class="">{{ isset($countries[$opc->country_code]) ? $countries[$opc->country_code] : '' }}, {{ $opc->city }}</span></p>
                    <p class="mb-2 font-weight-bold">Pitch</p>
                    <!-- Text -->
                    <p class="card-text">{!! nl2br($opc->description) !!}</p>
                    
                    <p class="mb-2 font-weight-bold">Roles of interest</p>
                    <ul class="list-unstyled list-inline d-flex margin-0-auto mb-0">
                        @foreach($opc_roles as $oc)
                        <li class="list-inline-item mr-0 pr-2">
                            <div class="chip bgcolor-purple mr-0">{{ $oc }}</div>
                        </li>
                        @endforeach
                    </ul>
                    <p class="mb-2 font-weight-bold">Skills</p>
                    <ul class="list-unstyled list-inline d-flex margin-0-auto mb-0">
                        @foreach($opc_fields as $oc)
                        <li class="list-inline-item mr-0 pr-2">
                            <div class="chip bgcolor-purple mr-0" style="height:85px;">
                                <p style="margin-bottom: 0px;    padding: 0px 15px 5px 5px;">{{ $oc }}</p>
                              
                                <span style="padding: 0px 15px 5px 5px;">
                                    @if(count($opc_endorse) > 0)
                                    <img src='/assets/images/Icon-endorsed.png' alt='Endorse' />
                                    <span>X {{count($opc_endorse)}}</span>
                                    <span id="opentowork_endorse"  data-opt-id="{{ $opc->id }}" style="color: #90CDE1;float: right;">Undo</span>
                                    
                                    @else
                                        <img src='/assets/images/Icon-endorsed2.png' alt='Endorse' />
                                        <span id="opentowork_endorse"  data-opt-id="{{ $opc->id }}" style="color: #90CDE1;float: right;">Endorse</span>
                                    
                                    @endif
                                </span>
                            </div>
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