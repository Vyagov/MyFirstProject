<?php

require_once 'php/php-functions.php';
require 'pdfCrowd/pdfcrowd.php';

session_start();
$result = '';

$template = !empty($_SESSION['template']) ? $_SESSION['template'] : [];

foreach ($template as $key => $value) {
	
	$result = html_entity_decode($value['texteditor']);
	$result = str_replace('[?]', '<input type="text" />', $result);
}

if ($_POST) {
	//$content = test_input(getFromArray($_POST, 'result'));
	$client = new PdfCrowd("quicky", "e4daf284319340c0d8420c4b6de6d97a");
	
	$pdf = $client->convertHtml($result);
	
	header("Content-Type: application/pdf");
	header("Cache-Control: no-cache");
	header("Accept-Ranges: none");
	header("Content-Disposition: attachment; filename=blank.pdf");
	
	echo $pdf;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Edit Blank</title>
		<link href="assets/css/sign-style.css" rel="stylesheet" type="text/css" />
		<link href="assets/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="assets/node_modules/jquery/dist/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/js-functions.js"></script>
		<script type="text/javascript" src="assets/js/index.js"></script>
		<script type="text/javascript" src="assets/node_modules/tinymce/tinymce.min.js"></script>
		<style type="text/css">
			#container > div {
				width: 900px;
			}
		</style>
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
				<form id="data-container" method="post">
					<div>
						<input type="hidden" name="result" value="<?= $result;?>" />
					</div>
					<div>
						<button>Save/CreatePDF</button>
						<button id="goBack">Go Back</button>
					</div>
				</form>
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