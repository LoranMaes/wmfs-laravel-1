<!DOCTYPE HTML>
<html>
	<head>
		<title>Concertagenda - Overzicht</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="{{ asset('css/main.css') }}" />
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
	</head>
	<body id="top">

		<!-- Header -->
		@include('partials/header')

		<!-- Main -->
        @section('pageContent')
        @show

		<!-- Footer -->
		@include('partials/footer')

		<!-- Scripts -->
        <script ript src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.poptrox.min.js') }}"></script>
        <script src="{{ asset('assets/js/skel.min.js') }}"></script>
        <script src="{{ asset('assets/js/util.js') }}"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js')"></script><![endif]-->
        <script src="{{ asset('assets/js/main.js') }}"></script>

	</body>
</html>