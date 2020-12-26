@extends('layouts.front')
@section('content') 



<!-- Opportunity Start -->

<div id="opportunity">
    <div class="container bg-gray">               

        <!-- card -->
        <div class=" main_area margin-0-auto padding-top-80">
            
            <div class="card align-last card-custom">
                <a href="{{ URL::to('/') }}/user/my_account" class="left_back"><img src="/assets/images/back.png" alt="Back" ></a>
                <div class="card-header bgcolor-blue textcolor-white card-header-custom">
                    <h2>Opportunity
                    @if(!$third_person)
                    <a  href="{{ URL::to('/') }}/cards/{{$opc->id}}/edit" data-opt-id="{{ $opc->id }}" class="editIcon float-right edit_opportunity_card_link_new">
                        <img src='/assets/images/Icon-edit-new.png' alt='Edit' > <span style="font-weight: 500;font-size: 20px;line-height: 24px; letter-spacing: -0.015em; color: #FFFFFF;">Edit</span>
                    </a>
                    @endif
                    </h2>

                </div>
                <div class="card-body card-body-custom">
                    <!-- Title -->
                    <h4 class="card-title font-weight-bold textcolor-black">{{ $opc->title }}</h4>
                    <!-- Data -->
                    <h6>{{ $opc->company }}</h6>
                    <p class="location_icon"><img src="/assets/images/location.png" alt="Location" > <span class="cityLabel">{{ $opc->city }}, {{ isset($countries[$opc->country_code]) ? $countries[$opc->country_code] : '' }} </span></p>
                    <p class="descriptionLabel">Description</p>
                    <!-- Text -->
                    <p class="card-text">{!! nl2br($opc->description) !!}</p>
                    
                    <p class="skillsLabel">Requested Skills</p>
                    <ul class="list-unstyled list-inline d-flex margin-0-auto mb-0 request_skills">
                        @foreach($opc_fields as $oc)
                        <li class="list-inline-item mr-0 pr-2" style="margin:0px">
                            <div class="chip bgcolor-purple mr-0 chip-custom">{{ $oc }}</div>
                        </li>
                        @endforeach
                    </ul>
                    @php ($collection_checked = [])
                    @foreach ($checked_value as $category)
                        @php ($collection_checked[] = $category)
                    @endforeach
                <!-- {{ implode(', ', $collection_checked) }} -->

                    <!-- Button -->
                    <div>
                    <a href="{{ URL::to('/') }}/user/my_account" class=" float-right  text-decoration-none textcolor-blue btn-customs">Go to user profile</a>                    
                    
                    <a href="#" data-pk="{{ $opc->id }}" data-type="checklist" data-source="{{ URL::to('/') }}/ajax/get_opc_collection_list/{{$opc->id}}"  data-title="Select collections" class="opportunity_collection editable editable-click  float-right  text-decoration-none textcolor-blue btn-customs" data-placement="bottom"   data-original-title="" title="">Add to collection</a>
                    
                    
                    <a href="#" id="opportunity_share" data-type="text" data-pk="1" data-title="Copy this link to share" class="editable editable-click  float-right  text-decoration-none textcolor-blue btn-customs" data-placement="bottom" data-original-title="" title="" data-value="{{ URL::to('/') }}/cards/{{ $opc->id }}">Share</a>  

                    @if(!$third_person)
                        <a href="#" id="opportunity_findmatch" data-type="select" data-value="Not selected" data-title="Find Matches" class="editable editable-click  float-right  text-decoration-none textcolor-blue btn-customs" data-placement="bottom"  data-original-title="" title="" style="color: #E1E3DD;">Find Matches</a>
                    @else
                        
                        <a href="{{ URL::to('/') }}/opentowork/{{ $opc->id }}/refer" class=" float-right  text-decoration-none textcolor-blue btn-customs" data-toggle="dropdown">Send Open-to-work</a>    
                                              	
							<div class="dropdown-menu dropdown-menu-right"  style="padding: 0px;">
                            @if(count($opc_list) > 0) 
                                <ul style="margin: 0px;padding: 0px;">
                                    @foreach ($opc_list as $item)
                                        <li class="send_opentowork"><a href="{{ URL::to('/') }}/opentowork/{{ $item->id }}">{{$item->title}}</a></li>
                                    @endforeach
                                        <li class="send_opentowork"><a href="{{ URL::to('/') }}/opentowork/{{ $opc->id }}/refer">Create New one</a></li>
                                </ul>
                            @else
                                 <li class="send_opentowork"><a href="{{ URL::to('/') }}/opentowork/{{ $opc->id }}/refer">Create New one</a></li>
                            @endif
							</div>
    
                    @endif               
                    </div>
                </div>
            </div>
            <p class="padding-top-100 text-center">
                <a  href="{{ URL::to('/') }}/user/my_account"><img src='/assets/images/back.png' alt='Back' ></a>
            </p>
            
        </div>
        <!-- End of card -->


    </div>
</div>





@endsection