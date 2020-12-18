@extends('layouts.front')
@section('content') 


<!-- Opportunity Start -->

<div id="opportunity">
    <div class="container bg-gray">                

        <!-- card -->
        <div class=" main_area margin-0-auto padding-top-80">
            
            <div class="card align-last card-custom">
                <a href="{{ URL::to('/') }}/user/my-collection" class="left_back"><img src="/assets/images/back.png" alt="Back" style="
                    max-width: 114px;
                "></a>
                <div class="card-header bgcolor-collection textcolor-white card-header-custom">
                    <h2>Collection</<h2>
                </div>
                <div class="opc_error_msg" style="margin:0px"></div>
                <div class="card-body card-body-custom">
                    <div class="form-group row">
						<label class="col-md-2 control-label">Collection name:</label>
						<div class="col-md-10 controls">
							<div class="input-group">
								<input type="text" class="collection_name form-control" maxlength="50" value="{{ $opc && $opc->name ? $opc->name : '' }}" />

							</div>
						</div>
					</div>
                    <div class="form-group row">
						<div class="col-md-12 text-right">
                        @if(isset($id) && $id > 0)
                            <a  style="color:#219BC4;cursor: pointer;" data-col-id="{{ $id }}" class="delete_collection_link" >Delete</a>
                        @endif
						    <a style="color:#CA7073; padding-left:20px;cursor: pointer;" data-col-id="{{ isset($id) ? $id  : 0 }}"  data-opt-refer="{{ isset($refer) ? $refer  : 0 }}" class="add_edit_collection">Save</a>
						</div>
					</div>
            </div>
            <p class="pt-5 text-center">
                <a  href="{{ URL::to('/') }}/user/my-collection"><img src='/assets/images/back.png' alt='Back' ></a>
            </p>
        </div>

            
        </div>
        <!-- End of card -->


    </div>
</div>





@endsection