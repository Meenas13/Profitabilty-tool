<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>@yield('title','') | {{ config('app.name') }} </title>
	<!-- initiate head with meta tags, css and script -->
	@include('include.head')

</head>

<body id="app">
	<div class="wrapper">
		<!-- initiate header-->
		@include('include.header')
		<div class="page-wrap">


			<div id="loader" class="loader">
				<!-- By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL -->
				<svg width="58" height="58" viewBox="0 0 58 58" xmlns="http://www.w3.org/2000/svg">
					<g fill="none" fill-rule="evenodd">
						<g transform="translate(2 1)" stroke="#003b7e" stroke-width="1.5">
							<circle cx="42.601" cy="11.462" r="5" fill-opacity="1" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="1;0;0;0;0;0;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="49.063" cy="27.063" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;1;0;0;0;0;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="42.601" cy="42.663" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;1;0;0;0;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="27" cy="49.125" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;0;1;0;0;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="11.399" cy="42.663" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;0;0;1;0;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="4.938" cy="27.063" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;0;0;0;1;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="11.399" cy="11.462" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;0;0;0;0;1;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="27" cy="5" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;0;0;0;0;0;1" calcMode="linear" repeatCount="indefinite" />
							</circle>
						</g>
					</g>
				</svg>
			</div> <!-- Loader ends -->


			<!-- initiate sidebar-->
			@include('include.sidebar')

			<div class="main-content">
				<!-- start message area-->
				@include('include.message')
				<!-- end message area-->
				<!-- yeild contents here -->
				@yield('content')
			</div>

			<!-- initiate chat section-->
			@include('include.chat')


			<!-- initiate footer section-->
			@include('include.footer')

		</div>
	</div>

	<!-- initiate modal menu section-->
	@include('include.modalmenu')

	<!-- initiate scripts-->
	@include('include.script')
</body>

</html>