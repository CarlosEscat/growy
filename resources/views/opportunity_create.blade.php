@extends('layouts.front')
@section('content') 


<!-- Opportunity Start -->

<div id="opportunity">
    <div class="container bg-gray">                

        <!-- card -->
        <div class=" main_area margin-0-auto padding-top-80">
            
            <div class="card align-last card-custom">
                <a href="{{ URL::to('/') }}/user/my_account" class="left_back"><img src="/assets/images/back.png" alt="Back" style="
                    max-width: 114px;
                "></a>
                <div class="card-header bgcolor-blue textcolor-white card-header-custom">
                    <h2>Opportunity
                </div>
                <div class="opc_error_msg" style="margin:0px"></div>
                <div class="card-body card-body-custom">
                    <div class="form-group row">
						<label class="col-md-2 control-label">Position:</label>
						<div class="col-md-10 controls">
							<div class="input-group">
								<input type="text" class="opc_title form-control" maxlength="50" value="{{ $opc && $opc->title ? $opc->title : '' }}" />

							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 control-label">Company:</label>
						<div class="col-md-10 controls">
							<div class="input-group">
								<input type="text" class="opc_company form-control" value="{{ $opc && $opc->company ? $opc->company : '' }}" />
							</div>
						</div>
					</div>
                    <div class="form-group row">
                        <label class="col-md-2 control-label">Location:</label>
						<div class="col-md-10 controls">   
                            <div style="float:left;width:49%; margin-right:1%">
                                <div class="controls">
                                    <div class="input-group">
                                        <select class="form-control opc_country_code" name="chosen">
                                            <option value="">Select a Country</option>
                                            @foreach($countries as $country_code => $coutry_name)
                                                <option value="{{ $country_code }}" {{ $opc && $opc->country_code === $country_code ? 'selected' : '' }}>{{ $coutry_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="float:left;width:49%; margin-left:1%">
                                <div class="controls">
                                    <div class="input-group">
                                        <input type="text" placeholder="city" class="opc_city form-control" value="{{ $opc && $opc->city ? $opc->city : '' }}" />
                                    </div>
                                </div>
                            </div>
               
						</div>

                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 control-label">Description:</label>
                        <div class="col-md-12 controls">
                            <div class="input-group">
                                <textarea class="form-control opc_description">{{ $opc && $opc->description ? nl2br($opc->description)  : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Requested Skills:</label>
                        <div class="col-md-10">
                            <div class="input-group">
								<select style="width:100%;" multiple class="opc_fields form-control">
                                    @foreach($opc_fields as $oc => $val)
                                        <option value="{{$val}}" {{ isset($opc_fields_db) && count($opc_fields_db) > 0 && in_array($val, $opc_fields_db) ? 'selected' : '' }}>{{$val}}</option>
                                    @endforeach
                                   
                                   
								</select>
							</div>
                        </div>
                    </div>
                    <div class="form-group row">
						<div class="col-md-12 text-right">
                        @if(isset($id) && $id > 0)
                            <a  style="color:#219BC4;cursor: pointer;" data-opt-id="{{ $id }}" class="delete_opportunity_card_link" >Delete</a>
                        @endif
						    <a style="color:#CA7073; padding-left:20px;cursor: pointer;" data-opt-id="{{ isset($id) ? $id  : 0 }}" data-opt-refer="{{ isset($refer) ? $refer  : 0 }}" class="add_edit_opportunity_card">Save</a>
						</div>
					</div>
                </div>
            </div>
            <p class="pt-5 text-center">
                <a  href="{{ URL::to('/') }}/user/my_account"><img src='/assets/images/back.png' alt='Back' ></a>
            </p>
        </div>

            
        </div>
        <!-- End of card -->


    </div>
</div>





@endsection