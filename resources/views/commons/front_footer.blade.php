		<!-- Footer -->
		<footer class="footer">
			<div style="display:none;" class="container">
			  <p class="m-0 text-center text-white">Copyright &copy; spacelab.com {{ date('Y') }}</p>
			</div>
			 <ul class="footer_menu">
				<li>Copyright &copy; growyspace.com {{ date('Y') }}</li>
				
			 </ul>
			 <ul class="footer_menu2">
				<li><a href="{{ URL::to('/') }}/page/terms-and-conditions/1.htm">Terms</a></li>
				<li> | </li>
				<li><a href="{{ URL::to('/') }}/page/privacy-and-policy/2.htm">Privacy</a></li>
				<li> | </li>
				<li><a href="{{ URL::to('/') }}/page/about-us/3.htm">About Us</a></li>
				<li> | </li>
				<li><a href="{{ URL::to('/') }}/page/contact/4.htm">Contact</a></li>
			 </ul>
			<!-- /.container -->
			<span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=88ZD4Sx5DtrPLPc2gtcnTtH3SfgrKbWkhtOp4Ecbh39MCg8ywYOB7gx1TMFW"></script></span>
		</footer>
		<!-- Bootstrap core JavaScript -->
		<script src="{{ URL::to('/') }}/assets/js/jquery.min.js"></script>
		
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="{{ URL::to('/') }}/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
		<script src="{{ URL::to('/') }}/assets/plugins/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="{{ URL::to('/') }}/assets/plugins/croppie/croppie.js"></script>
		<script src="{{ URL::to('/') }}/assets/plugins/notify/bootstrap-notify.min.js"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
		<script src="{{ URL::to('/') }}/assets/js/main.js?{{ time() }}"></script>
		<input type="hidden" class="_token" value="{!! csrf_token() !!}" />
		@if (count($errors) > 0) 
			<script type="text/javascript">
				@foreach ($errors->all() as $key =>  $error)
					$.notify({
						// options
						message: '{{ $error }}' 
					},{
						// settings
						type: 'danger',
						placement: {
							align: 'center'
						},
						delay:1000
					});
				@endforeach
			</script>
		@endif
		@if(session('message')) 
		<script type="text/javascript">
			$.notify({
				// options
				message: "{{ session('message') }}" 
			},{
				// settings
				type: 'success',
				placement: {
					align: 'center'
				},
				delay:1000
			});
		</script>
		@endif
		
	</body>
</html>
