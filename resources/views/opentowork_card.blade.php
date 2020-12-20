@extends('layouts.front')
@section('content') 

<!-- Open to work Start -->

<div id="opentowork">
    <div class="container bg-gray">                

        <!-- card -->
        <div class=" main_area margin-0-auto padding-top-80">            
            <div class="card align-last card-custom">
                <a href="{{ URL::to('/') }}/user/my_account" class="left_back"><img src="/assets/images/back.png" alt="Back" ></a>
                <div class="card-header bgcolor-sky textcolor-white card-header-custom">
                    <h2>Open-to-work
                    @if(!$third_person)
                    <a  href="{{ URL::to('/') }}/opentowork/{{$opc->id}}/edit" data-opt-id="{{ $opc->id }}" class="editIcon float-right edit_opportunity_card_link_new">
                        <img src='/assets/images/Icon-edit-new.png' alt='Edit' > <span style="font-weight: 500;font-size: 20px;line-height: 24px; letter-spacing: -0.015em; color: #FFFFFF;">Edit</span>
                    </a>
                    @endif
                    </h2>

                </div>
                <div class="card-body card-body-custom">
                    <!-- Title -->
                    <h4 class="card-title font-weight-bold textcolor-black">{{ $opc->title }}</h4>
                    <!-- Data -->
                    <h6>{{ $opc->email }}</h6>
                    <p class="phone_layout"><span >{{ $opc->phone }}</span></p>
                    <p class="open_to_work_location_icon"><img src="/assets/images/location.png" alt="Location" > <span class="cityLabel">{{ $opc->city }}, {{ isset($countries[$opc->country_code]) ? $countries[$opc->country_code] : '' }} </span></p>
                    <p class="descriptionLabel">Pictch</p>
                    <!-- Text -->
                    <p class="card-text">{!! nl2br(strip_tags($opc->description)) !!}</p>
                    
                    <p class="descriptionLabel">Roles of interest</p>
                    <ul class="list-unstyled list-inline d-flex margin-0-auto mb-0 request_skills">
                        @foreach($opc_roles as $oc)
                        <li class="list-inline-item mr-0 pr-2" style="margin:0px">
                            <div class="chip bgcolor-purple mr-0 chip-custom">{{ $oc }}</div>
                        </li>
                        @endforeach
                    </ul>
                    <p class="mb-2 font-weight-bold">Skills</p>
                    <ul class="list-unstyled list-inline d-flex margin-0-auto mb-0 request_skills">
                        @foreach($opc_fields as $oc)
                        <li class="list-inline-item mr-0 pr-2">
                            <div class="chip bgcolor-purple mr-0 custom_endorse">
                                <p style="margin: 0px;">{{ $oc }}</p>
                              
                                <span >
                                    @if(in_array($logged_in_user_id, $opc_endorse[$oc]))
                                    <a href="#" data-type="checklist" data-source="{{ URL::to('/') }}/ajax/get_endorse_list/{{$opc->user_id}}/{{$oc}}"  data-title="Endorsed User list" class="endorse_list editable editable-click" data-placement="bottom"   data-original-title="" title="" data-logined="{{$logged_in_user_id}}"><img src='/assets/images/Icon-endorsed.png' alt='Endorse' /></a>
                                        @if(count($opc_endorse[$oc]))
                                        <span>X {{count($opc_endorse[$oc])}}</span>
                                        @endif
                                    <span class="opentowork_endorse float-right"  data-opt-skill="{{ $oc }}" data-user-id="{{ $opc->user_id }}" class="undo_icon">Undo</span>
                                    
                                    @else

                                        @if(count($opc_endorse[$oc]))
                                             <a href="#"  data-pk="{{ $opc->user_id }}" data-type="checklist" data-source="{{ URL::to('/') }}/ajax/get_endorse_list/{{$opc->user_id}}/{{$oc}}"  data-title="Endorsed User list" class="endorse_list editable editable-click" data-placement="bottom"   data-original-title="" title="" data-logined="{{$logged_in_user_id}}"><img src='/assets/images/Icon-endorsed.png' alt='Endorse' /></a>                                        
                                            <span>X {{count($opc_endorse[$oc])}}</span>
                                        @else
                                            <img src='/assets/images/Icon-endorsed2.png' alt='Endorse' />
                                        @endif
                                        <span class="opentowork_endorse float-right"  data-opt-skill="{{ $oc }}" data-user-id="{{ $opc->user_id }}" class="undo_icon">Endorse</span>
                                    @endif
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <!-- Button -->
                    <a href="{{ URL::to('/') }}/user/my_account" class=" float-right  text-decoration-none textcolor-blue btn-customs">Go to user profile</a>                    
                    
                    <a href="#" id="opentowork_collection" data-pk="{{ $opc->id }}" data-type="checklist" data-source="{{ URL::to('/') }}/ajax/get_opc_collection_list/{{$opc->id}}"  data-title="Select collections" class="editable editable-click  float-right  text-decoration-none textcolor-blue btn-customs" data-placement="bottom"   data-original-title="" title="">Add to collection</a>
                    
                    
                    <a href="#" id="opportunity_share" data-type="text" data-pk="1" data-title="Copy this link to share" class="editable editable-click  float-right  text-decoration-none textcolor-blue btn-customs" data-placement="bottom" data-original-title="" title="" data-value="{{ URL::to('/') }}/opentowork/{{ $opc->id }}">Share</a>  

                    @if(!$third_person)
                        <a href="#" id="opportunity_findmatch" data-type="select" data-value="Not selected" data-title="Find Matches" class="editable editable-click  float-right  text-decoration-none textcolor-blue btn-customs" data-placement="bottom"  data-original-title="" title="" style="color: #E1E3DD;">Find Matches</a>
                    @else

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