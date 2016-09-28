<?php

session_start();

$template = !empty($_SESSION['template']) ? $_SESSION['template'] : [];

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Templates</title>
		<link rel="stylesheet" href="assets/css/sign-style.css" />
		<link rel="stylesheet" href="assets/node_modules/font-awesome/css/font-awesome.min.css" />
		<script type="text/javascript" src="assets/node_modules/jquery/dist/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/js-functions.js"></script>
		<script type="text/javascript" src="assets/js/index.js"></script>
	</head>
	<body>
		<div id="container">
			<nav>
				<div>
					<h1 id="logo"><a href="homepage.php">DocCreate</a></h1>
					<ul>
						<li><a href="comming-soon.php">About</a></li>
						<li><a href="comming-soon.php">Blog</a></li>
						<li><a href="comming-soon.php">Terms</a></li>
						<li><a href="comming-soon.php">Privacy</a></li>
						<li><a href="php/sign-out.php">Sign Out</a></li>
					</ul>
				</div>
			</nav>
			<div>
				<h1 class="temp">Templates</h1>
				<div class="temp">
					<span>To add template press the button -</span>
					<button class="fa fa-plus"></button>
				</div>
				<table>
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<footer>
				<p>
					<a href="https://plus.google.com">
						<span class="fa fa-google-plus"></span>
					</a>
					<a href="https://www.pinterest.com">
						<span class="fa fa-pinterest"></span>
					</a>
					<a href="https://twitter.com">
						<span class="fa fa-twitter"></span>
					</a>
					<a href="https://www.facebook.com/">
						<span class="fa fa-facebook"></span>
					</a>
					<a href="https://www.instagram.com/">
						<span class="fa fa-instagram"></span>
					</a>
				</p>
				<p>DocCreate &copy; 2016 - Privacy Policy</p> 
			</footer>
		</div>
	</body>
</html>