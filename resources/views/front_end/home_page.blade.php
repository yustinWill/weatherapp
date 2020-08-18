<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<meta charset="utf-8" />
	<title>Weather App | Home</title>
	<meta name="description" content="Login page example" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no " />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		
	<link rel="stylesheet" href="assets/frontend/css/main.css" />
	<link rel="shortcut icon" href="{{ asset('gnrm-logo-white.png') }}" />
</head>

<body class="is-preload">

	<!-- Header -->
	<header id="header">
		<h1>Weather App</h1>
		<p>Flooding is a common occurrence in Jakarta.<br />Subscribe to us and we will send a reminder to you<br />when there is a heavy rain on your location tommorow.</p>
	</header>

	<!-- Signup Form -->
	<form id="signup-form" method="POST" class="login" novalidate="novalidate" action="{{ route("home_page_subscribe") }}">
		@csrf
		<div style="display: flex; justify-content:space-between; margin-bottom: 1em;">
			<input type="text" name="user_name" id="name" placeholder="Your Name" />
			<input type="email" name="user_email" id="email" placeholder="Your Email" />
		</div>
		<div style="display: flex; justify-content:space-between;">
			<select type="location" id="location" name="user_location_id">
				@foreach ($location_data as $data)
				<option value="<?php echo $data["location_id"] ?>">{{ $data["location_name"] }}</option>
				@endforeach
			</select>
			<input type="submit" value="Subscribe"/>
		</div>
	</form>

	<!-- Footer -->
	<footer id="footer">
		<ul class="copyright">
			<li style="font-size: 12px;">&copy; Untitled.</li>
			<li style="font-size: 12px;">Credits: <a href="http://html5up.net">HTML5 UP</a></li>
		</ul>
	</footer>

	<!-- Scripts -->
	<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
	<script src="assets/frontend/js/main.js"></script>

	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<script src="assets/js/pages/custom/login/login-general.js"></script>
	<script src="custom/js/frontend/subscribe.js"></script>
</body>

</html>