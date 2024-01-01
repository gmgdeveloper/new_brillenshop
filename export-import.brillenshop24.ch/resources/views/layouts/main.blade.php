<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title') | Export/Import - Laravel</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/images/favicon.ico') }}">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/css/meanmenu.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/css/global.css') }}">
	<!-- style css -->
	<link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
	
	@stack('style')
	
	<!-- export import css -->
	<link rel="stylesheet" href="{{ asset('public/assets/css/et-line.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/css/export_import.css') }}">
	
</head>
<body>
	 <!-- scrollToTop -->	
	 <a href="#top" class="scroll-to-top">
		<i class="fa fa-arrow-up"></i>
	</a><!-- /scrollToTop -->
	
	@include('partials.header')
	
	@yield('content')
	
	@include('partials.footer')
	
	<!-- jquery js -->
	<script src="{{ asset('public/assets/js/jquery-3.4.1.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/jquery.meanmenu.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/jquery.easing.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/scrolltotop.js') }}"></script>
	<!-- main js -->
	<script src="{{ asset('public/assets/js/main.js') }}"></script>
	
	@stack('scripts')
	
</body>
</html>
