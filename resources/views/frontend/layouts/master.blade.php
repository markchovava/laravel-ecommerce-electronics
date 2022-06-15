<!DOCTYPE html>
<html lang="en">
   
@include('frontend.layouts.head')

    <body>

        <!-- ========== HEADER ========== -->
        @include('frontend.layouts.header')
        <!-- ========== END HEADER ========== -->

        <!-- ========== MAIN CONTENT ========== -->
        @yield('frontend')
        <!-- ========== END MAIN CONTENT ========== -->

        <!-- ========== FOOTER ========== -->
        @include('frontend.layouts.footer')
        <!-- ========== END FOOTER ========== -->

        

        <!-- Go to Top -->
        <a class="js-go-to u-go-to" href="#"
            data-position='{"bottom": 15, "right": 15 }'
            data-type="fixed"
            data-offset-top="400"
            data-compensation="#header"
            data-show-effect="slideInUp"
            data-hide-effect="slideOutDown">
            <span class="fas fa-arrow-up u-go-to__inner"></span>
        </a>
        <!-- End Go to Top -->

       <!-- :::::::::: JAVASCRIPT SCRIPTS -->
       @include('frontend.layouts.js.scripts')

        <!-- :::::::::: JS Plugins Init. -->
        @include('frontend.layouts.js.plugins_init')

        @if(Session::has('message'))
			<script>
				var type = "{{ Session::get('alert-type','info') }}";
				switch(type)
					{
						case 'info' :
							toastr.info(" {{ Session::get('message') }} ");
							break;
						case 'success' :
							toastr.success(" {{ Session::get('message') }} ");
							break;
						case 'warning' :
							toastr.warning(" {{ Session::get('message') }} ");
							break;
						case 'error' :
							toastr.error(" {{ Session::get('message') }} ");
							break;
					}
			</script>
		@endif
    </body>
</html>
