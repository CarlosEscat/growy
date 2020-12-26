@extends('layouts.front')
@section ('content')


<div class='background'>

  <div class="my_profile">
				<h2 style="color:#332960;padding-top:4%;font-weight:600;"><img src="../assets/images/icon-profile1.png"/> My Profile</h2>
	</div>

  <div class='header_color'></div> 

  <div class='account_container'>
    

    <div style="display:flex;">
			<h3 style="font-weight:600;" class="card-title">About me</h3>
		</div>
 
		<div style="display:flex;">
        <div>   
				@if($profile_image_src !== false)
			    <img class="profile_pic_wrapper profile_pic_wrapper_rounded" src="{{ $profile_image_src }}" />
				@else
				@if($owner === true)
					<img class="profile_pic_wrapper" src="{{ URL::to('/') }}/assets/images/profile_pic_wrapper.png" />
				@else
					<img class="profile_pic_wrapper" src="{{ URL::to('/') }}/assets/images/profile_pic_wrapper2.png" />
				@endif
				@endif
				</div>
				<div class="profile_name_profession_block">
					<label class="edit_label" >Name:</label> 
					<input type="text" value="{{ $user->full_name }}" ></br> 
					
					<label class="edit_label" >Title:</label>
					<input type="text" value="{{ $user->profession }}"></br> 
					
					<label class="edit_label" >Location:</label> 
					<input type="text" value="{{ $user->city }}, {{ $country }}"></br> 
					
				</div>
			</div>

			<div class="profile_presentation_letter" style="margin-top:20px; margin-left:5px;">
					<label class="edit_label" >Presentation letter:</label></br>
					<textarea class="edit_textarea" >{{ $user->my_pitch }}</textarea>
			</div>

			<div class="profile_experience"  style="margin-top:20px">
					<h3 style="font-weight:600;" class="card-title">Experience</h3>

						@foreach($user_experiences as $ue)
							<div style="display: flex; justify-content: space-around; margin-top:30px;" data-exp-id="{{ $ue->id }}" class="experience_bloc">
								
								@if(is_file(base_path() . '/public/uploads/exp/'.$ue->id.'/'.$ue->company_logo_url))
									<img class="hidden experience_compny_img" src="{{ URL::to('/') }}/uploads/exp/{{ $ue->id }}/{{ $ue->company_logo_url }}" />
								@else
									<img class="hidden experience_bag" src="{{ URL::to('/') }}/assets/images/bag.png" />
								@endif
								<div class="hidden experience_block_bottom"></div>
								 	<div>
										<h2>{{ strlen($ue->title) > 20 ? substr($ue->title,0,20).'...' : $ue->title }}</h2>
										<p><span class="fa fa-map-marker"></span> {{ (isset($countries[$ue->country_code]) ? $countries[$ue->country_code] : '' ) .' '.$ue->city }}</p>
									</div>
									
									<div>
										<h4>{{ strlen($ue->company) > 20 ? substr($ue->company,0,20).'...' : $ue->company }}</h4>
									
										<p>{{ date("m/Y", strtotime($ue->from_date)) }} to 
										@if($ue->currently_working == 1)
											Present
										@else	
											{{ date("m/Y", strtotime($ue->to_date)) }}
										@endif
										</p>
									</div>

									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="ue{{ $ue->id }}">
										<a data-exp-id="{{ $ue->id }}" class="dropdown-item edit_experience_link" href=""> Edit</a>
										<a data-exp-id="{{ $ue->id }}" class="dropdown-item delete_experience_link"> Delete</a>
									</div>

							</div>
						@endforeach
					
					<div class="experience_new" >
					<label class="edit_label" style="margin-top:30px">Role:</label> 
					<input type="text" value="" ></br> 
					
					<label class="edit_label" >Company:</label>
					<input type="text" value=""></br> 
					
					<label class="edit_label" >Location:</label> 
					<select class="form-control exp_country_code" name="chosen" id="location_exp">
						<option value="">Select a Country</option>
							@foreach($countries as $country_code => $coutry_name)
								<option value="{{ $country_code }}">{{ $coutry_name }}</option>
							@endforeach
					</select> </br>

					<label class="edit_label" >Started:</label> 
					<select  class="exp_from_month form-control" id="month_exp">
						<option value="">Month</option>
						@foreach($months as $m_id => $m)
							<option value="{{ $m_id }}">{{ $m }}</option>
						@endforeach
					</select>
					<select class="exp_from_year form-control" id="year_exp">
							<option value="">Year</option>
								@for($i = 1975;$i <= date('Y') + 7;$i++)
								<option value="{{ $i }}">{{ $i }}</option>
								@endfor
					</select>
					<label class="edit_label" >Ended:</label> 
					<select  class="exp_to_month form-control" id="end_month_exp">
						<option value="">Month</option>
							@foreach($months as $m_id => $m)
								<option value="{{ $m_id }}">{{ $m }}</option>
							@endforeach
					</select>
					<select class="exp_from_year form-control" id="end_year_exp">
							<option value="">Year</option>
								@for($i = 1975;$i <= date('Y') + 7;$i++)
								<option value="{{ $i }}">{{ $i }}</option>
								@endfor
					</select>
					</div>

					<div style="text-align:right">
						<button class="button_add_experience">Add another experience</button>
					</div>

				</div> 

				<div class="profile_education"  style="margin-top:20px">
					<h3 style="font-weight:600;" class="card-title">Education</h3>
 
					@foreach($user_educations as $ue)
						<div style="display: flex; justify-content: space-around; margin-top:30px;" data-edu-id="{{ $ue->id }}" class="edu_bloc">
							
							<img class="hidden edu_block_img" src="{{ URL::to('/') }}/assets/images/hat2.png" />		
							<div class="edu_block_bottom hidden"></div>
							<div>
								<h3 alt="{{ $ue->title }}" >{{ strlen($ue->title) > 20 ? substr($ue->title,0,20).'...' : $ue->title }}</h3>
								<p><span class="fa fa-map-marker"></span> {{ (isset($countries[$ue->country_code]) ? $countries[$ue->country_code] : '' ) .' '.$ue->city }}</p>
							</div>
							<div>
								<h4 alt="{{ $ue->school }}">{{ strlen($ue->school) > 20 ? substr($ue->school,0,20).'...' : $ue->school  }}</h4>
								<p>{{ $ue->from_year }} to {{ $ue->to_year }}</p>		
							</div>
							
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="edu{{ $ue->id }}">
									<a data-edu-id="{{ $ue->id }}" class="dropdown-item edit_education_link" href=""> Edit</a>
									<a data-edu-id="{{ $ue->id }}" class="dropdown-item delete_education_link"> Delete</a>
								</div>
							
						</div>
					@endforeach

					<label class="edit_label" style="margin-top:20px">Field of Study:</label> 
					<input type="text" ></br> 
					
					<label class="edit_label" >School:</label>
					<input type="text" ></br> 
					
					<label class="edit_label" >Location:</label> 
					<select class="form-control exp_country_code" name="chosen" id="location_edu">
						<option value="">Select a Country</option>
							@foreach($countries as $country_code => $coutry_name)
								<option value="{{ $country_code }}">{{ $coutry_name }}</option>
							@endforeach
					</select> 

					<label class="edit_label" >Started:</label> 
					<select  class="exp_from_month form-control" id="month_edu">
						<option value="">Month</option>
						@foreach($months as $m_id => $m)
							<option value="{{ $m_id }}">{{ $m }}</option>
						@endforeach
					</select>
					<select class="exp_from_year form-control" id="year_edu">
							<option value="">Year</option>
								@for($i = 1975;$i <= date('Y') + 7;$i++)
								<option value="{{ $i }}">{{ $i }}</option>
								@endfor
					</select>
					<label class="edit_label" style="width:85px">Ended:</label> 
					<select  class="exp_to_month form-control" id="end_month_edu">
						<option value="">Month</option>
							@foreach($months as $m_id => $m)
								<option value="{{ $m_id }}">{{ $m }}</option>
							@endforeach
					</select>
					<select class="exp_from_year form-control" id="end_year_edu">
							<option value="">Year</option>
								@for($i = 1975;$i <= date('Y') + 7;$i++)
								<option value="{{ $i }}">{{ $i }}</option>
								@endfor
					</select></br>

					<div style="text-align:right">
						<button class="button_add_education">Add another education</button>
					</div> 

				</div> 
						
				<div class="save_profyle" style="text-align:right; margin-top:20px;" >
					<a style="color:#219BC4;font-size:20px;text-decoration:none;margin-right:5%;" href="">Save </a>
				</div>
  
  </div>

</div>

@endsection  