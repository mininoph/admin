<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<title>@yield('title','') | Reward App</title>
	<!-- initiate head with meta tags, css and script -->
	@include('include.head')

</head>
<body id="app">
    <div class="wrapper">
    	<!-- initiate header-->
    	@include('include.header')
    	<div class="page-wrap">
	    	<!-- initiate sidebar-->
	    	@include('include.sidebar')
	    	<div class="main-content">
	    		<!-- yeild contents here -->
	    		@yield('content')
	    	</div>

	    	<!-- initiate footer section-->
	    	@include('include.footer')

    	</div>
    </div>
    
	<!-- initiate modal menu section-->

	<!-- initiate scripts-->
	<!-- @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@10"]) -->
	@include('include.script')	
</body>
</html>