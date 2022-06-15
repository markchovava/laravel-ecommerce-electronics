

<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	@include('backend.layouts.head')
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="{{ url('/') }}" class="mb-12">
						<img alt="Logo" src="{{ asset('backend/assets/images/logos/lunar-logo.png') }}" class="h-80px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form method="POST" action="{{ route('login') }}" class="form w-100">
                            @csrf
                            <!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Sign In to Lunartech</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">New Here?
								<a href="{{ route('register') }}" class="link-primary fw-bolder">Create an Account</a></div>
								<!--end::Link-->
							</div>
							<!--begin::Heading-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="form-label fs-6 fw-bolder text-dark">Email</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input type="text" name="email" class="form-control form-control-lg form-control-solid" autocomplete="off" />
								<!--end::Input-->
								@error('email')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack mb-2">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
									<!--end::Label-->
									<!--begin::Link-->
									<a href="#" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Input-->
								<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
								<!--end::Input-->
								@error('password')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<!--end::Input group-->
							<div class="fv-row mb-10">
								<div class="form-check form-check-custom form-check-solid">
									<input type="checkbox" name="remember" checked class="form-check-input" id="remember"/>
									<label class="link-primary fs-6 fw-bolder mx-3" for="remember">
										Remember Me!
									</label>
								</div>
							</div>
							<!--begin::Actions-->
							<div class="text-center">
								<!--begin::Submit button-->
								<input type="submit" value="Submit" class="btn btn-lg btn-primary w-100 mb-5" />
								<!--end::Submit button-->
								
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-column-auto p-10">
					<!--begin::Links-->
					<div class="d-flex align-items-center fw-bold fs-6">
						<a href="" class="text-muted text-hover-primary px-2">About Us</a>
						<a href="" class="text-muted text-hover-primary px-2">Contact Us</a>
					</div>
					<!--end::Links-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		@include('auth.includes.scripts')
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
