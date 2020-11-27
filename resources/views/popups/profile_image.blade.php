<a href="#profile_image_popup" class="open_profile_image_popup"></a>
<div class="spacelab_popup white-popup mfp-hide" id="profile_image_popup">
	
	<div class="popup_header">
		<h1 class="add_edit_opportunity_card_title">Profile Image</h1>
	</div>
	
		<div class="col-md-12">
			<div class="box-content">
			
				<div class="form-horizontal">
					
					<div class="form-group">
						<label class="col-sm-3 col-lg-2 control-label"></label>
						<div class="col-sm-9 col-lg-12 controls">
							<div class="input-group">
								<input type="file" name="profile_image" value="" />
								<p style="font-size:30px;margin-top:10px;width:100%;color:orange;">Drag frame to adjust portrait.</p>
								<div  style="height:450px;width:500px;border:1px solid black;" class="popup_profile_image_block">
								@if(is_file(base_path() . '/public/uploads/profile/'.$user_id.'/'.$user->profile_image))
									
									<div class="profile_image_croper_block"></div>
									<script>
										window.profile_image = '{{ URL::to("/")."/uploads/profile/".$user_id."/".$user->profile_image }}';
										
									</script>
									@if(trim($user->cropped_image_info) != '')
										@php
											$cropped_image_info = json_decode($user->cropped_image_info,true);
										@endphp
										@if (json_last_error() === JSON_ERROR_NONE)
											<script>window.cropped_image_info = JSON.parse('{!! $user->cropped_image_info !!}');</script>
										@endif
									@endif
								@endif
								</div>
								
							</div>
						</div>
					</div>
					
					
					<div style="overflow:hidden;margin-top:37px;text-align:right;" class="form-group">
						
						   <button class="basic-result btn btn-primary save_profile_image_cropped_data">Save</button>
					
					</div>
									
					
				</div>
			</div>
		
		</div>
</div>
