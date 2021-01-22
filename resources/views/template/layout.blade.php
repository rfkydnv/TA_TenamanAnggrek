<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

	<!-- begin::Head -->
	<head>

		<!--begin::Base Path (base relative path for assets of this page) -->
		<base href="../">

		@include('template.plugins.meta')

		<!--begin::Fonts -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script src="{{asset('assets/vendors/custom/pace/pace.js')}}" type="text/javascript"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>

		@include('template.plugins.css')

		@yield('css')

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
		<script src="{{mix('js/app.js')}}" type="text/javascript"></script>
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
		<div id="vue-app">
			
		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="demo1/index.html">
					<img alt="Logo" src="{{asset('metronic/media/logos/logo-light.png')}}" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				@include('template.sidebar')

				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					@include('template.header')

					<!-- end:: Header -->
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor core-content-body"  id="kt-content">
						@include('template.breadcrumb')

						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="head">

							@yield('container')
							<!--End::Dashboard 1-->
						</div>

							@stack('scripts')
						<!-- end:: Content -->
					</div>
					@include('template.footer')
				</div>
			</div>
		</div>

		<!-- end:: Page -->
		@include('template.quick_panel')
		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->
			
		<!-- begin::Sticky Toolbar -->
		@include('template.sticky_toolbar')
		<!-- end::Sticky Toolbar -->

		<!-- begin::Demo Panel -->
		{{-- @include('template.demo_panel') --}}
		<!-- end::Demo Panel -->

		<!--Begin:: Chat-->
		{{-- @include('template.chat') --}}
		<!--ENd:: Chat-->
		
		</div>

		<!-- begin::Global Config(global config for global JS sciprts) -->
		{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script> --}}

		@include('template.plugins.js')
		{{-- <script src="{{asset('metronic/js/demo1/pages/crud/datatables/basic/basic.js')}}" type="text/javascript"></script> --}}
		<div class="js">
			@yield("script")
		</div>

		<script>

			KTUtil.ready(function(){
                MyApp.init();
                document.addEventListener("turbolinks:click", function() {
					App.blockUI();
				});
			});
		</script>
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>