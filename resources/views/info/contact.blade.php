@extends('layouts.front')
@section('content')
<div id="about" style="border:1px sopd red; margin-top:100px; color:#1C3041">
    <div class="container mt-5 mb-5">
        <section class="page-header">  
        <h2 style="color:#1C3041;text-align:center;font-weight:bold;">Contact us</h2>
        </section>
        <section class="terms-section">
        <div style="min-height:600px;">
			
      <h1 class="page_title"> Contact Us</h1>
      {!! Form::open(['url' => '/contact_us/', 'method' => 'POST']) !!}
				
        <div class="form-group row {{ ((count($errors->get('email_address')) > 0) ? 'has-error' : '') }}">
						<label class="col-md-1 control-label">Email:</label>
						<div class="col-md-9 controls">
							<div class="input-group">
              <input type="text" autocomplete="off" class="form-control" name="email_address" placeholder="Email Address" value="{{ old('email_address') !== null ? old('email_address') : '' }}">

							</div>
						</div>
				</div>


        <div class="form-group row {{ ((count($errors->get('subject')) > 0) ? 'has-error' : '') }}">
						<label class="col-md-1 control-label">Subject:</label>
						<div class="col-md-9 controls">
							<div class="input-group">
              <input type="text" autocomplete="off" class="form-control" name="subject" placeholder="Subject" value="{{ old('subject') !== null ? old('subject') : '' }}">

							</div>
						</div>
				</div>

        <div class="form-group row {{ ((count($errors->get('text_message')) > 0) ? 'has-error' : '') }}">
            <label class="col-md-4 control-label">Message:</label>
            <div class="col-md-10 controls">
                <div class="input-group">
                  <textarea class="form-control" name="text_message">{{ old('text_message') !== null ? old('text_message') : '' }}</textarea>
                </div>
            </div>
        </div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Send</button>
				</div>
				
				{!! Form::close() !!}


        </section>
    </div>
</div>
@endsection