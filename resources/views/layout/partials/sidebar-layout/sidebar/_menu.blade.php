<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
	<!--begin::Menu wrapper-->
	<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
		data-kt-scroll-activate="true" data-kt-scroll-height="auto"
		data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
		data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
		<!--begin::Menu-->
		<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true"
			data-kt-menu-expand="false">
			<!--begin:Menu item-->
	
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item pt-5">
				<!--begin:Menu content-->
				<div class="menu-content">
					<span class="menu-heading fw-semibold text-uppercase fs-7">Pages</span>
				</div>
				<!--end:Menu content-->
			</div>
	
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon"><svg fill="#0E86D4" viewBox="0 0 846.66 846.66" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#0E86D4" stroke-width="21.1665"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style type="text/css">  .fil0 {fill:black;fill-rule:nonzero}  </style> </defs> <g id="Layer_x0020_1"> <path class="fil0" d="M94.63 9.1l483.79 0c4.99,0.04 9.19,1.59 12.96,4.56l171.53 121.21c5.9,3.65 9.84,10.18 9.84,17.63l0 664.35c0,11.44 -9.28,20.71 -20.71,20.71l-657.41 0c-11.44,0 -20.72,-9.27 -20.72,-20.71l0 -787.04c0,-11.44 9.28,-20.71 20.72,-20.71zm137.12 519.85c-27.24,0 -27.24,-41.42 0,-41.42l383.16 0c27.25,0 27.25,41.42 0,41.42l-383.16 0zm0 205.05c-27.24,0 -27.24,-41.42 0,-41.42l383.16 0c27.25,0 27.25,41.42 0,41.42l-383.16 0zm0 -102.52c-27.24,0 -27.24,-41.43 0,-41.43l383.16 0c27.25,0 27.25,41.43 0,41.43l-383.16 0zm131.55 -328.81c30.97,23.15 49.31,59.43 49.31,98.21 0,11.44 -9.27,20.71 -20.71,20.71l-203.63 0c-11.44,0 -20.72,-9.27 -20.72,-20.71 0,-38.78 18.35,-75.06 49.31,-98.21 -10.99,-15.01 -17.49,-33.53 -17.49,-53.56 0,-50.09 40.62,-90.71 90.71,-90.71 50.1,0 90.71,40.62 90.71,90.71 0,20.03 -6.49,38.55 -17.49,53.56zm-113.46 27.76c-18.9,10.8 -32.7,28.69 -38.21,49.74l156.91 0c-5.51,-21.05 -19.31,-38.94 -38.22,-49.74 -12.12,6.01 -25.79,9.39 -40.24,9.39 -14.45,0 -28.11,-3.38 -40.24,-9.39zm40.24 -130.6c-27.22,0 -49.28,22.06 -49.28,49.28 0,27.23 22.06,49.29 49.28,49.29 27.22,0 49.29,-22.06 49.29,-49.29 0,-27.22 -22.06,-49.28 -49.29,-49.28zm441.25 -26.62l-152.91 0c-11.43,0 -20.71,-9.28 -20.71,-20.71l0 -101.98 -442.37 0 0 745.62 615.99 0 0 -622.93zm-132.2 -103.45l0 62.03 87.78 0 -87.78 -62.03z"></path> </g> </g></svg></span>
					<span class="menu-title" style="color:#0E86D4; ">{{ ucwords(trans('pages/profils.CV')) }}</span>
					<span class="menu-arrow"></span>
				</span>
				<div class="menu-sub menu-sub-accordion">
					<div class="menu-item">
						<a class="menu-link" href="{{ route('profils.index') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">{{ trans('pages/profils.CV') }}</span>
						</a>
					</div>
				</div>
				<div class="menu-sub menu-sub-accordion">
					<div class="menu-item">
						<a class="menu-link" href="{{ route('profils.create') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title" >{{ trans('pages/profils.addCV') }}</span>
						</a>
					</div>
				</div>
				<!--end:Menu sub-->
			</div>
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
				<!--begin:Menu link-->
				<span class="menu-link">
					
					<span class="menu-icon ">	<img alt="Logo" src="{{ asset('assets/language.svg') }}" class="" width="25" /></span>
					<span class="menu-title" style="color:#0E86D4; ">{{ ucwords(trans('words.langue')) }}</span>
					<span class="menu-arrow"></span>
				</span>
				<div class="menu-sub menu-sub-accordion">
					<div class="menu-item">
						<a class="menu-link" href="{{ route('langues.index') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">{{ trans('pages/langues.index_page_title') }}</span>
						</a>
					</div>
				</div>
				<div class="menu-sub menu-sub-accordion">
					<div class="menu-item">
						<a class="menu-link" href="{{ route('langues.create') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title" >{{ trans('pages/langues.add_a_new_langue') }}</span>
						</a>
					</div>
				</div>
				<!--end:Menu sub-->
			</div>
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getSvgIcon('duotune/general/gen022.svg', 'svg-icon svg-icon-2') !!}</span>
					<span class="menu-title" style="color:#0E86D4; ">{{ ucwords(trans('pages/secteursspects.secteursspects')) }}</span>
					<span class="menu-arrow"></span>
				</span>
				<div class="menu-sub menu-sub-accordion">
					<div class="menu-item">
						<a class="menu-link" href="{{ route('secteursspects.index') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title" >{{ trans('pages/secteursspects.index_page_title') }}</span>
						</a>
					</div>
				</div>
				<div class="menu-sub menu-sub-accordion">
					<div class="menu-item">
						<a class="menu-link" href="{{ route('secteursspects.create') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title" >{{ trans('pages/secteursspects.add_a_new_secteursspects') }}</span>
						</a>
					</div>
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
		</div>
		<!--end::Menu-->
	</div>
	<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->


