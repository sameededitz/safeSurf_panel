<!doctype html>
<html lang="en">

<head>
	@include('partials.head')
</head>

<body class="fixed-left">

	<!--wrapper-->
		<!--sidebar wrapper -->
		@include('partials.sidebar')
		<!--end sidebar wrapper -->
		<!--start header -->
		<div id="preloader"><div id="status"><div class="spinner"></div></div></div>
		<div id="wrapper">
		<div class="content-page">
			<div class="content">
		@include('partials.navbar')
		<!--end header -->
		<!--start page wrapper -->
				
				<!--start page content -->
				@yield('content')
				<!--end page content -->

			</div>
		</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--End Back To Top Button-->
		<footer class="footer">
			© {{ date('Y') }} Zoter by Mannatthemes.
		</footer>
	</div>
	<!--end wrapper-->
	
    @include('partials.scripts')
</body>

</html>