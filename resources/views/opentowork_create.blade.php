@extends('layouts.front')
@section('content') 


<!-- Open-to-work Start -->

<div id="opentowork">
    <div class="container bg-gray">                

        <!-- card -->
        <div class="col-md-6 main_area mt-5 pt-5 margin-0-auto">
            <a  href="{{ URL::to('/') }}/user/my_account" class="left_back"><img src='/assets/images/back.png' alt='Back' ></a>
            <div class=" card mt-5 align-last">
                <div class="card-header bgcolor-sky textcolor-white">
                    <h2>Open-to-work</h2>
                </div>
                <div class="opc_error_msg"></div>
					<br/>
                <div class="card-body mt-2">
                    <div class="form-group row">
						<label class="col-md-2 control-label">Name:</label>
						<div class="col-md-10 controls">
							<div class="input-group">
								<input type="text" class="opc_title form-control" maxlength="50" value="{{ $opc && $opc->title ? $opc->title : '' }}" />

							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 control-label">Email:</label>
						<div class="col-md-10 controls">
							<div class="input-group">
								<input type="text" class="opc_email form-control" value="{{ $opc && $opc->email ? $opc->email : '' }}" />
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 control-label">Phone Number:</label>
						<div class="col-md-10 controls">
							<div class="input-group">
								<input type="text" class="opc_phone form-control" value="{{ $opc && $opc->phone ? $opc->phone : '' }}" />
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
                        <label class="col-md-3 control-label">Pitch:</label>
                        <div class="col-md-12 controls">
                            <div class="input-group">
                                <textarea class="form-control opc_description">{{ $opc && $opc->description ? nl2br($opc->description)  : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Roles of interests:</label>
                        <div class="col-md-10">
                            <div class="input-group">
								<select style="width:100%;" multiple class="opc_roles form-control">
                                    @foreach($opc_roles as $oc => $val)
                                        <option value="{{$val}}" {{ isset($opc_roles_db) && count($opc_roles_db) > 0 && in_array($val, $opc_roles_db) ? 'selected' : '' }}>{{$val}}</option>
                                    @endforeach
                                   
                                   
								</select>
							</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Skills:</label>
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
						    <a style="color:#CA7073; padding-left:20px;cursor: pointer;" data-opt-id="{{ isset($id) ? $id  : 0 }}" class="add_edit_opentowork_card">Save</a>
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