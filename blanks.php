<?php

require_once 'php/php-functions.php';

session_start();

$data = [];

if (isset($_SESSION['template'])) {
	$data =  $_SESSION['template'];
} 

$texteditor = getFromArray($data, 'texteditor');
$tempName = getFromArray($data, 'tempName');

$errors = [
	'tempName' => ''
];

if ($_POST) {
	$texteditor = test_input(getFromArray($_POST, 'texteditor'));
	$tempName = test_input(getFromArray($_POST, 'tempName'));
	
	if ($tempName == '') {
		$errors['tempName'] = 'Input template name!';
	}
	
	if ($errors['tempName'] == '') {
		
		$_SESSION['template'][] = [
			'texteditor' => $texteditor,
			'tempName' => $tempName
		];
		
		header('Location: editBlank.php');
		die;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Blanks</title>
		<link href="assets/css/sign-style.css" rel="stylesheet" type="text/css" />
		<link href="assets/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="assets/node_modules/jquery/dist/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/js-functions.js"></script>
		<script type="text/javascript" src="assets/js/index.js"></script>
		<script type="text/javascript" src="assets/node_modules/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector: 'textarea',
				height: 400,
				plugins: [
					'advlist autolink lists link image charmap print preview anchor',
					'searchreplace visualblocks code fullscreen',
					'insertdatetime media table contextmenu paste code'
				],
				toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				content_css: '//www.tinymce.com/css/codepen.min.css'
			});
		</script>
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
				<form id="get_data" method="post">
					<div class="wrapper">
						<label for="tempName">Name of the template</label>
						<input class="<?php echo $errors['tempName'] ? 'err' : '';?>" type="text" id="tempName" name="tempName" value="<?= $tempName;?>"/>
						<p class="error"><?= $errors['tempName'];?></p>
					</div>
					<textarea id="texteditor" name="texteditor">
						<p>Създайте Вашата бланка, като на местата, на които искате да въвеждате текст поставете тези символи [?]. Ето един пример:</p><br />
						<p style="text-align: right;">До [?]<br /> Управител<br /> На [?]</p>
						<br /><br />
						<p align="center"><br /><strong>МОЛБА</strong><br /><br /><br /></p>
						<p style="text-align: center;">От [?],</p><br />
						<p style="text-align: center;">ЕГН [?],</p><br /><p style="text-align: center;">на длъжност [?]</p>
						<p><br /> <br /> <br /> <br /> Уважаеми г-н/г-жо [?],<br /><br /><br /><br /> С настоящата и на основание чл. 325, т. 1 от КТ, 
							 Ви моля за Вашето съгласие за прекратяване на трудовото ми правоотношение с представляваното от Вас предприятие, считано от [?]<br />
							 <br /> В случай че молбата ми не бъде приета, същата да се счита за предизвестие по чл. 326 ал. 1.<br /><br /> Моля, в случай, че молбата ми бъде уважена, 
							 да оформите трудовата ми книжка и всички други необходими документи и да ми ги предадете.<br /><br /><br /><br /><br /><br />Молбата е изготвена в два екземпляра.<br /><br /><br /><br />
						<p>Дата: [?]</p>
						<p align="right">Подпис: .................</p>
					</textarea>
					<div>
						<button>Send</button>
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